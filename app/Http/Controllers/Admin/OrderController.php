<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\OrderConfirmationMail;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function listOrders()
    {
        $orders = Order::all();
        return view('admin.order_list', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.detail', compact('order'));
    }

    public function confirm($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 1;
        $order->save();
        return redirect()->route('admin.order.list')->with('message', 'Đơn hàng đã được xác nhận.');
    }

    public function delete($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('admin.order.list')->with('message', 'Đơn hàng đã được xóa.');
    }

    public function detail($id)
    {
        $order = Order::findOrFail($id); // Lấy đơn hàng theo ID
        return view('admin.order_detail', compact('order'));
    }


    public function confirmOrder($orderId)
    {
        // Lấy đơn hàng từ database
        $order = Order::findOrFail($orderId);

        // Cập nhật trạng thái đơn hàng (ví dụ: đã xác nhận)
        $order->status = 1; // Thay đổi trạng thái đơn hàng nếu cần
        $order->save();

        // Gửi email xác nhận
        Mail::to($order->email)->send(new OrderConfirmationMail($order));

        // Trả về thông báo thành công và redirect
        return redirect()->route('order.confirmation')->with('message', 'Đơn hàng đã được xác nhận và email đã được gửi!');
    }
}
