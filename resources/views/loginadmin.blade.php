<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sanskertta Store Website</title>
    <link rel="stylesheet" href="{{ url('front') }}/assets/images/logo/favicon.ico">
    <link rel="shortcut icon" href="{{ url('front') }}/assets/images/logo/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{ url('front') }}/assets/css/style-prefix.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        .login-container {
            margin-top: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
        }

        .login-form {
            background-color: #fff;
            padding: 40px 60px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .login-form h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .input-group {
            position: relative;
            margin-bottom: 30px;
        }

        .input-group input {
            width: 100%;
            padding: 10px 10px 10px 40px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
            transition: border-color 0.3s;
        }

        .input-group label {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #999;
            pointer-events: none;
            transition: all 0.3s;
        }

        .input-group input:focus {
            border-color: #333;
        }

        .input-group input:focus + label,
        .input-group input:not(:placeholder-shown) + label {
            top: 0;
            left: 40px;
            background-color: #fff;
            padding: 0 5px;
            color: #333;
            font-size: 12px;
        }

        button {
            width: 100%;
            padding: 10px 0;
            border: none;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #555;
        }

    </style>
</head>
<body>
  <header>
    <div class="header-top">
      <div class="container">
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
        <a href="{{ route('welcome') }}" class="header-logo">
          <img src="{{ url('front') }}/assets/images/logo/logo.png" alt="Sansketta's logo" width="140" height="85">
        </a>
        <div class="header-user-actions">
            <a href="{{ route('profile.customer') }}" class="action-btn">
              <ion-icon name="person-outline"></ion-icon>
            </a>
        </div>
      </div>
    </div>
  </header>
  <main>
    <div class="banner">
        <div class="login-container">
            <div class="login-form">
                <h2>Admin Login</h2>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group">
                        <input type="text" id="username" name="email" required>
                        <label for="username">Email</label>
                    </div>
                    <div class="input-group">
                        <input type="password" id="password" name="password" required>
                        <label for="password">Password</label>
                    </div>
                    <button type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
  <footer style="padding-top: 35px;">
    <div class="footer-nav">
      <div class="container">
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
  <!--
    - custom js link
  -->
  <script src="{{ url('front') }}/assets/js/script.js"></script>

  <!--
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
