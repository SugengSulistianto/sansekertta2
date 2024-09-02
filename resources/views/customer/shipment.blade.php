@extends('customer.layouts.app')
@section('content')
<div class="container">    
    @foreach($user->orders as $o)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Order ID: {{ $o->shipment ? substr($o->shipment->order_id, 0, 8) : '' }}</h5>
                <p class="card-text">Shipment Price: {{ $o->shipment ? $o->shipment->price : '' }}</p>
                <p class="card-text">Shipment Courier: {{ $o->shipment ? $o->shipment->courier : '' }}</p>
                <p class="card-text">Shipment Estimate: {{ $o->shipment ? $o->shipment->estimate : '' }}</p>
                <p class="card-text">Shipment Resi: {{ $o->shipment ? $o->shipment->resi : '' }}</p>
                <p class="card-text">Shipment Status: {{ $o->shipment ? $o->shipment->shipment_status : '' }}</p>
                <p class="card-text">Shipment Price: Rp. {{ $o->shipment ? number_format($o->shipment->price, 0, ',', '.') : '' }}</p>
                @if(!is_null($o->shipment->shipment_status) && $o->shipment->shipment_status == 'ONDELIVERY')
                    <p class="card-text"><a href="{{ route('comfirm.shipment', ['id' => $o->shipment->id]) }}" class="btn btn-primary" href="">Terima Paket</a></p>
                @endif
            </div>
        </div>
    @endforeach 
</div>
@endsection