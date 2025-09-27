<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index() {
        $carts = session()->get('cart', []);

        return view('pages.cart.index', compact('carts'));
    }

    public function getCarts(){
        $carts = session()->get('cart', []);

        return response()->json([
            'message' => 'list cart',
            'carts' => $carts
        ], 200);
    }


    public function addToCart(Request $request)
    {
        $product = Product::find($request->product_id);

        if (!$product) {
            return response()->json(['message' => __('notification.product_not_exist')], 404);
        }
    $imageUrl = $product->main_image;

        $carts = session()->get('cart', []);

        $found = false;
        foreach ($carts as &$cart) {
            if ($cart['product_id'] == $product->id) {
                $cart['quantity'] += $request->quantity?? 1;
                $found = true;
                break;
            }
        }
        if (!$found) {

            $carts[] = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'image' => $imageUrl,
                'quantity' => $request->quantity ?? 1,
                'price' => $product->price,
                'sale_price' => $product->sale_price
            ];
        }

        session()->put('cart', $carts);

        return response()->json(['message' => __('notification.add_to_cart_success')], 201);
    }

    public function deleteCart($index){
        $carts = session()->get('cart', []);

        $index = (int) $index;
        if (isset($carts[$index])) {
            unset($carts[$index]);

            $carts = array_values($carts);

            session()->put('cart', $carts);

            return response()->json(['message' => __('notification.remove_from_cart_success')], 200);
        }

        return response()->json(['message' => __('notification.product_not_found')], 404);
    }

    public function decrease($index){
        $carts = session()->get('cart', []);

        $index = (int) $index;
        if (isset($carts[$index])) {
            if ($carts[$index]['quantity'] > 1) {
                $carts[$index]['quantity'] -= 1;
            } else {
                return response()->json(['message' => __('notification.quantity_minimum')], 400);
            }

            session()->put('cart', $carts);

            return response()->json(['message' => __('notification.quantity_decreased')], 200);
        }
        return response()->json(['message' => __('notification.product_not_in_cart')], 404);
    }
    public function increase($index){
        $carts = session()->get('cart', []);

        $index = (int) $index;
        if (isset($carts[$index])) {
            $carts[$index]['quantity'] += 1;

            session()->put('cart', $carts);

            return response()->json(['message' => __('notification.quantity_increased')], 200);
        }
        return response()->json(['message' => __('notification.product_not_in_cart')], 404);
    }
}
