<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('images/suu-kids.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">SuuKids</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{route('dashboard.index')}}">
                <div class="parent-icon"> <i class="bx bx-home-circle"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-package'></i>
                </div>
                <div class="menu-title">Sản phẩm</div>
            </a>
            <ul>
                <li>
                    <a href="{{route('product.list')}}"><i class="bx bx-right-arrow-alt"></i>Danh sách</a>
                </li>
                <li>
                    <a href="{{route('product.create')}}"><i class="bx bx-right-arrow-alt"></i>Tạo mới</a>
                </li>
                <li>
                    <a href="{{route('product.unit')}}"><i class="bx bx-right-arrow-alt"></i>Đơn vị</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Kho</div>
            </a>
            <ul>
                <li>
                    <a href="{{route('stock.import')}}"><i class="bx bx-right-arrow-alt"></i>Nhập kho</a>
                    <a href="{{route('stock.import_list')}}"><i class="bx bx-right-arrow-alt"></i>Phiếu nhập kho</a>
                    <a href="{{route('stock.export')}}"><i class="bx bx-right-arrow-alt"></i>Xuất kho</a>
                    <a href="{{route('stock.export_list')}}"><i class="bx bx-right-arrow-alt"></i>Phiếu xuất kho</a>
                    <a href="{{route('stock.available')}}"><i class="bx bx-right-arrow-alt"></i>Tồn kho</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx user"></i>
                </div>
                <div class="menu-title">Nhân viên</div>
            </a>
            <ul>
                <li>
                    <a href="{{route('user.index')}}"><i class="bx bx-right-arrow-alt"></i>Danh sách</a>
                    <a href="{{route('user.create')}}"><i class="bx bx-right-arrow-alt"></i>Tạo mới</a>
                    <a href="{{route('user.group')}}"><i class="bx bx-right-arrow-alt"></i>Nhóm Nv</a>
                    <a href="{{route('user.role')}}"><i class="bx bx-right-arrow-alt"></i>Quyền</a>
{{--                    <a href="{{route('user.available')}}"><i class="bx bx-right-arrow-alt"></i>Tồn kho</a>--}}
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Bán hàng</div>
            </a>
            <ul>
                <li> <a href="ecommerce-products.html"><i class="bx bx-right-arrow-alt"></i>Products</a>
                </li>
                <li> <a href="ecommerce-products-details.html"><i class="bx bx-right-arrow-alt"></i>Product Details</a>
                </li>
                <li> <a href="ecommerce-add-new-products.html"><i class="bx bx-right-arrow-alt"></i>Add New Products</a>
                </li>
                <li> <a href="ecommerce-orders.html"><i class="bx bx-right-arrow-alt"></i>Orders</a>
                </li>
            </ul>
        </li>
    </ul>
    <!--end navigation-->
</div>