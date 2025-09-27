<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Language;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $productQuery = Product::query();

        if ($request->name) {
            $productQuery->where('name', 'like', '%' . $request->name . '%');
        }

        $languages = Language::orderBy('name')->get();

        $products = $productQuery->orderBy('created_at', 'DESC')->paginate(10);
        $categories = Category::with('translations')->where('level', 2)->orderBy('name')->get();

        return view('admin.product.index', compact('products', 'languages', 'categories'));
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
            'name' => 'required|string',
            'language' => 'required|string',
            'price' => 'required',
            'stock_quantity' => 'required|integer',
            'category_id' => 'required|integer',
            'images' => 'required|array',
            'images.*' => 'file|mimes:png,jpeg,gif,jpg,webp',
            'characteristics' => 'nullable|array'
        ]);

        try {
            DB::beginTransaction();
            $price = preg_replace('/[^0-9]/', '', $request->price);
            $sale_price = $request->sale_price ? preg_replace('/[^0-9]/', '', $request->sale_price) : 0;

            // Handle images upload to JSON array
            $images = [];
            $featuredImage = null;
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $idx => $img) {
                    if ($img->isValid()) {
                        $fileName = time() . '-' . $img->getClientOriginalName();
                        $img->move(public_path('uploads/products'), $fileName);
                        $images[] = $fileName;
                        if ($idx === 0) {
                            $featuredImage = $fileName;
                        }
                    }
                }
            }
            // Normalize images array
            $images = array_values(array_filter(array_unique($images)));

            // Map characteristics to specifications (key => value)
            $specifications = [];
            if (is_array($request->characteristics)) {
                foreach ($request->characteristics as $characteristic) {
                    if (!empty($characteristic['name'])) {
                        $specifications[$characteristic['name']] = $characteristic['description'] ?? '';
                    }
                }
            }

            $translations = [
                $request->language => [
                    'name' => $request->name,
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                ]
            ];

            $product = Product::create([
                'name' => $request->name,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'price' => $price,
                'sale_price' => $sale_price,
                'stock_quantity' => $request->stock_quantity,
                'category_id' => $request->category_id,
                'images' => $images,
                'featured_image' => $featuredImage,
                'specifications' => $specifications,
                'translations' => $translations,
                'is_active' => true,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Thêm mới sản phẩm thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $language = $request->input('language', app()->getLocale());

        $product = Product::with(['category', 'reviews'])->find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại');
        }
        
        $languages = Language::orderBy('name')->get();

        $categories = Category::with('translations')->where('level', 2)->orderBy('name')->get();

        return view('admin.product.edit', compact('product', 'categories', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required',
            'language' => 'required|string',
            'stock_quantity' => 'required|integer',
            'category_id' => 'required|integer',
            'images' => 'nullable|array',
            'images.*' => 'file|mimes:png,jpeg,gif,jpg,webp',
            'characteristics' => 'nullable|array'
        ]);

        try {
            $product = Product::find($id);

            if (!$product) {
                return redirect()->back()->with('error', 'Sản phẩm không tồn tại');
            }

            $price = preg_replace('/[^0-9]/', '', $request->price);
            $sale_price = $request->sale_price ? preg_replace('/[^0-9]/', '', $request->sale_price) : 0;

            // Update basic fields
            $product->update([
                'name' => $request->name,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'price' => $price,
                'stock_quantity' => $request->stock_quantity,
                'category_id' => $request->category_id,
                'sale_price' => $sale_price
            ]);

            // Append new uploaded images if any
            $images = is_array($product->images) ? $product->images : [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $img) {
                    if ($img->isValid()) {
                        $fileName = time() . '-' . $img->getClientOriginalName();
                        $img->move(public_path('uploads/products'), $fileName);
                        $images[] = $fileName;
                        if (!$product->featured_image) {
                            $product->featured_image = $fileName;
                        }
                    }
                }
            }
            // Normalize images array
            $images = array_values(array_filter(array_unique($images)));
            $product->images = $images;

            // Update specifications from characteristics array
            if (is_array($request->characteristics)) {
                $specifications = [];
                foreach ($request->characteristics as $characteristic) {
                    if (!empty($characteristic['name'])) {
                        $specifications[$characteristic['name']] = $characteristic['description'] ?? '';
                    }
                }
                $product->specifications = $specifications;
            }

            // Merge translations JSON for provided language
            $translations = is_array($product->translations) ? $product->translations : [];
            $translations[$request->language] = [
                'name' => $request->name,
                'short_description' => $request->short_description,
                'description' => $request->description,
            ];
            $product->translations = $translations;

            $product->save();

            return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra'.$e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return redirect()->back()->with('error', 'Sản phẩm không tồn tại');
            }

            DB::beginTransaction();

            $product->delete();

            // Xóa ảnh từ JSON field
            if ($product->images && is_array($product->images)) {
                foreach ($product->images as $image) {
                    if ($image && file_exists(public_path('uploads/products/' . $image))) {
                        unlink(public_path('uploads/products/' . $image));
                    }
                }
            }
            
            // Xóa featured image
            if ($product->featured_image && file_exists(public_path('uploads/products/' . $product->featured_image))) {
                unlink(public_path('uploads/products/' . $product->featured_image));
            }

            $product->reviews()->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Xóa sản phẩm thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Xóa Sản phẩm không thành công' . $e);
        }
    }

    // Legacy endpoints using old tables have been removed as data is consolidated into JSON fields.

    public function uploadImageDescription(Request $request){
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
            ]);

            $fileName = time() . '_' .$file->getClientOriginalName();
            $path = '/uploads/products/descriptions/' . $fileName;
            $file->move(public_path('uploads/products/descriptions'), $fileName);
            return response()->json([
                'url' => $path,
            ]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }
}
