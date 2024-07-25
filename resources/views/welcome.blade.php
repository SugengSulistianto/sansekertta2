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
          <img src="{{ url('front') }}/assets/images/logo/logo.png" alt="Sanskertta Store" width="140" height="85">
        </a>
        <div class="header-search-container">
          <form action="{{ route('searchproduct') }}" method="post">
            @csrf
            <input type="search" name="search" class="search-field" placeholder="Enter product name...">
            <button class="search-btn">
              <ion-icon name="search-outline"></ion-icon>
            </button>
          </form>
        </div>
        <div class="header-user-actions">
            <a href="{{ route('profile.customer') }}" class="action-btn">
              <ion-icon name="person-outline"></ion-icon>
            </a>
            <a href="{{ route('profile.customer') }}" class="action-btn">
              <ion-icon name="bag-handle-outline"></ion-icon>
              <span class="count">{{ Auth::user() ? Auth::user()->carts->count() : 0 }}</span>
            </a>
        </div>
      </div>
    </div>
    <nav class="desktop-navigation-menu">
      <div class="container">
        <ul class="desktop-menu-category-list">
          <li class="menu-category">
            <a href="{{ route('welcome') }}" class="menu-title">Home</a>
          </li>
          <li class="menu-category">
            <a href="#" class="menu-title">Categories</a>
            <div class="dropdown-panel">
                @foreach ($chunked_categories as $chunk)
                  <ul class="dropdown-panel-list">
                    @foreach ($chunk as $category)
                      <li class="panel-list-item">
                        <a href="{{ route('categorydetail', ['code' => $category->code]) }}">{{ $category->name }}</a>
                      </li>
                    @endforeach
                  </ul>
                @endforeach
            </div>
          </li>
        </ul>
      </div>
    </nav>

    <div class="mobile-bottom-navigation">
      <button class="action-btn" data-mobile-menu-open-btn>
        <ion-icon name="menu-outline"></ion-icon>
      </button>
      <a href="{{ route('profile.customer') }}" class="action-btn">
        <ion-icon name="bag-handle-outline"></ion-icon>
        <span class="count">{{ Auth::user() ? Auth::user()->carts->count() : 0 }}</span>
      </a>
      <a href="{{ route('welcome') }}" class="action-btn">
        <ion-icon name="home-outline"></ion-icon>
      </a>
      <button class="action-btn" data-mobile-menu-open-btn>
        <ion-icon name="grid-outline"></ion-icon>
      </button>
    </div>

    <nav class="mobile-navigation-menu  has-scrollbar" data-mobile-menu>
      <div class="menu-top">
        <h2 class="menu-title">Menu</h2>
        <button class="menu-close-btn" data-mobile-menu-close-btn>
          <ion-icon name="close-outline"></ion-icon>
        </button>
      </div>

      <ul class="mobile-menu-category-list">
        <li class="menu-category">
          <a href="{{ route('welcome') }}" class="menu-title">Home</a>
        </li>
        @foreach ($categories_popular as $cp)
          <li class="menu-category">
            <a class="accordion-menu" href="{{ route('categorydetail', ['code' => $cp->code]) }}">
              <p class="menu-title">{{ $cp->name }}</p>
              <div>
                <ion-icon name="add-outline" class="add-icon"></ion-icon>
                <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
              </div>
            </a>            
          </li>
        @endforeach
      </ul>

      <div class="menu-bottom">
        <ul class="menu-social-container">
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
      </div>
    </nav>
  </header>
  <!--
    - MAIN
  -->
  <main>
    <!--
      - BANNER
    -->
    <div class="banner">
      <div class="container">
        <div class="slider-container has-scrollbar">
          <div class="slider-item">
            <img src="{{ url('image') }}/banner/slider1.jpg" alt="" class="banner-img">
            <div class="banner-content">
              <a href="#contact" class="banner-btn">Kontak Kami</a>
            </div>
          </div>
          <div class="slider-item">
            <img src="{{ url('image') }}/banner/slider1.jpg" alt="" class="banner-img">
            <div class="banner-content">
              <a href="#contact" class="banner-btn">Kontak Kami</a>
            </div>
          </div>
          <div class="slider-item">
            <img src="{{ url('image') }}/banner/slider1.jpg" alt="" class="banner-img">
            <div class="banner-content">
              <a href="#contact" class="banner-btn">Kontak Kami</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--
      - CATEGORY
    -->

    <div class="category">
      <div class="container">
        <div class="category-item-container has-scrollbar">
          @foreach($categories_card as $cc)
          <div class="category-item">
            <div class="category-img-box">
              <img src="{{ url('front') }}/assets/images/medicalbag.svg" alt="" width="30">
            </div>
            <div class="category-content-box">
              <div class="category-content-flex">
                <h3 class="category-item-title">{{ $cc->name }}</h3>
                <p class="category-item-amount">{{ $cc->products->count() }}</p>
              </div>
              <a href="{{ route('categorydetail', ['code' => $cc->code]) }}" class="category-btn">Show all</a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    <!--
      - PRODUCT
    -->

    <div class="product-container">
      <div class="container">
        <div class="sidebar  has-scrollbar" data-mobile-menu>
          <div class="sidebar-category">
            <div class="sidebar-top">
              <h2 class="sidebar-title">Category</h2>
              <button class="sidebar-close-btn" data-mobile-menu-close-btn>
                <ion-icon name="close-outline"></ion-icon>
              </button>
            </div>
            <ul class="sidebar-menu-category-list">
              @foreach($categories_side as $c)
              <li class="sidebar-menu-category">
                <a href="{{ route('categorydetail', ['code' => $c->code]) }}" class="sidebar-accordion-menu">
                  <div class="menu-title-flex">
                    <i class="fa fa-plus-square" aria-hidden="true"></i>
                    <p class="menu-title">{{ $c->name }}</p>
                  </div>
                </a>
              </li>
              @endforeach
            </ul>
          </div>

          <div class="product-showcase">
            <h3 class="showcase-heading">best sellers</h3>
            <div class="showcase-wrapper">
              <div class="showcase-container">
                @foreach($bs as $bst)
                <div class="showcase">
                  <a href="{{ route('productdetail', ['code' => $bst->code]) }}">
                    <div class="showcase-img-box">
                      <img src="{{ asset($bst->photo ? 'image/photo-product/' . $bst->photo : '') }}" alt="{{ $bst->name }}" width="75" height="75"
                        class="showcase-img">
                    </div>
                    <div class="showcase-content">
                      <a href="{{ route('productdetail', ['code' => $bst->code]) }}">
                        <h4 class="showcase-title">{{ $bst->name }}</h4>
                      </a>
                      <div class="price-box">
                        <p class="price">Rp. {{ number_format($bst->price, 0, ',', '.') }}</p>
                      </div>
                    </div>
                  </a>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>



        <div class="product-box">
          <!--
            - PRODUCT MINIMAL
          -->
          <div class="product-minimal">
            <div class="product-showcase">
              <h2 class="title">New Arrivals</h2>
              <div class="showcase-wrapper has-scrollbar">
                <div class="showcase-container">
                  @foreach($na1 as $n1)
                    <div class="showcase">
                      <a href="{{ route('productdetail', ['code' => $n1->code]) }}" class="showcase-img-box">
                        <img src="{{ asset($n1->photo ? 'image/photo-product/' . $n1->photo : '') }}" alt="relaxed short full sleeve t-shirt" width="70" class="showcase-img">
                      </a>
                      <div class="showcase-content">
                        <a href="{{ route('productdetail', ['code' => $n1->code]) }}">
                          <h4 class="showcase-title">{{ $n1->name }}</h4>
                        </a>
                        <a href="{{ route('categorydetail', ['code' => $n1->category->code]) }}" class="showcase-category">{{ $n1->category->name }}</a>
                        <div class="price-box">
                          <p class="price">Rp. {{ number_format($n1->price, 0, ',', '.') }}</p>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
                <div class="showcase-container">
                  @foreach($na2 as $n2)
                    <div class="showcase">
                      <a href="{{ route('productdetail', ['code' => $n2->code]) }}" class="showcase-img-box">
                        <img src="{{ asset($n2->photo ? 'image/photo-product/' . $n2->photo : '') }}" alt="relaxed short full sleeve t-shirt" width="70" class="showcase-img">
                      </a>
                      <div class="showcase-content">
                        <a href="{{ route('productdetail', ['code' => $n2->code]) }}">
                          <h4 class="showcase-title">{{ $n2->name }}</h4>
                        </a>
                        <a href="{{ route('categorydetail', ['code' => $n2->category->code]) }}" class="showcase-category">{{ $n2->category->name }}</a>
                        <div class="price-box">
                          <p class="price">Rp. {{ number_format($n2->price, 0, ',', '.') }}</p>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="product-showcase">            
              <h2 class="title">Trending</h2>            
              <div class="showcase-wrapper  has-scrollbar"> 
                <div class="showcase-container">
                  @foreach($tr1 as $n1)
                    <div class="showcase">
                      <a href="{{ route('productdetail', ['code' => $n1->code]) }}" class="showcase-img-box">
                        <img src="{{ asset($n1->photo ? 'image/photo-product/' . $n1->photo : '') }}" alt="relaxed short full sleeve t-shirt" width="70" class="showcase-img">
                      </a>
                      <div class="showcase-content">
                        <a href="{{ route('productdetail', ['code' => $n1->code]) }}">
                          <h4 class="showcase-title">{{ $n1->name }}</h4>
                        </a>
                        <a href="{{ route('categorydetail', ['code' => $n1->category->code]) }}" class="showcase-category">{{ $n1->category->name }}</a>
                        <div class="price-box">
                          <p class="price">Rp. {{ number_format($n1->price, 0, ',', '.') }}</p>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
                <div class="showcase-container">
                  @foreach($tr2 as $n2)
                    <div class="showcase">
                      <a href="{{ route('productdetail', ['code' => $n2->code]) }}" class="showcase-img-box">
                        <img src="{{ asset($n2->photo ? 'image/photo-product/' . $n2->photo : '') }}" alt="relaxed short full sleeve t-shirt" width="70" class="showcase-img">
                      </a>
                      <div class="showcase-content">
                        <a href="{{ route('productdetail', ['code' => $n2->code]) }}">
                          <h4 class="showcase-title">{{ $n2->name }}</h4>
                        </a>
                        <a href="{{ route('categorydetail', ['code' => $n2->category->code]) }}" class="showcase-category">{{ $n2->category->name }}</a>
                        <div class="price-box">
                          <p class="price">Rp. {{ number_format($n2->price, 0, ',', '.') }}</p>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>  
              </div>
            </div>
          </div>
          <!--
            - PRODUCT FEATURED
          -->
          <div class="product-featured">
            <h2 class="title">Hot Deals</h2>
            <div class="showcase-wrapper has-scrollbar">
              @foreach($dod as $dd)
              <div class="showcase-container">
                <div class="showcase">                  
                  <div class="showcase-banner">
                    <img src="{{ asset($dd->photo ? 'image/photo-product/' . $dd->photo : '') }}" alt="{{ $dd->name }}" class="showcase-img">
                  </div>
                  <div class="showcase-content">
                    <a href="{{ route('productdetail', ['code' => $dd->code]) }}">
                      <h3 class="showcase-title">{{ $dd->name }}</h3>
                    </a>
                    <p class="showcase-desc">
                      {{ substr($dd->description, 0, 50) . ' ....' }}
                    </p>
                    <div class="price-box">
                      <p class="price">Rp. {{ number_format($dd->price, 0, ',', '.') }}</p>
                    </div>
                    <button class="add-cart-btn">add to cart</button>
                    <div class="showcase-status">
                      <div class="wrapper">
                        <p>
                          available: <b>{{ $dd->stock }}</b>
                        </p>
                      </div>
                      <div class="showcase-status-bar"></div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          <!--
            - PRODUCT GRID
          -->
          <div class="product-main">
            <h2 class="title">Our Products</h2>
            <div class="product-grid">
              @foreach($products as $pr)
                <div class="showcase">
                  <div class="showcase-banner">
                    <img src="{{ asset($pr->photo ? 'image/photo-product/' . $pr->photo : '') }}" alt="{{ $pr->name }}" width="300" class="product-img default">
                    <img src="{{ asset($pr->photo ? 'image/photo-product/' . $pr->photo : '') }}" alt="{{ $pr->name }}" width="300" class="product-img hover">
                    <!-- <p class="showcase-badge">15%</p> -->
                    <p class="showcase-badge angle">new</p>
                    <div class="showcase-actions">
                      <button class="btn-action">
                        <ion-icon name="eye-outline"></ion-icon>
                      </button>
                      <button class="btn-action">
                        <ion-icon name="bag-add-outline"></ion-icon>
                      </button>
                    </div>
                  </div>
                  <div class="showcase-content">
                    <a href="{{ route('productdetail', ['code' => $pr->code]) }}" class="showcase-category">{{ $pr->name }}</a>
                    <a href="{{ route('productdetail', ['code' => $pr->code]) }}">
                      <h3 class="showcase-title">{{ substr($pr->description, 0, 30) . ' ....' }}</h3>
                    </a>
                    <div class="price-box">
                      <p class="price">Rp. {{ number_format($pr->price, 0, ',', '.') }}</p>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--
      - TESTIMONIALS, CTA & SERVICE
    -->

    <div>
      <div class="container">
        <div class="testimonials-box">
          @foreach($cta as $c)
          <div class="cta-container">
            <img src="{{ asset($c->photo ? 'image/photo-product/' . $c->photo : '') }}" alt="{{ $c->name }}" class="cta-banner" width="350">
            <a href="#" class="cta-content">
              <h2 class="cta-title">{{ $c->name }}</h2>
              <p class="cta-text">Rp. {{ number_format($c->price, 0, ',', '.') }}</p>
              <button class="cta-btn">Shop now</button>
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </main>





  <!--
    - FOOTER
  -->

  <footer id="contact">

    <div class="footer-category footer-cultured">
      <div class="container">
        <h2 class="footer-category-title">Brand directory</h2>
        <div class="footer-category-box">        
            <img src="{{ asset('image/brand_logo/1.jpg') }}" alt="brand" class="" width="300">  
            <img src="{{ asset('image/brand_logo/2.jpg') }}" alt="brand" class="" width="300">
            <img src="{{ asset('image/brand_logo/3.jpg') }}" alt="brand" class="" width="300">  
            <img src="{{ asset('image/brand_logo/4.jpg') }}" alt="brand" class="" width="300"> 
        </div>
      </div>
    </div>

    <div class="footer-nav">
      <div class="container">
        <ul class="footer-nav-list">
          <li class="footer-nav-item">
            <h2 class="nav-title">Popular Categories</h2>
          </li>
          @foreach($categories_popular as $cp)
          <li class="footer-nav-item">
            <a href="{{ route('categorydetail', ['code' => $cp->code]) }}" class="footer-nav-link">{{ $cp->name }}</a>
          </li>
          @endforeach

        </ul>

        <ul class="footer-nav-list">        
          <li class="footer-nav-item">
            <h2 class="nav-title">Products</h2>
          </li>
          @foreach($pb as $cp)
          <li class="footer-nav-item">
            <a href="{{ route('productdetail', ['code' => $cp->code]) }}" class="footer-nav-link">{{ $cp->name }}</a>
          </li>
          @endforeach        
        </ul>

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