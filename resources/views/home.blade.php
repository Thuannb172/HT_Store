<!DOCTYPE html>
<html lang="en">

<head>
    @include('parts.head')
</head>

<body>
    <!-- Header -->
    @include('parts.header')
    <!-- End Header -->

    <!-- Slider -->
    <section class="slider">
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="3000">
                    <img src="{{ asset('frontend/asset/images/DCHT.png') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                    <img src="{{ asset('frontend/asset/images/HTHT.png') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                    <img src="{{ asset('frontend/asset/images/TBHT.png') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="3000">
                    <img src="{{ asset('frontend/asset/images/TLHT.png') }}" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <!-- End Slider -->

    <!-- Product -->
    @include('parts.product_new')
    
    <!-- End Product -->

    @include('parts.footer')
</body>

</html>