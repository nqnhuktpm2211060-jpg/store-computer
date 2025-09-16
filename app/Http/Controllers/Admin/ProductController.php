<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Language;
use App\Models\Product;
use App\Models\ProductCharacteristics;
use App\Models\ProductCharacteristicTranslation;
use App\Models\ProductTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $productQuery = Product::with('images', 'translations');

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
            'name' => 'required',
            'language' => 'required',
            'price' => 'required',
            'stock_quantity' => 'required',
            'category_id' => 'required',
            'images' => 'required|array',
            'images.*' => 'file|mimes:png,jpeg,gif,jpg,webp',
            'characteristics' => 'required|array'
        ]);

        try {
            DB::beginTransaction();
            $price = preg_replace('/[^0-9]/', '', $request->price);
            $sale_price = $request->sale_price ? preg_replace('/[^0-9]/', '', $request->sale_price) : 0;

            $product = Product::create([
                'price' => $price,
                'stock_quantity' => $request->stock_quantity,
                'category_id' => $request->category_id,
                'sale_price' => $sale_price
            ]);

            $product->translations()->create([
                'language_code' => $request->language,
                'name' => $request->name,
                'short_description' => $request->short_description,
                'description' => $request->description,
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $img) {
                    if ($img->isValid()) {
                        $fileName = time() . '-' . $img->getClientOriginalName();
                        $filePath = '/uploads/products/' . $fileName;
                        $img->move(public_path('uploads/products'), $fileName);

                        Image::create([
                            'product_id' => $product->id,
                            'image_path' => $filePath
                        ]);
                    }
                }
            }
            $dataCharacteristics = [];
            foreach ($request->characteristics as $characteristic) {
                $dataCharacteristics[] = array_merge($characteristic, [
                    'language_code' => $request->language
                ]);
            }

            $product->characteristicsTranslations()->createMany($dataCharacteristics);

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

        $product = Product::with([
            'images',
            'category',
            'translations' => function ($query) use ($language) {
                $query->where('language_code', $language);
            },
            'characteristicsTranslations' => function ($query) use ($language) {
                $query->where('language_code', $language);
            },
            'characteristics'
        ])->find($id);

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
            'name' => 'required',
            'price' => 'required',
            'language' => 'required',
            'stock_quantity' => 'required',
            'category_id' => 'required',
            'images' => 'nullable|array',
            'images.*' => 'file|mimes:png,jpeg,gif,jpg,webp',
            'characteristics' => 'required|array'
        ]);

        try {
            $product = Product::find($id);

            if (!$product) {
                return redirect()->back()->with('error', 'Sản phẩm không tồn tại');
            }

            $price = preg_replace('/[^0-9]/', '', $request->price);
            $sale_price = $request->sale_price ? preg_replace('/[^0-9]/', '', $request->sale_price) : 0;

            $product->update([
                'price' => $price,
                'stock_quantity' => $request->stock_quantity,
                'category_id' => $request->category_id,
                'sale_price' => $sale_price
            ]);

            ProductTranslation::updateOrCreate([
                'product_id' => $product->id,
                'language_code' => $request->language
            ], [
                'name' => $request->name,
                'short_description' => $request->short_description,
                'description' => $request->description
            ]);


            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $img) {
                    if ($img->isValid()) {
                        $fileName = time() . '-' . $img->getClientOriginalName();
                        $filePath = '/uploads/products/' . $fileName;
                        $img->move(public_path('uploads/products'), $fileName);

                        Image::create([
                            'product_id' => $product->id,
                            'image_path' => $filePath
                        ]);
                    }
                }
            }

            $product->characteristicsTranslations()->where('language_code', $request->language)->delete();
            $dataCharacteristics = [];
            foreach ($request->characteristics as $characteristic) {
                $dataCharacteristics[] = array_merge($characteristic, [
                    'language_code' => $request->language
                ]);
            }
            $product->characteristicsTranslations()->createMany($dataCharacteristics);

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

            foreach ($product->images as $image) {
                if ($image->image_path && file_exists(public_path($image->image_path))) {
                    unlink(public_path($image->image_path));
                }
            }

            $product->translations()->delete();
            $product->images()->delete();
            $product->reviews()->delete();
            $product->characteristics()->delete();
            $product->characteristicsTranslations()->delete();
            $product->views()->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Xóa sản phẩm thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Xóa Sản phẩm không thành công' . $e);
        }
    }

    public function deleteImage($id)
    {
        $image = Image::find($id);

        if (!$image) {
            return response()->json([
                'masaage' => 'Image not found'
            ], 404);
        }
        $image->delete();
        if ($image->image_path && file_exists(public_path($image->image_path))) {
            unlink(public_path($image->image_path));
        }


        $images = Image::where('product_id', $image->product_id)->get();

        return response()->json([
            'masaage' => 'Xóa ảnh thành công',
            'images' => $images,
        ], 200);
    }

    public function deleteCharacteristic($id)
    {
        $characteristic = ProductCharacteristics::find($id);

        if (!$characteristic) {
            return response()->json([
                'masaage' => 'Không tìm thấy đặc điểm'
            ], 404);
        }
        $characteristic->delete();

        return response()->json([
            'masaage' => 'Xóa đặc điểm thành công',
        ], 200);
    }

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
