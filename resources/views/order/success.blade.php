@extends('main')
@section('content')
<section class="order-confirm py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card shadow">
            <div class="card-header bg-success text-white">
              <h4 class="mb-0">Đơn hàng #123456 đã được gửi THÀNH CÔNG!</h4>
            </div>
            <div class="card-body text-center">
              <p class="lead">Đơn hàng của bạn đã được xác nhận!</p>
              <p>Vui lòng chú ý điện thoại để nhận hàng trong vài ngày tới.</p>
              <p>Cảm ơn quý khách hàng vì đã tin tưởng và ủng hộ cửa hàng !</p>
              <a href="{{ route('home') }}" class="btn btn-success mt-3">Tiếp tục mua hàng</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection