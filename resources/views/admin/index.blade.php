@extends('layout.add')

@section('content')
<div class="uk-container uk-margin-top">
    <h1 class="uk-heading-line"><span>Admin</span></h1>

    <!-- Thống kê tổng quan -->
    <div class="uk-grid-match uk-child-width-1-4@m" uk-grid>
        <!-- Ô 1: Số lượng đăng ký mới -->
        <div>
            <div class="uk-card uk-card-default uk-card-body">
                <h3 class="uk-card-title">Số lượng đăng ký mới</h3>
                <p class="uk-text-lead"><strong>{{ $new_registrations }}</strong></p>
            </div>
        </div>

        <!-- Ô 2: Số lượng sản phẩm -->
        <div>
            <div class="uk-card uk-card-default uk-card-body">
                <h3 class="uk-card-title">Số lượng sản phẩm</h3>
                <p class="uk-text-lead"><strong>{{ $total_products }}</strong></p>
            </div>
        </div>

        <!-- Ô 3: Số lượng sản phẩm đã bán ra -->
        <div>
            <div class="uk-card uk-card-default uk-card-body">
                <h3 class="uk-card-title">Số lượng sản phẩm đã bán ra</h3>
                <p class="uk-text-lead"><strong>{{ $total_sold_products }}</strong></p>
            </div>
        </div>

        <!-- Ô 4: Doanh thu tổng -->
        <div>
            <div class="uk-card uk-card-default uk-card-body">
                <h3 class="uk-card-title">Doanh thu tổng</h3>
                <p class="uk-text-lead"><strong>{{ $total_revenue }} VND</strong></p>
            </div>
        </div>
    </div>

    <!-- Biểu đồ -->
    {{-- <div class="uk-grid-match uk-child-width-1-1@s uk-margin-top" uk-grid>
        <div class="uk-width-1-1">
            <div class="uk-card uk-card-default uk-card-body">
                <h3 class="uk-card-title">Biểu đồ thống kê</h3>
                <div class="uk-grid uk-child-width-1-3@m uk-margin-top" uk-grid>
                    <!-- Biểu đồ doanh thu theo ngày -->
                    <div>
                        <div class="uk-card uk-card-default uk-card-body">
                            <h4 class="uk-card-title">Doanh thu theo ngày</h4>
                            <canvas id="revenueChart" width="400" height="300"></canvas>
                        </div>
                    </div>

                    <!-- Biểu đồ số lượng đăng ký mới theo ngày -->
                    <div>
                        <div class="uk-card uk-card-default uk-card-body">
                            <h4 class="uk-card-title">Số lượng đăng ký mới theo ngày</h4>
                            <canvas id="newRegistrationsChart" width="400" height="300"></canvas>
                        </div>
                    </div>

                    <!-- Biểu đồ số lượng sản phẩm đã bán ra theo ngày -->
                    <div>
                        <div class="uk-card uk-card-default uk-card-body">
                            <h4 class="uk-card-title">Số lượng sản phẩm đã bán ra theo ngày</h4>
                            <canvas id="soldProductsChart" width="400" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Các liên kết quản lý -->
    {{-- <div class="uk-grid-match uk-child-width-1-3@m uk-margin-large-top" uk-grid>
        <div>
            <div class="uk-card uk-card-default uk-card-body">
                <h3 class="uk-card-title">Sản phẩm</h3>
                <p>Quản lý sản phẩm của bạn tại đây.</p>
                <a class="uk-button uk-button-primary" href="{{route('products.index')}}">Đi đến Quản lý Sản phẩm</a>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-body">
                <h3 class="uk-card-title">Danh mục</h3>
                <p>Quản lý danh mục của bạn tại đây.</p>
                <a class="uk-button uk-button-primary" href="{{route('categories.index')}}">Đi đến Quản lý Danh mục</a>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-body">
                <h3 class="uk-card-title">Đơn hàng</h3>
                <p>Quản lý đơn hàng của bạn tại đây.</p>
                <a class="uk-button uk-button-primary" href="{{route('orders.index')}}">Đi đến Quản lý Đơn hàng</a>
            </div>
        </div>
    </div>

    <div class="uk-grid-match uk-child-width-1-3@m uk-margin-large-top" uk-grid>
        <div>
            <div class="uk-card uk-card-default uk-card-body">
                <h3 class="uk-card-title">Bình luận</h3>
                <p>Quản lý bình luận người dùng tại đây.</p>
                <a class="uk-button uk-button-primary" href="#">Đi đến Quản lý Bình luận</a>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-body">
                <h3 class="uk-card-title">Thống kê</h3>
                <p>Xem thống kê chi tiết tại đây.</p>
                <a class="uk-button uk-button-primary" href="{{ route('statistics.index') }}">Đi đến Thống kê</a>
            </div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-body">
                <h3 class="uk-card-title">Người dùng</h3>
                <p>Quản lý tài khoản người dùng tại đây.</p>
                <a class="uk-button uk-button-primary" href="{{route('users.index')}}">Đi đến Quản lý Người dùng</a>
            </div>
        </div>
    </div> --}}
</div>
@endsection
