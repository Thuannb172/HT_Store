<div class="sidebar d-flex flex-column p-3" id="sidebar">
    <div class="sidebar-logo">
        <a href="/admin"><img src="{{asset('backend/asset/images/logo_transparent.png')}}" alt=""></a>
    </div>
    <div class="sidebar-conntent">
        <div class="content-dashboard">
            <a href="/admin"><i class="fas fa-th"></i> Dashboard</a>
        </div>
        <div class="content-cart">
            <a href="#" class="toggle-menu"><i class="fas fa-shopping-cart"></i> Giỏ Hàng</a>
            <ul class="submenu">
                <li><a href="/admin/order/list">Danh Sách</a></li>
            </ul>
        </div>
        <div class="content-product">
            <a href="#" class="toggle-menu"><i class="fas fa-tags"></i> Sản Phẩm</a>
            <ul class="submenu">
                <li><a href="/admin/product/list">Danh Sách</a></li>
                <li><a href="/admin/product/create">Thêm</a></li>
            </ul>
        </div>                
    </div>