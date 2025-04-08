@extends('admin.parts.main')

@section('content')
<div class="main-content">
    <div class="main-content-title">
        <h3>Danh Sách Đơn Hàng</h3>
    </div>
    <div class="main-order-list">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Số Điện Thoại</th>
                    <th>Địa Chỉ</th>
                    <th>Ghi Chú</th>
                    <th>Chi Tiết</th>
                    <th>Ngày</th>
                    <th>Trạng Thái</th>
                    <th>Tùy Biến</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->address }}</td>
                    <td>{{ $order->note }}</td>
                    <td>
                        <a class="edit-class" href="{{ route('admin.order.detail', $order->id) }}">Chi tiết</a>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}</td>
                    <td>
                        @if ($order->status == 0)
                        <a class="confirm-order" href="{{ route('admin.order.confirm', $order->id) }}">Chưa Xác Nhận</a>
                        @else
                        <span>Đã Xác Nhận</span>
                        @endif
                    </td>
                    <td>
                        <a class="delete-class" href="{{ route('admin.order.delete', $order->id) }}"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">Xóa</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection