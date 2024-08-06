<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.7.3/dist/css/uikit.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.7.3/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.7.3/dist/js/uikit-icons.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        .uk-navbar-container {
            background-color: #217ad3;
            color: white;
        }
        .uk-navbar-nav > li > a {
            color: white;
        }
        .uk-offcanvas-bar {
            background-color: #1e87f0;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .uk-offcanvas-bar a {
            color: white;
        }
        .uk-card-title {
            color: #1e87f0;
        }
        .menu-item {
            margin: 15px 0;
        }
        .footer {
            background-color: #1e87f0;
            color: white;
            padding: 20px 0;
            margin-top: 40px;
        }
        .uk-card-body {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .uk-grid-item-match {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .custom-container {
            max-width: 1800px;
        }
        .btn-active {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 16px;
        }
        .btn-inactive {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 16px;
        }
        .uk-navbar-right{
            background-color: #1e87f0;
            color: #fffff;
        }
    </style>
</head>
<body>
<div class="uk-offcanvas-content">
    <!-- Navbar -->
    <nav class="uk-navbar-container" uk-navbar>
        <div class="uk-navbar-left">
            <a class="uk-navbar-toggle" uk-toggle="target: #offcanvas-nav-primary">
                <span uk-navbar-toggle-icon></span> <span class="uk-margin-small-left">Menu</span>
            </a>
        </div>
        <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
                <li><a href="#">Profile</a></li>
                <li><a href="{{route('home')}}">Logout</a></li>
            </ul>
        </div>
    </nav>

    <!-- Offcanvas -->
    <div id="offcanvas-nav-primary" uk-offcanvas="mode: push; overlay: true">
        <div class="uk-offcanvas-bar">
            <ul class="uk-nav uk-nav-default uk-width-1-1">
                <li class="uk-active menu-item">
                    <a href="{{route('admin')}}">
                        <span uk-icon="icon: home" ratio="1.5"></span>
                        <span class="uk-margin-small-left">Dashboard</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('products.index')}}">
                        <span uk-icon="icon: cart" ratio="1.5"></span>
                        <span class="uk-margin-small-left">Product Management</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('categories.index')}}">
                        <span uk-icon="icon: list" ratio="1.5"></span>
                        <span class="uk-margin-small-left">Category Management</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('orders.index')}}">
                        <span uk-icon="icon: credit-card" ratio="1.5"></span>
                        <span class="uk-margin-small-left">Order Management</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#">
                        <span uk-icon="icon: comments" ratio="1.5"></span>
                        <span class="uk-margin-small-left">Comment Management</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('statistics.index') }}">
                        <span uk-icon="icon: chart" ratio="1.5"></span>
                        <span class="uk-margin-small-left">Statistics</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('users.index')}}">
                        <span uk-icon="icon: users" ratio="1.5"></span>
                        <span class="uk-margin-small-left">User Management</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="uk-container-expand custom-container">
    @yield('content')
</div>

<!-- Footer -->
<footer class="footer">
    <div class="uk-container uk-text-center">
        <p>&copy; 2024 Vunguyenn the gioi dien tu. All rights reserved.</p>
        <p>
            <a href="#" class="uk-link-light">Privacy Policy</a> |
            <a href="#" class="uk-link-light">Terms of Service</a> |
            <a href="#" class="uk-link-light">Contact Us</a>
        </p>
    </div>
</footer>

{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Dữ liệu doanh thu theo ngày từ Laravel
        const revenueData = @json($revenue_by_date);
        const newRegistrationsData = @json($new_registrations_by_date);
        const soldProductsData = @json($sold_products_by_date);

        const revenueLabels = Object.keys(revenueData);
        const revenueValues = Object.values(revenueData);

        const newRegistrationsLabels = Object.keys(newRegistrationsData);
        const newRegistrationsValues = Object.values(newRegistrationsData);

        const soldProductsLabels = Object.keys(soldProductsData);
        const soldProductsValues = Object.values(soldProductsData);

        // Biểu đồ doanh thu theo ngày
        const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctxRevenue, {
            type: 'line',
            data: {
                labels: revenueLabels,
                datasets: [{
                    label: 'Doanh thu theo ngày',
                    data: revenueValues,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Biểu đồ số lượng đăng ký mới theo ngày
        const ctxNewRegistrations = document.getElementById('newRegistrationsChart').getContext('2d');
        new Chart(ctxNewRegistrations, {
            type: 'bar',
            data: {
                labels: newRegistrationsLabels,
                datasets: [{
                    label: 'Số lượng đăng ký mới theo ngày',
                    data: newRegistrationsValues,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Biểu đồ số lượng sản phẩm đã bán ra theo ngày
        const ctxSoldProducts = document.getElementById('soldProductsChart').getContext('2d');
        new Chart(ctxSoldProducts, {
            type: 'bar',
            data: {
                labels: soldProductsLabels,
                datasets: [{
                    label: 'Số lượng sản phẩm đã bán ra theo ngày',
                    data: soldProductsValues,
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script> --}}
</body>
</html>
