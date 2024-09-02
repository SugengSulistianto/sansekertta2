@extends('customer.layouts.app')
@section('content')
<?php
    $totalWeight = 0;
?>
<div class="container">
    @foreach(Auth::user()->carts as $c)
    <?php
       $totalWeight += $c->product->weight;
    ?>
    <div class="card mb-3 shadow-md border-1 rounded-lg py-0">
        <div class="card-body d-flex justify-content-between align-items-center p-4">
            <div class="d-flex align-items-center" style="width: 75%;">
                <input type="checkbox" class="mr-3 cart-checkbox" data-cart-id="{{ $c->id }}" style="width: 20px; height: 20px;">
                <div style="width: calc(100% - 30px);">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset($c->product->photo ? 'image/photo-product/' . $c->product->photo : 'default-image.jpg') }}" alt="{{ $c->product->name }}" class="rounded-circle border" width="80" height="80" style="object-fit: cover;">
                    </div>
                    <h5 class="card-title mb-1 font-weight-bold">{{ $c->product->name }}</h5>
                    <p class="card-text text-muted mb-2">Rp. {{ number_format($c->product->price, 0, ',', '.') }}</p>
                    <p class="card-text my-0 text-muted">Jumlah: <strong>{{ $c->amount }}</strong></p>
                    <p class="card-text my-0 text-muted">Berat: <strong>{{ $c->product->weight }}</strong></p>
                    <p class="card-text my-0 text-muted">Size: <strong>{{ $c->size }}</strong></p>
                </div>
            </div>
            <button class="btn btn-danger btn-sm delete-btn" data-cart-id="{{ $c->id }}" style="width: 120px;">Delete</button>
        </div>
    </div>
    @endforeach
    @if(sizeof(Auth::user()->carts) != 0)

    <div class="d-flex align-items-center mt-3">
        <input type="checkbox" value="true" style="width: 20px; height: 20px; margin-right: 10px;" name="usePoint" id="usePoint"> 
        <span>Gunakan <span class="text-warning font-weight-bold">{{ $user->details->point }}</span> Point</span>
    </div>
    <br><br>
    @endif
    @if(sizeof(Auth::user()->carts) == 0)
        <h3 class="text-center text-muted">Keranjang anda kosong</h3>
    @endif
    @if(sizeof(Auth::user()->carts) != 0)
        <h3 class="text-center text-muted">Pilih Kurir</h3>
        <div class="form-group">
            <label for="">Kurir Pengiriman</label>
            <select name="courier" class="form-control" id="courier">
                <option>-- Pilih Kurir --</option>
                <option value="jne">JNE</option>
                <option value="pos">POS Indonesia</option>
                <option value="tiki">TIKI</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Layanan</label>
            <select name="service" class="form-control" id="service">
                
            </select>
        </div>        
        <div class="form-group">
            <label>Price</label>
            <input type="number" readonly name="price" id="price" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Estimate</label>
            <input type="text" readonly name="estimate" id="estimate" class="form-control" required>
        </div>
        <button class="btn btn-primary mt-4 btn-block" id="order-btn" style="padding: 10px 0; font-size: 16px;">Order</button>
    @endif
</div>
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
                        usePoint: usePoint.checked,
                        courier: document.getElementById('courier').value,
                        price: document.getElementById('price').value,
                        estimate: document.getElementById('estimate').value,
                        service: document.getElementById('service').value
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
    });    
</script>
<script>
    let servicesArr = [];
    document.querySelector('select[name="courier"]').addEventListener('change', function () {
        const selectedKurir = this.value;
        const totalWeight = <?= $totalWeight ?>;
        const origin = <?= $storeinfo != NULL ? $storeinfo->city_code : '39' ?>;
        const destination = <?= Auth::user()->details->city_code != NULL ? Auth::user()->details->city_code : '0' ?>;
        let services = document.querySelector('select[name="service"]');
        let price = document.querySelector('input[name="price"]');
        let estimate = document.querySelector('input[name="estimate"]');
        servicesArr = [];
        $('#service').on('change', (e)=> {
            console.log(e.target.value);
            console.log(servicesArr);
            let s = servicesArr.find(sc => sc.hasOwnProperty(e.target.value));
            console.log(s)
            b = s[e.target.value];
            console.log(b[0])
            price.value = b[0].value
            estimate.value = b[0].etd
        });
        $.ajax({
            url: '/get-cost',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                destination: destination,
                weight: totalWeight,
                courier: selectedKurir
            },
            success: function(response) {
                console.log(response);
                let res = response[0];
                services.innerHTML = '<option>-- Select Services --</option>';
                res.costs.forEach(service => {
                    const option = document.createElement('option');
                    option.value = service.service;
                    option.textContent = service.service + " - " + service.description;
                    services.appendChild(option);
                    servicesArr.push({[service.service] : service.cost});
                });
            },
            error: function(response) {
                console.log(response);
                alert('Error placing order');
            }
        });
    });
</script> 
@endsection