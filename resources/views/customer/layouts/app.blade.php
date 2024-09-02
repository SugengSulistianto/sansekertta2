<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sanskertta Store Website</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ url('front') }}/assets/css/style-prefix2.css">
    <!------ Include the above in your HEAD tag ---------->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
</head>
<body>
    <header>
        <div class="header-top">
        <div class="container2">
            <ul class="header-social-container">
            <li>
                <a href="#" class="social-link">
                <ion-icon name="logo-facebook"></ion-icon>
                </a>
            </li>
            <li>
                <a href="#" class="social-link">
                <ion-icon name="logo-twitter"></ion-icon>
                </a>
            </li>
            <li>
                <a href="#" class="social-link">
                <ion-icon name="logo-instagram"></ion-icon>
                </a>
            </li>
            <li>
                <a href="#" class="social-link">
                <ion-icon name="logo-linkedin"></ion-icon>
                </a>
            </li>
            </ul>
            <div class="header-alert-news">
            <p>
                <b>Sanskertta Store</b>
            </p>
            </div>
            <div class="header-top-actions">
            </div>
        </div>
        </div>

        <div class="header-main">
        <div class="container">
            <a href="#" class="header-logo">
                <img src="{{ url('front') }}/assets/images/logo/logo.png" alt="Sanskertta Store" width="140" height="85">
            </a>
            <div class="header-user-actions">
                <a href="{{ route('profile.customer') }}" class="action-btn">
                <ion-icon name="person-outline"></ion-icon>
                </a>
            </div>
        </div>
        </div>
    </header>
    <div class="container bootstrap snippet">
        <div class="row" style="min-height: 75vh; padding: 5% 0">
            <div class="col-sm-3">   
                <div class="text-center">
                    <img id="photoPreview" src="{{ ($user->details != null && $user->details->photo != null) ? url('image/photo-customer/' . $user->details->photo) : 'http://ssl.gstatic.com/accounts/ui/avatar_2x.png' }} " class="avatar img-circle img-thumbnail" alt="avatar">
                    
                </div></hr><br>                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="text-warning">Point Kamu : {{ $user->details->point }}</span>
                    </div>
                    <div class="panel-heading">
                        <a href="{{ route('profile.customer') }}">Profile</a>
                    </div>
                    <div class="panel-heading">
                        <a href="{{ route('cart.customer') }}">Cart</a>
                    </div>
                    <div class="panel-heading">
                        <a href="{{ route('order.customer') }}">Order</a>
                    </div>
                    <div class="panel-heading">
                        <a href="{{ route('welcome') }}">Shop</a>
                    </div>
                    <div class="panel-heading">
                        <a href="{{ route('payment.customer') }}">Payment</a>
                    </div>
                    <div class="panel-heading">
                        <a href="{{ route('shipment.customer') }}">Shipment</a>
                    </div>
                    <div class="panel-heading">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                @yield('content')
            </div>
        </div>
    </div>
    <footer style="padding-top: 35px;">
        <div class="footer-nav">
        <div class="container2">
            <ul class="footer-nav-list">        
            <li class="footer-nav-item">
                <h2 class="nav-title">Our Company</h2>
            </li>        
            <li class="footer-nav-item">
                <a href="#" class="footer-nav-link">Delivery</a>
            </li>        
            <li class="footer-nav-item">
                <a href="#" class="footer-nav-link">Legal Notice</a>
            </li>        
            <li class="footer-nav-item">
                <a href="#" class="footer-nav-link">Terms and conditions</a>
            </li>        
            <li class="footer-nav-item">
                <a href="#" class="footer-nav-link">About us</a>
            </li>        
            <li class="footer-nav-item">
                <a href="#" class="footer-nav-link">Secure payment</a>
            </li>        
            </ul>

            <ul class="footer-nav-list">
            <li class="footer-nav-item">
                <h2 class="nav-title">Contact</h2>
            </li>
            <li class="footer-nav-item flex">
                <div class="icon-box">
                <ion-icon name="location-outline"></ion-icon>
                </div>
                <address class="content">
                419 State 414 Rte
                Beaver Dams, New York(NY), 14812, USA
                </address>
            </li>
            <li class="footer-nav-item flex">
                <div class="icon-box">
                <ion-icon name="call-outline"></ion-icon>
                </div>
                <a href="tel:+607936-8058" class="footer-nav-link">(607) 936-8058</a>
            </li>
            <li class="footer-nav-item flex">
                <div class="icon-box">
                <ion-icon name="mail-outline"></ion-icon>
                </div>
                <a href="mailto:example@gmail.com" class="footer-nav-link">example@gmail.com</a>
            </li>
            </ul>

            <ul class="footer-nav-list">
            <li class="footer-nav-item">
                <h2 class="nav-title">Follow Us</h2>
            </li>
            <li>
                <ul class="social-link">
                <li class="footer-nav-item">
                    <a href="#" class="footer-nav-link">
                    <ion-icon name="logo-facebook"></ion-icon>
                    </a>
                </li>
                <li class="footer-nav-item">
                    <a href="#" class="footer-nav-link">
                    <ion-icon name="logo-twitter"></ion-icon>
                    </a>
                </li>
                <li class="footer-nav-item">
                    <a href="#" class="footer-nav-link">
                    <ion-icon name="logo-linkedin"></ion-icon>
                    </a>
                </li>
                <li class="footer-nav-item">
                    <a href="#" class="footer-nav-link">
                    <ion-icon name="logo-instagram"></ion-icon>
                    </a>
                </li>
                </ul>
            </li>
            </ul>
        </div>
        </div>

        <div class="footer-bottom">
        <div class="container">
            <img src="{{ url('front') }}/assets/images/payment.png" alt="payment method" class="payment-img">
            <p class="copyright">
            Copyright &copy; <a href="#">Anon</a> all rights reserved.
            </p>
        </div>
        </div>
    </footer>                                        
</body>
</html>

