@extends('main')
@section('content')
<section class="shopping-cart py-5">
    <div class="container">
        <div class="row">
            <!-- Cột trái: Chi tiết đơn hàng -->
            <div class="col-lg-7">
                <h2 class="mb-4 border-bottom border-dark pb-2">Chi tiết Đơn hàng</h2>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Sản Phẩm</th>
                                <th scope="col">Số Lượng</th>
                                <th scope="col">Thành Tiền</th>
                                <th scope="col">Xóa</th>
                                <th scope="col">Sửa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(session()->get('cart', []) as $id => $item)
                            <tr>
                                <td><img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" style="width:60px;height:60px;object-fit:cover;"></td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>{{ number_format($item['price'] * $item['quantity']) }}₫</td>
                                <td>
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-link text-danger p-0">Xóa</button>
                                    </form>
                                </td>
                                <td>
                                    <button class="btn btn-link text-warning p-0" data-bs-toggle="modal" data-bs-target="#editQuantityModal{{ $id }}">Sửa</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <h4>Tổng Tiền</h4>
                    <h4>{{ number_format($total) }}₫</h4>
                </div>
                <div class="mt-3">
                    <a href="/" class="btn btn-secondary">Tiếp tục Mua hàng</a>
                </div>
            </div>

            <!-- Cột phải: Thông tin Giao hàng -->
            <div class="col-lg-5">
                <form action="{{ route('order.place') }}" method="POST">
                    @csrf
                    <h2 class="mb-4 border-bottom border-dark pb-2">Thông tin Giao hàng</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Tên</label>
                            <input type="text" class="form-control" name="name" placeholder="Nhập tên của bạn" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">SĐT</label>
                            <input type="text" class="form-control" name="phone" placeholder="Nhập SĐT của bạn" required>
                        </div>
                    </div>
                    <!-- Các trường còn lại giữ nguyên -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Nhập email của bạn">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label class="form-label">Tỉnh/TP</label>
                            <select class="form-select" name="city" id="city" required>
                                <option value="">Chọn Tỉnh/TP</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Quận/Huyện</label>
                            <select class="form-select" name="district" id="district" required>
                                <option value="">Chọn Quận/Huyện</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Phường/Xã</label>
                            <select class="form-select" name="ward" id="ward" required>
                                <option value="">Chọn Phường/Xã</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label">Địa Chỉ</label>
                        <input type="text" class="form-control" name="address" placeholder="Nhập địa chỉ cụ thể" required>
                    </div>
                    <div class="col-12 mb-3 note">
                        <label class="form-label">Ghi Chú</label>
                        <textarea name="note" class="form-control"></textarea>
                    </div>

                    <!-- Danh sách sản phẩm được gửi kèm theo đơn hàng -->
                    @foreach(session()->get('cart', []) as $id => $item)
                        <input type="hidden" name="products[{{ $id }}][id]" value="{{ $id }}">
                        <input type="hidden" name="products[{{ $id }}][name]" value="{{ $item['name'] }}">
                        <input type="hidden" name="products[{{ $id }}][price]" value="{{ $item['price'] }}">
                        <input type="hidden" name="products[{{ $id }}][quantity]" value="{{ $item['quantity'] }}">
                        <input type="hidden" name="products[{{ $id }}][image]" value="{{ $item['image'] }}">
                    @endforeach

                    <button type="submit" class="btn btn-primary w-100">Gửi Đơn Hàng</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Modal Sửa số lượng -->
@foreach(session()->get('cart', []) as $id => $item)
<div class="modal fade" id="editQuantityModal{{ $id }}" tabindex="-1" aria-labelledby="editQuantityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editQuantityModalLabel">Sửa số lượng sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cart.update', $id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Số lượng</label>
                        <input type="number" class="form-control" name="quantity" value="{{ $item['quantity'] }}" min="1" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
