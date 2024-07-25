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
                    <a href="{{ route('welcome') }}">Shop</a>
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
        </div><!--/col-3-->
    	<div class="col-sm-9">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Profile</a></li>
                <li class=""><a data-toggle="tab" href="#cart">Cart</a></li>
                <li class=""><a data-toggle="tab" href="#order">Order</a></li>
                <li class=""><a data-toggle="tab" href="#payment">Payment</a></li>
                <li class=""><a data-toggle="tab" href="#shipment">Shipment</a></li>
              </ul>              
            <div class="tab-content">
                <div class="tab-pane active" id="home">
                        <form class="form" action="{{ route('profile.update') }}" method="post" id="registrationForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <input type="hidden" name="province_name" id="province_name">
                            <input type="hidden" name="city_name" id="city_name">
                            <div class="form-group p-3 mb-5">                          
                                <div class="col-xs-6">
                                    <label for="first_name">Name</label>
                                    <input type="text" required class="form-control" value="{{ $user->name }}" name="name" placeholder="first name" title="enter your name">
                                </div>                         
                                <div class="col-xs-6">
                                    <label for="first_name">Email</label>
                                    <input type="text" required class="form-control" value="{{ $user->email }}" name="email" placeholder="first name" title="enter your email">
                                </div>
                            </div>
                            <div class="form-group p-3 mb-5">                          
                                <div class="col-xs-6">
                                    <label for="first_name">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password" title="enter your first name if any.">
                                </div>                         
                                <div class="col-xs-6">
                                    <label for="first_name">Photo</label>
                                    <input type="file" name="photo" id="photoInput">
                                </div>
                            </div>    
                            <div class="form-group p-3 mb-5">                
                                <div class="col-xs-6">
                                    <label for="first_name">Province</label>
                                    <select name="province" class="form-control" id="provinceInput">
                                        <option>-- Select Province --</option>
                                    </select>
                                </div>                         
                                <div class="col-xs-6">
                                    <label for="first_name">City</label>
                                    <select name="city" class="form-control" id="cityInput">
                                        <option>-- Select City --</option>
                                    </select>
                                </div>
                            </div>    
                            <div class="form-group p-3 mb-5">                          
                                <div class="col-xs-6">
                                    <label for="first_name">Phone</label>
                                    <input type="text" required class="form-control" value="{{ $user->details && $user->details->phone ? $user->details->phone : '' }}" name="phone" placeholder="Phone" title="enter your Phone">
                                </div>                         
                                <div class="col-xs-6">
                                    <label for="first_name">Postal Code</label>
                                    <input type="text" required class="form-control" value="{{ $user->details && $user->details->postal_code ? $user->details->postal_code : '' }}" id="postal_code" readonly name="postal_code" placeholder="Postal Code" title="enter your Postal Code">
                                </div>
                            </div>
                            <div class="form-group p-3 mb-5">                          
                                <div class="col-xs-6">
                                    <label for="first_name">Gender</label>
                                    <select name="gender" class="form-control" id="">
                                        <option value="man" <?= ($user->details && $user->details->gender) == 'man' ? 'selected' : '' ?>>Man</option>
                                        <option value="women" <?= ($user->details && $user->details->gender) == 'women' ? 'selected' : '' ?>>Women</option>
                                    </select>
                                </div>                      
                                <div class="col-xs-6">
                                    <label for="first_name">Detail Address</label>
                                    <textarea required name="detail_address" class="form-control" id="" cols="30" rows="10">{{ $user->details && $user->details->detail_address ? $user->details->detail_address : '' }}</textarea>
                                </div>   
                            </div>
                            <div class="form-group p-3 mb-5 pb-5">
                                <div class="col-xs-12">
                                        <br>
                                        <button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                                        <button class="btn" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                                </div>
                            </div>
                        </form>                    
                    <hr>
                </div>
                <div class="tab-pane" id="cart">    
                    <div class="container mt-5">
                        @foreach(Auth::user()->carts as $c)
                        <div class="card mb-3">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center" style="width: 75%;">
                                    <input type="checkbox" class="mr-3 cart-checkbox" data-cart-id="{{ $c->id }}" style="width: 15%;">
                                    <div style="width: 85%;">                 
                                        <div class="mt-3 mb-3">
                                            <img src="{{ asset($c->product->photo ? 'image/photo-product/' . $c->product->photo : '') }}" alt="{{ $c->product->name }}" class="showcase-img" width="100">
                                        </div>
                                        <h5 class="card-title mb-0">{{ $c->product->name }}</h5>
                                        <p class="card-text mb-2">Rp. {{ number_format($c->product->price, 0, ',', '.') }}</p>
                                        <p class="card-text text-muted mb-0">Jumlah : {{ $c->amount }}</p>
                                    </div>
                                </div>
                                <button class="btn btn-danger btn-sm delete-btn" data-cart-id="{{ $c->id }}" style="width: 25%;">Delete</button>
                            </div>
                        </div>
                        @endforeach
                        <div style="display: flex;">
                            <input type="checkbox" value="true" style="width: 2%; margin-right: 10px;" name="usePoint" id="usePoint"> 
                            <span>Gunakan <span class="text-warning">{{ $user->details->point }}</span> Point</span>
                        </div>
                    <button class="btn btn-primary mt-3" id="order-btn">Order</button>
                    </div>
                </div>
                <div class="tab-pane" id="order">    
                    @foreach(Auth::user()->orders as $order)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Order ID: {{ substr($order->id, 0, 8) }}</h5>
                                <p class="card-text">Order Status: {{ $order->status }}</p>
                                <p class="card-text">Verified Status: {!! $order->isVerified ? "<span style='color:green;'>True</span>" : "<span style='color:red;'>False</span>" !!}</p>
                                <p class="card-text">Total: Rp. {{ number_format($order->total, 0, ',', '.') }}</p>
                                <p class="card-text">Payment Status: {{ $order->payment_status }}</p>
                                <hr>
                                <h6>Order Items:</h6>
                                <ul class="list-group">
                                    @foreach($order->details as $detail)
                                        <li class="list-group-item">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <img src="{{ asset($detail->product->photo ? 'image/photo-product/' . $detail->product->photo : '') }}" alt="{{ $detail->product->name }}" class="showcase-img" width="100">
                                                    <span>{{ $detail->product->name }}</span>
                                                </div>
                                                <div>
                                                    <div>Amount: {{ $detail->amount }}</div>
                                                    <div>Subtotal: Rp. {{ number_format($detail->subtotal, 0, ',', '.') }}</div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="tab-pane" id="payment"> 
                    @if(sizeof($payment) != 0)
                        @foreach($payment as $p)
                            <div class="card mb-3">
                                <div class="card-body">
                                <h5 class="card-title">Order ID: {{ substr($p->id, 0, 8) }}</h5>
                                    <p class="card-text">Order Status: {{ $p->status }}</p>
                                    <p class="card-text">Total: Rp. {{ number_format($p->total, 0, ',', '.') }}</p>
                                    <p class="card-text">Payment Status: {{ $p->payment_status }}</p>
                                </div>
                                @if($p->payment_status != 'SUCCESS')
                                    <button class="btn btn-primary mt-3" data-order-id="{{ $p->id }}" id="pay-btn">Pay Now</button> 
                                @endif
                            </div>
                        @endforeach 
                    @else
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">All Payments completed</h5>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="tab-pane" id="shipment">    
                    @foreach($user->orders as $o)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Order ID: {{ $o->shipment ? substr($o->shipment->order_id, 0, 8) : '' }}</h5>
                                <p class="card-text">Shipment Price: {{ $o->shipment ? $o->shipment->price : '' }}</p>
                                <p class="card-text">Shipment Courier: {{ $o->shipment ? $o->shipment->courier : '' }}</p>
                                <p class="card-text">Shipment Estimate: {{ $o->shipment ? $o->shipment->estimate : '' }}</p>
                                <p class="card-text">Shipment Resi: {{ $o->shipment ? $o->shipment->resi : '' }}</p>
                                <p class="card-text">Shipment Status: {{ $o->shipment ? $o->shipment->status : '' }}</p>
                                <p class="card-text">Shipment Price: Rp. {{ $o->shipment ? number_format($o->shipment->price, 0, ',', '.') : '' }}</p>
                            </div>
                        </div>
                    @endforeach 
                </div>
            </div>
        </div>
    </div><!--/row-->
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
    <script>
        $(document).ready(function(){
            let provinceInput = document.querySelector('select[name="province"]');
            let citiesInput = document.querySelector('select[name="city"]');
            let postalCodeArr = [];
            $('#provinceInput').on('change', (e)=> {
                $.ajax({
                    url: '/get-city-by-province/' + e.target.value,
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        $('#province_name').val(e.target.options[e.target.selectedIndex].innerHTML);
                        console.log(response)
                        citiesInput.innerHTML = '';
                        response.forEach(city => {
                            const option = document.createElement('option');
                            option.value = city.city_id;
                            option.textContent = city.city_name;
                            option.selected = '<?= $user->details->city_code ?>' === city.city_id ? true : false;
                            citiesInput.appendChild(option);
                            postalCodeArr.push({[city.city_id] : city.postal_code});
                        });
                        console.log(postalCodeArr)
                        
                    },
                    error: function(response) {
                        console.log(response);
                        alert('Error fetch cities data');
                    }
                })
            });
            $.ajax({
                url: '/get-province',
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    // Handle successful response
                    console.log(response);
                    response.forEach(province => {
                        const option = document.createElement('option');
                        option.value = province.province_id;
                        option.textContent = province.province;
                        option.selected = '<?= $user->details->province_code ?>' === province.province_id ? true : false;
                        provinceInput.appendChild(option);
                    });
                    $('#provinceInput').trigger('change');                    
                },
                error: function(response) {
                    // Handle error response
                    console.log(response);
                    alert('Error adding province');
                }
            });
            
            $('#cityInput').on('change', (e)=>{
                $('#city_name').val(e.target.options[e.target.selectedIndex].innerHTML);
                let selectedCityId = e.target.value;
                let pcode = postalCodeArr.find(city => city.hasOwnProperty(selectedCityId));
                console.log(pcode[selectedCityId], "selected pcode")
                console.log(selectedCityId, "selected id")
                $('#postal_code').val(pcode[selectedCityId]);
            })
        });
        $('#photoInput').on('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById('photoPreview');
                    img.src = e.target.result;
                    img.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    </script> 
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.delete-btn').click(function(){
                if(confirm('Are you sure you want to remove this item from the cart?')) {
                    let cartId = $(this).data('cart-id');
                    $.ajax({
                        url: '/deletefromcart',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: cartId
                        },
                        success: function(response) {
                            console.log(response);
                            $('button[data-cart-id="' + cartId + '"]').closest('.card').remove();
                            window.location.reload();
                        },
                        error: function(response) {
                            // Handle error response
                            console.log(response);
                            alert('Error deleting product from cart');
                        }
                    });
                }
            });

            $('#order-btn').click(function(){
                let selectedItems = [];
                let usePoint = document.getElementById("usePoint")
                $('.cart-checkbox:checked').each(function(){
                    selectedItems.push($(this).data('cart-id'));
                });

                if (selectedItems.length > 0) {
                    $.ajax({
                        url: '/makeorder',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            cart_ids: selectedItems,
                            usePoint: usePoint.checked
                        },
                        success: function(response) {
                            console.log(response);
                            alert('Order placed successfully');
                            location.reload();
                        },
                        error: function(response) {
                            console.log(response);
                            alert('Error placing order');
                        }
                    });
                } else {
                    alert('Please select at least one item to order.');
                }
            });
            $('#pay-btn').click(function(){
                let orderId = $(this).data('order-id');

                if (orderId !== null) {
                    $.ajax({
                        url: '/payorder',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            order_id: orderId
                        },
                        success: function(response) {
                            console.log(response.snapToken);
                            snap.pay(response.snapToken, {
                                    onSuccess: function(result) {
                                        console.log(result)
                                    },
                                    onPending: function(result) {
                                        console.log(result)
                                    },
                                    onError: function(result) {
                                        console.log(result)
                                    }
                            });
                        },
                        error: function(response) {
                            console.log(response);
                            alert('Error placing order');
                        }
                    });
                } else {
                    alert('Please select at least one item to order.');
                }
            });
        });
    </script>                                          
</body>
</html>
