@extends('admin.parts.main')
@section('content')
<div class="main-content">
    @if ($errors->any())
    <div class="alert-error">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="main-content-form">
        <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">Tên sản phẩm</label>
                <input type="text" name="name" value="{{ $product->name }}" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label">Giá bán</label>
                <input type="number" name="price_nomal" value="{{ $product->price_nomal }}" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label">Giá giảm (nếu có)</label>
                <input type="number" name="price_sale" value="{{ $product->price_sale }}" class="form-input">
            </div>

            <div class="form-group">
                <label class="form-label">Ảnh sản phẩm</label>
                <input type="file" name="image" class="form-file">
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="form-image">
            </div>

            <div class="form-buttons">
                <button type="submit" class="action-btn update-btn">Cập nhật</button>
                <a href="{{ route('admin.product.list') }}" class="action-btn back-btn">Quay lại</a>
            </div>

        </form>
    </div>
</div>
@endsection