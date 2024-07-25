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
                                <h3>Shipment</h3>
                                <div class="form-group">
                                    <label>Courier</label>
                                    <select name="courier" class="form-control" id="">
                                        <option>-- Pilih Kurir --</option>
                                        <option value="jne" <?php $order->shipment && $order->shipment->courier == 'jne' ? 'selected' : '' ?>>JNE</option>
                                        <option value="pos" <?php $order->shipment && $order->shipment->courier == 'pos' ? 'selected' : '' ?>>POS Indonesia</option>
                                        <option value="tiki" <?php $order->shipment && $order->shipment->courier == 'tiki' ? 'selected' : '' ?>>TIKI</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Service</label>
                                    <select name="service" class="form-control" id="service">
                                        <option>-- Pilih Layanan --</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" readonly value="{{ $order->shipment ? $order->shipment->price : '' }}" name="price" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Estimate</label>
                                    <input type="text" readonly value="{{ $order->shipment ? $order->shipment->estimate : '' }}" name="estimate" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Resi</label>
                                    <input type="text" value="{{ $order->shipment ? $order->shipment->resi : '' }}" name="resi" class="form-control">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" id="submitBtn" class="btn btn-primary">Verif</button>
                                <a href="{{ route('admin.order.delete', ['id' => $order->id]) }}" class="btn btn-danger">Delete</a>
                                <a href="{{ route('admin.order.index') }}" class="btn btn-warning">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        let servicesArr = [];
        document.querySelector('select[name="courier"]').addEventListener('change', function () {
            const selectedKurir = this.value;
            const totalWeight = <?= $totalWeight ?>;
            const origin = <?= $storeinfo != NULL ? $storeinfo->city_code : '39' ?>;
            const destination = <?= $order->user->details->city_code != NULL ? $order->user->details->city_code : '0' ?>;
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
            
            // fetch('/get-cost?origin=' + origin + '&destination=' + destination + '&weight=' + totalWeight + '&courier=' + selectedKurir, {
            //     method: 'GET',
            // })
            // .then(response => response.json())
            // .then(data => {
            //     let services = document.querySelector('select[name="service"]');
            //     services.innerHTML = '<option>-- Select Services --</option>';
            //     console.log(data)
            //     data[0].costs.forEach(service => {
            //         const option = document.createElement('option');
            //         option.value = selectedKurir + "," + service.service + "," + service.cost[0].value;
            //         option.textContent = service.service + " - " + service.cost[0].value + " - etd : " + service.cost[0].etd;
            //         services.appendChild(option);
            //     });            
            // })
            // .catch(error => console.error('Error:', error));
        });
    </script>
@endsection
