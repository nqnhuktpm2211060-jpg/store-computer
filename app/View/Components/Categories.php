<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Categories extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // Load top-level categories and their children
        $categories = Category::with('categoryChilden')
            ->where('level', 1)
            ->orderBy('name', 'asc')
            ->get();

        // For each parent category, compute a small preview list of products from itself + its immediate children
        foreach ($categories as $cat) {
            $ids = $cat->categoryChilden->pluck('id')->all();
            $ids[] = $cat->id;
            $preview = Product::query()
                ->active()
                ->inStock()
                ->whereIn('category_id', $ids)
                ->orderByDesc('rating_average')
                ->orderByDesc('view_count')
                ->select('id','name','price','sale_price','featured_image','images','category_id','brand','stock_quantity','rating_average','rating_count')
                ->take(4)
                ->get();
            $cat->setRelation('previewProducts', $preview);
        }

        return view('components.categories', compact('categories'));
    }
}
