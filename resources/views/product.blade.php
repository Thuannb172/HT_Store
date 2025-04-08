@extends('main')
@section('content')
<section class="product-detail">
    <div class="container">
        <div class="product-title">
            <p>Sản phẩm</p>
            <i class="fa-solid fa-arrow-right"></i>
            <p>{{ $product->name }}</p>
        </div>
        <div class="row">
            <div class="col-7 product-detail-left">
                <!-- Ảnh chính của sản phẩm -->
                <img id="mainImage" src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                
                <!-- Các ảnh phụ -->
                <div class="product-image-items">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" onclick="changeImage(this)">
                    
                    @if (!empty($product->images))
                        @php
                            // Kiểm tra nếu images là một chuỗi JSON
                            $images = is_string($product->images) ? json_decode($product->images, true) : $product->images;
                        @endphp
                        @foreach ($images as $image)
                            <img src="{{ asset($image) }}" alt="{{ $product->name }}" onclick="changeImage(this)">
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-5 product-detail-right">
                <div class="product-right-infor">
                    <h5>{{ $product->name }}</h5>
                    @if ($product->price_sale)
                        <p class="price-normal"><s>{{ number_format($product->price_nomal) }}₫</s> 
                        <span class="text-danger" >{{ number_format($product->price_sale) }}₫</span></p>
                    @else
                        <p>{{ number_format($product->price_nomal) }}₫</p>
                    @endif
                </div>
                <div class="product-right-des">
                    <h5>Tính năng nổi bật</h5>
                    <p>{{ $product->description }}</p>
                </div>
                <div class="product-right-des">
                    <h5>Mô tả sản phẩm</h5>
                    <p>{{ $product->content }}</p>
                </div>
                <div class="product-right-quantity">
                    <h5>Số lượng</h5>
                    <div class="product-quatity-input">
                        <i class="fa-regular fa-square-minus" onclick="changeQuantity(-1)"></i>
                        <input id="quantityInput" type="text" value="1" oninput="validateQuantity()">
                        <i class="fa-regular fa-square-plus" onclick="changeQuantity(1)"></i>
                    </div>
                </div>                    
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" id="quantityInputValue" value="1">
                    <div class="product-right-addcart">
                        <button type="submit" class="btn btn-primary w-100">Thêm vào giỏ hàng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    function changeImage(imageElement) {
        var newSrc = imageElement.src;
        document.getElementById('mainImage').src = newSrc;
    }
</script>
@endsection
