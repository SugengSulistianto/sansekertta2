@extends('admin.layout.app')
@section('content')
<div class="container-fluid">
	<div class="row">						
		<div class="col-sm-12">
			<div class="card card-primary">
				<div class="card-header text-white">
					<h5><i class="fa fa-shopping-cart"></i> Detail Pesanan
					</h5>
				</div>
				<form action="{{ route('admin.pembayaran.update') }}" method="post" id="form-invoice">
					@csrf
                    <input type="hidden" name="kode" value="{{ $pesanan->kode }}">
                    <div class="card-body">
                        <div id="keranjang" class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <td><b>Tanggal</b></td>
                                    <td><input type="text" readonly="readonly" class="form-control" value="<?php echo date("j F Y, G:i");?>" name="tgl"></td>
                                </tr>
                                <tr>
                                    <td><b>Customer</b></td>
                                    <td><input type="text" readonly="readonly" class="form-control" value="<?php echo $pesanan->pelanggan->name; ?>" name="nama_pelanggan" id="nama_pelanggan"></td>
                                </tr>
                                <tr>
                                    <td><b>Status Pesanan</b></td>
                                    <td>
                                        <select name="status_pesanan" class="form-control" id="">
                                            <option value="penjemputan" <?= $pesanan->status == 'penjemputan' ? 'selected' : '' ?>>Penjemputan</option>
                                            <option value="proses" <?= $pesanan->status == 'proses' ? 'selected' : '' ?>>Proses</option>
                                            <option value="pengiriman" <?= $pesanan->status == 'pengiriman' ? 'selected' : '' ?>>Pengiriman</option>
                                            <option value="selesai" <?= $pesanan->status == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                                            <option value="batal" <?= $pesanan->status == 'batal' ? 'selected' : '' ?>>Batal</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <table class="table table-bordered w-100">
                                <thead>
                                    <tr>
                                        <td> Kode Pesanan</td>
                                        <td> Jenis Layanan</td>
                                        <td> Nama Layanan</td>
                                        <td> Estimasi</td>
                                        <td> Harga</td>
                                        <td style="width:10%;"> Jumlah</td>
                                        <td style="width:20%;"> Subtotal</td>
                                        <td> Kasir</td>
                                    </tr>
                                </thead>
                                <tbody id="list">
                                    @foreach($pesanan->layanan as $index => $l)
                                    <input type="hidden" name="kode_layanan[]" value="{{ $l->pivot->kode_layanan }}">
                                        <tr>
                                            <td>{{ $pesanan->kode }}</td>
                                            <td>{{ $l->jenis->kode }}</td>
                                            <td>{{ $l->jenis->nama }}</td>
                                            <td>{{ $l->estimasi }}</td>
                                            <td>{{ $l->harga }}</td>
                                            <td>{{ $l->pivot->jumlah }}</td>
                                            <td name="subtotal[]">{{ $l->pivot->subtotal }}</td>
                                            <td>
                                                <select name="kasir_id" onchange="updateKasir(this)" class="form-control" id="">
                                                    @foreach($kasir as $k)
                                                        <option value="{{ $k->id }}" <?= $k->id == $pesanan->kasir_id ? 'selected' : '' ?>>{{ $k->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                        </table>
                        <br/>
                        <div id="kasirnya">
                            <table class="table table-stripped">
                                <tr>
                                    <td>Total </td>
                                    <td><input type="text" class="form-control" name="total" value="0" id="total" readonly></td>
                                </tr>
                                <tr>
                                    <td>Metode Pembayaran </td>
                                    <td>
                                        <select name="metode" class="form-control" id="">
                                            <option value="cash">Cash</option>
                                            <option value="transfer">Transfer Bank</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right"></td>
                                    <td align="right">
                                        <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-danger">Kembali</a>
                                        <button class="btn btn-warning">Bayar</button>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>
	

<script>
	let formUpdate = document.getElementById('form-invoice');
	let formToken = document.getElementById('token');
	let total = document.getElementById('total');
	let subtotal = document.getElementsByName('subtotal[]');
    document.addEventListener('DOMContentLoaded', ()=>{
        for(let t of subtotal){
            total.value = parseInt(total.value) + parseInt(t.innerHTML);
        }
    });
    const updateSubTotal = (harga, jumlah, index) => {
        subtotal[index].value = parseInt(harga) * parseInt(jumlah.value);
        total.value = parseInt(total.value) + (parseInt(harga) * parseInt(jumlah.value));
    }

	const closeInvoice = () => {
		let modal = document.getElementById('invoice');
		modal.style.display = 'none';
	}

	const submitUpdatePesanan = () => {
		formUpdate.submit();
	}

    const updateKasir = (e) => {
        document.getElementById('kasir_id').value = e.value;
    }
</script>
<script>
	
</script>
@endsection