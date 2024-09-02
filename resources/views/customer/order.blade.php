@extends('customer.layouts.app')
@section('content')
<div class="container">    
    @foreach(Auth::user()->orders as $order)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Order ID: {{ substr($order->id, 0, 8) }}</h5>
                <p class="card-text">Order Status: {{ $order->status }}</p>
                <p class="card-text">Total: Rp. {{ number_format($order->total, 0, ',', '.') }}</p>
                @if($order->payment_status == 'UNPAID')
                    <a class="btn btn-primary" href="{{ route('payment.customer') }}">Pay Now</a>
                @endif
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
@endsection