<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    public function index()
{
    $start_date = request('start_date')
        ? Carbon::createFromFormat('Y-m-d', request('start_date'))->startOfDay()
        : now()->startOfMonth()->startOfDay();

    $end_date = request('end_date')
        ? Carbon::createFromFormat('Y-m-d', request('end_date'))->endOfDay()
        : now()->endOfMonth()->endOfDay();

    $orders = Order::where('status', '!=', 5)
        ->when(request('order_id'), function ($query) {
            $query->where('id', request('order_id'));
        })
        ->when(request('full_name'), function ($query) {
            $query->where('full_name', 'like', '%' . request('full_name') . '%');
        })
        ->when(request('status'), function ($query) {
            $query->where('status', request('status'));
        })
        ->whereBetween('created_at', [$start_date, $end_date])
        ->orderBy('created_at', 'DESC')
        ->paginate(15);


    return view('admin.order.index', compact('orders'));
}
    public function getOrderItem($id)
    {
        $order_items = OrderItem::with('product', 'product.images')->where('order_id', $id)->get();
        return view('admin.order.detail', compact('order_items'));
    }

    public function changeStatus($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found');
        }

        if (request('status') === 2 && $order->status !== 1){
            return redirect()->back()->with('error', 'Không thể cập nhật trạng thái "Đang chuẩn bị" khi đơn hàng không phải ở trạng thái "Mới đặt hàng"!');
        }

        if (request('status') === 3 && $order->status !== 2){
            return redirect()->back()->with('error', 'Không thể cập nhật trạng thái "Hoàn Tất" khi đơn hàng không phải ở trạng thái "Đang chuẩn bị"!');
        }

        if ($order->status === 3){
            return redirect()->back()->with('error', 'Đơn hàng đã Hoàn thành không thể tiếp tục cập nhật trạng thái');
        }

        if ($order->status === 3){
            return redirect()->back()->with('error', 'Đơn hàng đã bị Hủy đơn hàng');
        }

        $order->update([
            'status' => request('status')
        ]);

        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công');
    }
    public function delete($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found');
        }

        $orderItemIds = OrderItem::where('order_id', $order->id)->pluck('id');

        OrderItem::destroy($orderItemIds);
        $order->delete();

        return redirect()->back()->with('success', 'Xóa đơn hàng thành công');
    }
}
