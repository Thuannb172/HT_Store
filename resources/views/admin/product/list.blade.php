@extends('admin.parts.main')
@section('content')
<div class="main-content">
    <div class="main-product-list">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Giá Bán</th>
                    <th>Giá Giảm</th>
                    <th>Ngày Đăng</th>
                    <th>Tùy Chỉnh</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($products) && $products->count() > 0)
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td><img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="max-width: 100px;"></td>
                            <td>{{ $product->name }}</td>
                            <td>{{ number_format($product->price_nomal, 0, ',', '.') }}₫</td>
                            <td>{{ $product->price_sale ? number_format($product->price_sale, 0, ',', '.') . '₫' : 'N/A' }}</td>
                            <td>{{ $product->created_at->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('admin.product.edit', $product->id) }}">Sửa</a>
                                <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7">Chưa có sản phẩm nào trong danh sách.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection