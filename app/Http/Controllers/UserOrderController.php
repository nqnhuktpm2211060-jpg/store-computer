<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class UserOrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);
        return view('pages.account.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['orderItems.product'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);
        return view('pages.account.orders.show', compact('order'));
    }

    public function cancel($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        $current = (int)($order->status ?? 0);
        if ($current === 0) { $current = 1; }

        // Only allow cancel when New (1) or Delivering (2)
        if (!in_array($current, [1,2], true)) {
            return redirect()->back()->with('error', 'Đơn hàng không thể hủy ở trạng thái hiện tại');
        }

        $order->update(['status' => 4]);
        return redirect()->route('orders.show', $order->id)->with('success', 'Yêu cầu hủy đơn hàng thành công');
    }
}
