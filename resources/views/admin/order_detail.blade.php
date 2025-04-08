@extends('admin.parts.main')

@section('content')
<div class="main-content">
    <div class="main-content-title">
        <h3>Chi Tiết Đơn Hàng #{{ $order->id }}</h3>
    </div>
    <div class="main-order-detail">
        <!-- Thông tin đơn hàng -->
        <h4>Thông Tin Khách Hàng</h4>
        <table class="customer-info-table">
            <tr><th>Tên</th><td>{{ $order->name ?? 'Không có' }}</td></tr>
            <tr><th>Số Điện Thoại</th><td>{{ $order->phone ?? 'Không có' }}</td></tr>
            <tr><th>Email</th><td>{{ $order->email ?? 'Không có' }}</td></tr>
            <tr><th>Địa Chỉ</th><td>{{ $order->address }}, {{ $order->ward }}, {{ $order->district }}, {{ $order->city }}</td></tr>
            <tr><th>Ghi Chú</th><td>{{ $order->note ?? 'Không có ghi chú' }}</td></tr>
            <tr><th>Ngày Tạo</th><td>{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y H:i:s') }}</td></tr>
            <tr><th>Trạng Thái</th><td>{{ $order->status == 1 ? 'Đã Xác Nhận' : 'Chưa Xác Nhận' }}</td></tr>
        </table>

        <!-- Danh sách sản phẩm -->
        <h4>Danh Sách Sản Phẩm</h4>
        <table class="product-table">
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Giá</th>
                    <th>Số Lượng</th>
                    <th>Thành Tiền</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $orderDetails = $order->order_detail ?? [];
                    $totalAmount = 0;
                @endphp
                @forelse ($orderDetails as $id => $item)
                    @php
                        $subtotal = ($item['price'] ?? 0) * ($item['quantity'] ?? 0);
                        $totalAmount += $subtotal;
                    @endphp
                    <tr>
                        <td>
                            @if (isset($item['product_image']) && !empty($item['product_image']))
                                <img src="{{ asset($item['product_image']) }}" 
                                     alt="{{ $item['product_name'] ?? 'Sản phẩm không tên' }}" 
                                     style="width: 50px; height: auto; object-fit: cover;" 
                                     onerror="this.src=''">
                            @else
                                <span>Không có ảnh</span>
                            @endif
                        </td>
                        <td>{{ $item['product_name'] ?? 'Không xác định' }}</td>
                        <td>{{ number_format($item['price'] ?? 0, 0, ',', '.') }}₫</td>
                        <td>{{ $item['quantity'] ?? 'N/A' }}</td>
                        <td>{{ number_format($subtotal, 0, ',', '.') }}₫</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 20px;">
                            Không có sản phẩm nào trong đơn hàng này.
                        </td>
                    </tr>
                @endforelse
                <tr style="font-weight: bold;">
                    <td colspan="4">Tổng Cộng</td>
                    <td>{{ number_format($totalAmount, 0, ',', '.') }}₫</td>
                </tr>
            </tbody>
        </table>

        <!-- Nút hành động -->
        <div class="action-buttons mt-4">
            @if ($order->status == 0)
                <a href="{{ route('admin.order.confirm', $order->id) }}" class="btn btn-success" 
                   onclick="return confirm('Xác nhận đơn hàng này?')">Xác Nhận Đơn Hàng</a>
            @endif
            <a href="{{ route('admin.order.delete', $order->id) }}" class="btn btn-danger" 
               onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">Xóa Đơn Hàng</a>
            <a href="{{ route('admin.order.list') }}" class="btn btn-secondary">Quay Lại</a>
        </div>
    </div>
</div>

<style>
    .customer-info-table, .product-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    .customer-info-table th, .customer-info-table td,
    .product-table th, .product-table td {
        padding: 10px;
        border: 1px solid #ddd;
    }
    .customer-info-table th, .product-table th {
        background-color: #f5f5f5;
        text-align: left;
    }
    .action-buttons .btn {
        margin-right: 10px;
    }
</style>
@endsection