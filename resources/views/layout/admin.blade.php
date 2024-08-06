<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
   <style>
        .img-fixed {
            height: 400px; /* Đặt chiều cao cố định cho hình ảnh */
            object-fit: cover; /* Cắt hình ảnh để giữ tỷ lệ */
            width: 100%; /* Đảm bảo hình ảnh chiếm toàn bộ chiều rộng của thẻ card */
        }
        .carousel-item img {
            height: 500px; /* Adjust the height as needed */
            object-fit: cover;
            width: 100%;
        }
        .category-card:hover {
        transform: scale(1.05);
        transition: transform 0.3s ease;
        }
        .product-card:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
        }
        .img-fixed {
            height: 200px;
            object-fit: cover;
        }
        .container-fluid {
            background-color: #79dbe8; /* Màu nền của container */
            color: #f1f1f1; /* Màu chữ */
            padding: 20px;
        }
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .login-box {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            color: black;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .register-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .register-box {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            color: black;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }


    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('home')}}">VuNguyen Điện tử</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('product.search')}}">Products</a>
                        
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('product.search')}}">Categories</a>
                    </li>
                    <li class="nav-item">
                        @if(Auth::check())
                        <a class="nav-link" href="{{route('history.index')}}">Đơn Hàng</a>
                        @else
                        <a class="nav-link" href="{{route('login')}}"  onclick="return confirmLogin()">Đơn Hàng</a>
                        
                        @endif
                    </li>
                    <li class="nav-item">
                        @if(Auth::check())
                        <a class="nav-link" href="{{ route('detailUsers', Auth::user()->id) }}">Chi tiết tài khoản</a>
                        @else
                        <a class="nav-link" href="{{route('login')}}"  onclick="return confirmLogin()">Chi tiết tài khoản</a>
                        
                        @endif
                    </li>
                    <li class="nav-item">
                    <li class="nav-item">
                        @if(Auth::check() && Auth::user()->role == 1)
                            <!-- Nếu người dùng là admin, hiển thị liên kết đến trang admin -->
                            <a class="nav-link" href="{{route('admin') }}">Quản Lý Admin</a>
                        @endif
                    </li>


                </ul>
               <ul class="navbar-nav">
                <li class="nav-item">
                    @if (Auth::check())
                        <a class="nav-link" href="{{route('cart.index') }}">Cart <i class="fa-solid fa-cart-shopping"></i></a>
                    @else
                        <a class="nav-link" href="{{route('login')}}"  onclick="return confirmLogin()">Cart <i class="fa-solid fa-cart-shopping"></i></a>
                    @endif
                </li>

                    <li class="nav-item">
                        @auth
                            <form action="{{ route('logout') }}" method="POST" class="d-flex">
                                @csrf
                                <button type="submit" class="btn btn-link">Logout</button>
                            </form>
                        @else
                            <a class="nav-link" href="{{route('login')}}">Login</a>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
        
    </div>


    <footer class="bg-light text-center text-lg-start mt-4">
    <div class="container p-4">
        <div class="row">
            <!-- About Section -->
            <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase font-weight-bold">Văn Mạc Computer</h5>
                <p>
                    We offer the best products at unbeatable prices. Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                </p>
            </div>
            <!-- Contact Section -->
            <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase font-weight-bold">Contact</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="#!" class="text-dark">Contact Us</a>
                    </li>
                    <li class="mb-2">
                        <a href="#!" class="text-dark">Support</a>
                    </li>
                    <li class="mb-2">
                        <a href="#!" class="text-dark">Privacy Policy</a>
                    </li>
                    <li class="mb-2">
                        <a href="#!" class="text-dark">Terms of Service</a>
                    </li>
                </ul>
            </div>
            <!-- Social Media Section -->
            <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
                <h5 class="text-uppercase font-weight-bold">Follow Us</h5>
                <ul class="list-unstyled d-flex justify-content-center">
                    <li class="me-3">
                        <a href="#!" class="text-dark">
                            <i class="fab fa-facebook-f fa-2x"></i>
                        </a>
                    </li>
                    <li class="me-3">
                        <a href="#!" class="text-dark">
                            <i class="fab fa-twitter fa-2x"></i>
                        </a>
                    </li>
                    <li class="me-3">
                        <a href="#!" class="text-dark">
                            <i class="fab fa-instagram fa-2x"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#!" class="text-dark">
                            <i class="fab fa-linkedin fa-2x"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="text-center p-3 bg-dark text-light">
        © 2024 Văn Mạc Computer
    </div>
</footer>

<!-- Add this script in your Blade template if not already included -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>


<!-- Add this script in your Blade template if not already included -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
$(document).ready(function() {
    // Increase quantity
    $('.increase-quantity').click(function() {
        let row = $(this).closest('tr');
        let input = row.find('.quantity-input');
        let currentQuantity = parseInt(input.val(), 10);
        input.val(currentQuantity + 1).trigger('change');
    });

    // Decrease quantity
    $('.decrease-quantity').click(function() {
        let row = $(this).closest('tr');
        let input = row.find('.quantity-input');
        let currentQuantity = parseInt(input.val(), 10);
        if (currentQuantity > 1) {
            input.val(currentQuantity - 1).trigger('change');
        }
    });

    // Handle quantity change
    $('.quantity-input').on('change', function() {
        let row = $(this).closest('tr');
        let itemId = row.data('item-id');
        let quantity = $(this).val();

        $.ajax({
            url: '{{ route('cart.updateQuantity', '') }}/' + itemId,
            type: 'PATCH',
            data: {
                _token: '{{ csrf_token() }}',
                quantity: quantity
            },
            success: function(response) {
                if (response.success) {
                    row.find('.total-price').text('$' + response.total);
                    $('#cart-total').text('$' + response.cartTotal);
                }
            }
        });
    });

    // Handle "Update Cart" button click
    $('#update-cart-btn').click(function() {
        let form = $('#cart-form');
        $.ajax({
            url: form.attr('action'),
            type: 'PUT',
            data: form.serialize(),
            success: function(response) {
                alert('Cart updated successfully!');
            },
            error: function() {
                alert('An error occurred while updating the cart.');
            }
        });
    });

    // Confirm item removal
    document.querySelectorAll('form[action*="/cart/remove"]').forEach(form => {
        form.addEventListener('submit', function(event) {
            if (!confirm('Are you sure you want to remove this item?')) {
                event.preventDefault();
            }
        });
    });
});


    // Đối tượng xác nhận để quản lý các thông báo
    const confirmation = {
        login: 'Bạn Cần Đăng NHập Để Xem. Bạn Có Muốn Đăng Nhập Ngay KHông ?',
        addToCart: 'Thêm vào giỏ hàng thành công',
        updateCart: 'Cap nhap thanh cong',
        order: 'Dat hang thanh cong',
        removeItem: 'Are you sure you want to remove this item from your cart?'
    };

    // Hàm xác nhận
    function confirmLogin() {
        return confirm(confirmation.login);
    }

    function confirmCart() {
        return confirm(confirmation.addToCart);
    }

    function confirmCartUpdate() {
        return confirm(confirmation.updateCart);
    }

    function confirmOrder() {
        return confirm(confirmation.order);
    }
    function confirmLoginSuccess() {
        return confirm(confirmation.LoginSuccess);
    }
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    </script>    

</body>
</html>
