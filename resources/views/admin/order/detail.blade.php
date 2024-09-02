@extends('admin.layout.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Detail Order From {{ $order->user->name }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('admin.order.verif') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <h3>Order Data</h3>
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <div class="form-group">
                                    <label>Order Status</label>
                                    <select name="status" class="form-control" id="" required>
                                        <option value="On Process" <?= $order->status == 'On Process' ? 'selected' : '' ?>>On Process</option>
                                        <option value="On Shipment" <?= $order->status == 'On Shipment' ? 'selected' : '' ?>>On Shipment</option>
                                        <option value="Finished" <?= $order->status == 'Finished' ? 'selected' : '' ?>>Finished</option>
                                        <option value="Canceled" <?= $order->status == 'Canceled' ? 'selected' : '' ?>>Canceled</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Order Total</label>
                                    <div>
                                        <input type="number" name="total" value="{{ $order->total }}" class="form-control" readonly required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Order Payment Status</label>
                                    <input type="text" name="payment_status" value="{{ $order->payment_status }}" class="form-control" readonly required>
                                </div>
                                <hr style="background: white;">
                                <h3>Order Details</h3>
                                <div class="form-group p-5">
                                    <ul class="list-group">
                                        <?php
                                            $totalWeight = 0;
                                        ?>
                                        @foreach($order->details as $detail)
                                            <li class="list-group-item">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <img src="{{ asset($detail->product->photo ? 'image/photo-product/' . $detail->product->photo : '') }}" alt="{{ $detail->product->name }}" class="showcase-img" width="100">
                                                        <span class="ps-5">{{ $detail->product->name }}</span>
                                                        {{ $totalWeight += $detail->product->weight }}
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
                                <hr style="background: white;">
                                <h3>Customer Address</h3>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{ $order->user->name }}" class="form-control" readonly required>
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone" value="{{ $order->user->details->phone }}" class="form-control" readonly required>
                                </div>
                                <div class="form-group">
                                    <label>Province</label>
                                    <input type="text" name="province" value="{{ $order->user->details->province }}" class="form-control" readonly required>
                                </div>
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" name="city" value="{{ $order->user->details->city }}" class="form-control" readonly required>
                                </div>
                                <div class="form-group">
                                    <label>Postal Code</label>
                                    <input type="text" name="postal_code" value="{{ $order->user->details->postal_code }}" class="form-control" readonly required>
                                </div>
                                <div class="form-group">
                                    <label>Detail Address</label>
                                    <textarea name="detail_address" class="form-control" id="" cols="30" rows="10" readonly>{{ $order->user->details->detail_address }}</textarea>
                                </div>
                                <hr style="background: white;">
                                <div class="card">
                                    <div class="card-header">
                                        Shipment
                                    </div>
                                <div class="card-body">
                                    Courier : <h5 class="h3 form-control">{{ $order->shipment->courier }}</h5>
                                    Service : <h4 class="h5 form-control">{{ $order->shipment->service }}</h4>
                                    Price : <h3 class="h5 form-control">{{ $order->shipment->price }}</h3>
                                    Estimate : <h3 class="h5 form-control">{{ $order->shipment->estimate }}</h3>
                                    Resi : <input type="text" name="resi" value="{{ $order->shipment->resi }}" class="h5 form-control">
                                </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" id="submitBtn" class="btn btn-primary">Update</button>
                                <a href="{{ route('admin.order.delete', ['id' => $order->id]) }}" class="btn btn-danger">Delete</a>
                                <a href="{{ route('admin.order.index') }}" class="btn btn-warning">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
