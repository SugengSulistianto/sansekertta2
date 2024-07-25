@extends('layouts')

@section('content')
<div class="product-box">
    <div class="product-featured">
        <h2 class="title">Details</h2>
        <div class="showcase2">                  
            <div class="showcase-banner">
                <img src="{{ asset($product->photo ? 'image/photo-product/' . $product->photo : '') }}" alt="{{ $product->name }}" class="showcase-img" style="max-width: 50% !important;margin-bottom: 30px !important;">
            </div>
            <div class="showcase-content">
                <a href="{{ route('productdetail', ['code' => $product->code]) }}" style="margin-bottom: 50px !important;">
                    <h3 class="showcase-title">{{ $product->name }}</h3>
                </a>
                <p class="showcase-desc" style="margin-bottom: 50px !important;">
                    {{ $product->description }}
                </p>
                <div class="price-box">
                    <p class="price">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
                <input type="number" name="amount" class="amount-input" style="border: 1px solid; padding:5px 7px; border-radius: 10px; margin: 10px 0; max-width: 10%;">
                <button class="add-cart-btn">add to cart</button>
                <div class="showcase-status">
                    <div class="wrapper">
                        <p>Stock: <b>{{ $product->stock }}</b></p>
                    </div>
                    <div class="showcase-status-bar2"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let authCheck = <?= Auth::check() ? 'true' : 'false' ?>;
console.log(authCheck);
$(document).ready(function(){
    $('.add-cart-btn').click(function(e){
        e.preventDefault();
        if (!authCheck) {
            window.location.href = '/login';
            return;
        }

        let amount = $('input.amount-input').val();
        let productId = '{{ $product->code }}'; 
        console.log(amount, productId);

        $.ajax({
            url: '/addtocart',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_code: productId,
                amount: amount
            },
            success: function(response) {
                // Handle successful response 
                console.log(response);
                alert('Product added to cart successfully');
                window.location.reload();
            },
            error: function(response) {
                // Handle error response
                console.log(response);
                alert('Error adding product to cart', );
            }
        });
    });
});
</script>
@endsection