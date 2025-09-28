<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

use function Laravel\Prompts\alert;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $productQuery = Product::with('reviews', 'category');
    $categoryQuery = Category::with(['products', 'categoryParent']);

        // Prefer ID-based filtering to avoid locale/translation mismatches; keep legacy name params as fallback
        $categoryL1Id = $request->get('category_l1_id');
        $categoryId = $request->get('category_id');

        if ($categoryL1Id) {
            $productQuery->whereHas('category', function ($q) use ($categoryL1Id) {
                $q->where('parent_id', (int) $categoryL1Id);
            });
        } elseif ($request->category_l1) {
            $productQuery->whereHas('category.categoryParent', function ($query) use ($request) {
                $query->where('name', $request->category_l1);
            });
        }

        if ($categoryId) {
            $productQuery->where('category_id', (int) $categoryId);
        } elseif ($request->category) {
            $productQuery->whereHas('category', function ($query) use ($request) {
                $query->where('name', $request->category);
            });
        }
        if ($request->search) {
            $productQuery->where('name', 'like', '%' . $request->search . '%');
        }
        // $minPrice = 10000;
        // $maxPrice = 10000000;
        // if ( $request->price){
        //     $priceRange = str_replace(['Giá:', 'đ', '.', ' '], '', $request->price);

        //     $prices = explode('-', $priceRange);

        //     if (count($prices) === 2) {
        //         $minPrice = (int)$prices[0];
        //         $maxPrice = (int)$prices[1];

        //         $productQuery->whereBetween('price', [$minPrice, $maxPrice]);
        //     }
        // }

        // $productTops = Product::with('reviews', 'images')
        // ->orderBy('total_purchases', 'desc')
        // ->take(10)
        // ->get();

    $products = $productQuery->orderBy('created_at', 'desc')->paginate(14);

        $categories = $categoryQuery->orderBy('name')->get();
        return view('pages.products.index', compact('products', 'categories'));
    }

    public function quickView($id)
    {
        try {
            $product = Product::with('reviews', 'category')->findOrFail($id);

            return view('pages.products.quick_view', compact('product'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'product not found',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function productDetail($id)
    {
        try {
            $product = Product::with('reviews', 'category')->find($id);

            if (!$product) {
                return abort(404);
            }

            $product->increment('view_count');

            // Track view count directly on product; separate ProductView model no longer used

            $relatedProducts = Product::with('reviews', 'category')->where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->orderBy('created_at', 'desc')
                ->take(10)->get();

            $categories = Category::query()->where('id', '!=', $product->category_id)->get();
            $suggestedProducts = collect();

            foreach ($categories as $category) {
                $suggestedProduct = Product::query()->where('category_id', $category->id)
                    ->where('id', '!=', $product->id)
                    ->inRandomOrder()
                    ->first();
                if ($suggestedProduct) {
                    $suggestedProducts->push($suggestedProduct);
                }
            }

            return view('pages.products.detail', compact('product', 'relatedProducts', 'suggestedProducts'));
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function review(Request $request, $product_id)
    {
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'content' => 'required',
            'rating' => 'required'
        ]);

        Review::create([
            'product_id' => $product_id,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'content' => $request->content,
            'rating' => $request->rating,
            'status' => 0
        ]);

        return redirect()->back()->with('success', __('notification.review_success'));
    }
}
