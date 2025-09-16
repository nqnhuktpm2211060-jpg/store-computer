<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogTranslation;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postQuery = Blog::with('user', 'translations');
        if (request('title')) {
            $postQuery->where('title', 'like', '%' . request('title') . '%');
        }
        $posts = $postQuery->orderBy('created_at', 'DESC')->paginate(15);

        $languages = Language::orderBy('name')->get();

        return view('admin.post.index', compact('posts', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'categories' => 'required|string',
            'short_content' => 'required|string',
            'content' => 'required|string',
            'image' => 'required|image',
            'language' => 'required'
        ]);

        try {
            $slug = Str::slug($request->title, '-');
            $categories = json_decode($request->categories, true);
            $categoryValues = array_map(function ($item) {
                return $item['value'];
            }, $categories);
            $subCategoriesJson = json_encode($categoryValues);

            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = '/uploads/blogs/' . $fileName;
            $file->move(public_path('uploads/blogs'), $fileName);

            $blog = Blog::create([
                'image' => $filePath,
                'user_id' => Auth::user()->id,
            ]);

            $blog->translations()->create([
                'language_code' => $request->language,
                'title' => $request->title,
                'sub_categories' => $subCategoriesJson,
                'short_content' => $request->short_content,
                'content' => $request->content,
                'slug' => $slug,
            ]);

            return redirect()->back()->with('success', 'Thêm mới bài viết thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $language = $request->input('language', app()->getLocale());

        $blog = Blog::with(['translations' => function ($query) use ($language) {
            $query->where('language_code', $language);
        }])->find($id);

        if (!$blog) {
            return response()->json([
                'message' => 'Bài viết không tồn tại'
            ], 404);
        }

        return response()->json([$blog], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $language = $request->input('language', app()->getLocale());

        $blog = Blog::with(['translations' => function ($query) use ($language) {
            $query->where('language_code', $language);
        }])->find($id);

        $languages = Language::orderBy('name')->get();

        if (!$blog) {
            return response()->json([
                'message' => 'Bài viết không tồn tại'
            ], 404);
        }

        return view('admin.post.edit', compact('blog', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string',
            'categories' => 'required|string',
            'short_content' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|image',
            'language' => 'required'
        ]);

        $blog = Blog::find($id);

        if (!$blog) {
            return redirect()->back()->with('error', 'Bài viết không tồn tại');
        }

        if ($request->hasFile('image')) {
            if ($blog->image && file_exists(public_path($blog->image))) {
                unlink(public_path($blog->image));
            }

            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = '/uploads/blogs/' . $fileName;
            $file->move(public_path('uploads/blogs'), $fileName);
        } else {
            $filePath = $blog->image;
        }

        $slug = Str::slug($request->title, '-');
        $categories = json_decode($request->categories, true);
        $categoryValues = array_map(function ($item) {
            return $item['value'];
        }, $categories);
        $subCategoriesJson = json_encode($categoryValues);

        $blog->update([
            'image' => $filePath,
        ]);

        BlogTranslation::updateOrCreate(
            [
                'language_code' => $request->language,
                'blog_id' => $blog->id
            ],
            [
                'slug' => $slug,
                'title' => $request->title,
                'sub_categories' => $subCategoriesJson,
                'short_content' => $request->short_content,
                'content' => $request->content,
            ]
        );

        return redirect()->back()->with('success', 'Cập nhật bài viết thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json([
                'message' => 'Bài viết không tồn tại'
            ], 404);
        }
        if ($blog->image && file_exists(public_path($blog->image))) {
            unlink(public_path($blog->image));
        }
        $blog->delete();

        return redirect()->back()->with('success', 'Xóa bài viết thành công');
    }

    public function uploadImageDescription(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
            ]);

            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = '/uploads/blogs/descriptions/' . $fileName;
            $file->move(public_path('uploads/blogs/descriptions'), $fileName);
            return response()->json([
                'url' => $path,
            ]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }
}
