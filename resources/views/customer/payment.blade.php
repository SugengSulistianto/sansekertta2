@extends('customer.layouts.app')
@section('content')
<div class="container">    
    @if(sizeof($user->orders) != 0)
        <div class="container">    
            <div class="card mb-3">
                @foreach(Auth::user()->orders as $order)
                    <div class="card-body">
                        <ul class="list-group">
                            <div class="card-body list-group-item">
                                <p class="card-text">Payment Status: {{ $order->payment_status }}</p>
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
                                @if($order->payment_status != 'SUCCESS')
                                    <button class="btn btn-primary mt-1" data-order-id="{{ $order->id }}" id="pay-btn">Pay Now</button> 
                                @endif
                            </div>
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">All Payments completed</h5>
            </div>
        </div>
    @endif
</div>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function(){
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
@endsection