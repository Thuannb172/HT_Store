<!DOCTYPE html>
<html lang="en">

<head>
    @include('parts.head')
</head>

<body>
    @yield('content')
    <!-- Header -->
    @include('parts.header')
    <!-- End Header -->

    <!-- Product -->
    @include('parts.product_new')
    <!-- End Product -->

    <!-- Footer -->
    @include('parts.footer')
</body>

</html>