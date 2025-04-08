@extends('main')
@section('content')
<section class="order-confirm py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Đơn Hàng Đã Gửi Thành Công</h4>
                    </div>
                    <div class="card-body text-center">
                        <p class="lead">{{ session('message') }}</p>
                        <p>Vui lòng kiểm tra email đã đăng ký để nhận và xác nhận đơn hàng.</p>
                        <a href="{{ route('home') }}" class="btn btn-success mt-3">Tiếp Tục Mua Hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
