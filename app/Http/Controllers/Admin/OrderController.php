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

        // Normalize current status: DB default 0 => treat as 1 (new)
        $current = (int)($order->status ?? 0);
        if ($current === 0) { $current = 1; }

        $newStatus = (int) request('status');
        if (!$newStatus) {
            return redirect()->back()->with('error', 'Trạng thái không hợp lệ');
        }

        // Disallow updates once completed or cancelled
        if (in_array($current, [3,4], true)) {
            return redirect()->back()->with('error', 'Đơn hàng đã ở trạng thái cuối, không thể cập nhật');
        }

        // Allowed transitions: 1->2 (đang giao), 1->4 (hủy), 2->3 (hoàn tất), 2->4 (hủy)
        $allowed = [
            1 => [2,4],
            2 => [3,4],
        ];

        if (!isset($allowed[$current]) || !in_array($newStatus, $allowed[$current], true)) {
            return redirect()->back()->with('error', 'Chuyển trạng thái không hợp lệ');
        }

        $order->update(['status' => $newStatus]);

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
