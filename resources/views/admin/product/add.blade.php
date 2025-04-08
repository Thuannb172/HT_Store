@extends('admin.parts.main')
@section('content')
<div class="main-content">
    @if (isset($success))
    <div class="alert alert-success">
        {{ $success }}
    </div>
    @endif

    @if (isset($error))
    <div class="alert alert-danger">
        {{ $error }}
    </div>
    @endif
    <form method="post" enctype="multipart/form-data" action="/admin/product/add">
        @csrf
        <div class="main-content-input">
            <div class="row">
                <div class="col-8">
                    <input type="text" name="name" placeholder="Tên Sản Phẩm">
                    <input type="number" name="price_nomal" placeholder="Giá bán">
                    <input type="number" name="price_sale" placeholder="Giá giảm">
                    <textarea name="description" placeholder="Đặc điểm nổi bật"></textarea>
                    <textarea name="content" placeholder="Mô tả sản phẩm"></textarea>
                </div>
                <div class="col-4">
                    <!-- Ảnh đại diện -->
                    <div class="main-content-image">
                        <div id="avatar-preview"></div>
                        <input type="file" id="avatar-upload" name="image" accept="image/*" style="display: none;">
                        <button type="button" onclick="document.getElementById('avatar-upload').click()">Chọn ảnh đại diện</button>
                    </div>

                    <!-- Ảnh sản phẩm -->
                    <div class="main-content-image">
                        <div id="product-preview"></div>
                        <input type="file" id="product-upload" name="images[]" accept="image/*" multiple>
                        <button type="button" onclick="document.getElementById('product-upload').click()">Chọn ảnh sản phẩm</button>
                    </div>
                </div>
            </div>
            <button type="submit">Thêm sản phẩm</button>
        </div>
    </form>
</div>
@endsection

@section('footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection