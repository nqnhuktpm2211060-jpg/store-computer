<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoryQuery = Category::with([
            'products',
            'categoryParent',
            'categoryChilden',
            'translations' => function ($query) {
                $query->where('language_code', App::getLocale());
            }
        ])->where('level', 1);

        if (request('name')) {
            $categoryQuery->where('name', 'like', '%' . request('name') . '%');
        }
        if (request('level')) {
            $categoryQuery->where('level', request('level'));
        }
        $categories = (clone $categoryQuery)->orderBy('created_at', 'DESC')->paginate(15);

        $languages = Language::orderBy('name')->get();

        $categoriesSelect = $categoryQuery->where('level', 1)->orderBy('name', 'ASC')->get();

        return view('admin.category-product.index', compact('categories', 'categoriesSelect', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required', 'level' => 'required', 'language' => 'required']);

        if ($request->level == 2 && !$request->category_parent) {
            return redirect()->back()->with('error', 'Chưa chọn danh mục cha cho danh mục level 2');
        }

        DB::beginTransaction();
        try {
            $category = Category::create([
                'parent_id' => $request->category_parent ?? 0,
                'level' => $request->level,
                'icon' => $request->icon
            ]);

            $category->translations()->create([
                'language_code' => $request->language,
                'name' => $request->name
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Thêm mới danh mục thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Thêm mới danh mục không thành công');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $language = $request->input('language', app()->getLocale());

        $category = Category::with(['translations' => function ($query) use ($language) {
            $query->where('language_code', $language);
        }])->find($id);

        if (!$category) {
            return response()->json([
                'massage' => 'Danh mục không tồn tại'
            ], 404);
        }
        return response()->json([
            'category' => $category
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(['name' => 'required', 'level' => 'required', 'language' => 'required']);

        if ($request->level == 2 && !$request->category_parent) {
            return redirect()->back()->with('error', 'Chưa chọn danh mục cha cho danh mục level 2');
        }

        $category = Category::find($id);

        if (!$category) {
            return redirect()->back()->with('error', 'Danh mục không tồn tại');
        }

        $category->update([
            'parent_id' => $request->category_parent ?? 0,
            'level' => $request->level,
            'icon' => $request->icon
        ]);

        CategoryTranslation::updateOrCreate([
            'category_id' => $category->id,
            'language_code' => $request->language
        ], [
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'Cập nhật danh mục thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->back()->with('error', 'Danh mục không tồn tại');
        }

        $category->delete();
        $category->categoryChilden()?->delete();

        return redirect()->back()->with('success', 'Xóa danh mục thành công');
    }
}
