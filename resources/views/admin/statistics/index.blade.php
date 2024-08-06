@extends('layout.add')

@section('content')
<div class="uk-container uk-margin-top">
    <h1 class="uk-heading-line"><span>Thống Kê</span></h1>
    
    <div class="uk-grid-match uk-child-width-1-4@m" uk-grid>
        <!-- Ô 1: Số lượng đăng ký mới -->
        <div>
            <div class="uk-card uk-card-default uk-card-body">
                <h3 class="uk-card-title">Số lượng đăng ký mới</h3>
                <p><strong>{{ $new_registrations }}</strong></p>
            </div>
        </div>

        <!-- Ô 2: Số lượng sản phẩm -->
        <div>
            <div class="uk-card uk-card-default uk-card-body">
                <h3 class="uk-card-title">Số lượng sản phẩm</h3>
                <p><strong>{{ $total_products }}</strong></p>
            </div>
        </div>

        <!-- Ô 3: Số lượng sản phẩm đã bán ra -->
        <div>
            <div class="uk-card uk-card-default uk-card-body">
                <h3 class="uk-card-title">Số lượng sản phẩm đã bán ra</h3>
                <p><strong>{{ $total_sold_products }}</strong></p>
            </div>
        </div>

        <!-- Ô 4: Doanh thu tổng -->
        <div>
            <div class="uk-card uk-card-default uk-card-body">
                <h3 class="uk-card-title">Doanh thu tổng</h3>
                <p><strong>{{ $total_revenue }}VND</strong></p>
            </div>
        </div>
    </div>
        
        <div class="uk-width-1-1">
            <div class="uk-card uk-card-default uk-card-body">
                <h3 class="uk-card-title">Doanh thu theo ngày</h3>
                <canvas id="revenueChart" width="600" height="300"></canvas>
            </div>
        </div>

        <div class="uk-width-1-1">
            <div class="uk-card uk-card-default uk-card-body">
                <h3 class="uk-card-title">Số lượng đăng ký mới theo ngày</h3>
                <canvas id="newRegistrationsChart" width="600" height="300"></canvas>
            </div>
        </div>
        
        <div class="uk-width-1-1">
            <div class="uk-card uk-card-default uk-card-body">
                <h3 class="uk-card-title">Số lượng sản phẩm đã bán ra theo ngày</h3>
                <canvas id="soldProductsChart" width="600" height="300"></canvas>
            </div>
        </div>
    </div>
</div>

    
@endsection