<section class="product">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Sản Phẩm Mới</button>
        </li>
    </ul>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
            <div id="carousel-1" class="carousel slide">
                <div class="carousel-inner">
                    @foreach ($products->chunk(5) as $chunk)
                        <div class="carousel-item @if ($loop->first) active @endif">
                            <div class="row g-0">
                                @foreach ($chunk as $product)
                                    <div class="col">
                                        <a href="{{ route('product.show', ['id' => $product->id]) }}">
                                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                                        </a>
                                        <h6>{{ $product->name }}</h6>
                                        @if ($product->price_sale)
                                            <p><s>{{ number_format($product->price_nomal) }}₫</s> <span class="text-danger">{{ number_format($product->price_sale) }}₫</span></p>
                                        @else
                                            <p>{{ number_format($product->price_nomal) }}₫</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carousel-1" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carousel-1" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</section>
