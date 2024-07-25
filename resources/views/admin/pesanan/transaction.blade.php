@extends('admin.layout.app')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card card-primary mb-3">
				<div class="card-header text-white">
					<h5><i class="fa fa-list"></i> Daftar Layanan</h5>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered table-striped" id="example1">
							<thead>
								<tr>
									<th>No.</th>
									<th>Kode</th>
									<th>Jenis Layanan</th>
									<th>Nama</th>
									<th>Estimasi</th>
									<th>Harga</th>
									<th>Aksi</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
									@foreach($layanan as $index => $row)
								<tr>
									<td>{{ ++$index }}</td>
									<td>{{ $row->kode }}</td>
									<td>{{ $row->jenis->nama }}</td>
									<td>{{ $row->nama }}</td>
									<td>{{ $row->estimasi }} Hari</td>
									<td>{{ $row->harga }}</td>
									<td><input type="number" id="<?= $row->kode ?>jumlahtoadd" value="" class="form-control"></td>
									<td><button class="btn btn-success" onclick="addtocart('<?= $row->kode ?>' , '<?= $row->jenis->nama ?>' , '<?= $row->nama ?>' , '<?= $row->estimasi ?>' , '<?= $row->harga ?>')"><i class="fa fa-shopping-cart"></i></button></td>
								</tr>
									@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-12">
			<div class="card card-primary mb-3">
				<div class="card-header text-white">
					<h5><i class="fa fa-list"></i> Daftar Customer</h5>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table id="pelanggan" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>ID</th>
									<th>Nama</th>
									<th>Email</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($pelanggan as $index => $row)
									<tr>
										<td>{{ ++$index }}</td>
										<td>{{ $row->id }}</td>
										<td>{{ $row->name }}</td>
										<td>{{ $row->email }}</td>
										<td><button class="btn btn-success" onclick="pilihPelanggan('<?= $row->id ?>' , '<?= $row->name ?>')"><i class="fa fa-shopping-cart"></i></button></td>
									</tr>
								@endforeach
						</table>
					</div>
				</div>
			</div>
		</div>	
						
		<div class="col-sm-12">
			<div class="card card-primary">
				<div class="card-header text-white">
					<h5><i class="fa fa-shopping-cart"></i> Buat Pesanan
					</h5>
				</div>
				<form action="{{ route('admin.pesanan.create') }}" method="post" id="form-invoice">
					@csrf
					<input type="hidden" name="kasir_id" value="{{ Auth::user()->id }}">
					<input type="hidden" name="pelanggan_id" id="pelanggan_id">
					<div class="card-body">
						<div id="keranjang" class="table-responsive">
							<table class="table table-bordered">
								<tr>
									<td><b>Tanggal</b></td>
									<td><input type="text" readonly="readonly" class="form-control" value="<?php echo date("j F Y, G:i");?>" name="tgl"></td>
								</tr>
								<tr>
									<td><b>Customer</b></td>
									<td><input type="text" readonly="readonly" class="form-control" value="" name="nama_pelanggan" id="nama_pelanggan"></td>
								</tr>
							</table>
							<table class="table table-bordered w-100" id="example1">
								<thead>
									<tr>
										<td> Kode</td>
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
								</tbody>
						</table>
						<br/>
						<div id="kasirnya">
							<table class="table table-stripped">
								<tr>
									<td>Total </td>
									<td><input type="text" class="form-control" name="totalBuy" value="0" id="totalBuy" readonly></td>
								</tr>
								<tr>
									<td></td>
									<td align="right">
										<span class="btn btn-success" id="hitung" onclick="submitPesanan()"><i class="fa fa-shopping-cart"></i> Buat Pesanan</span>
										<span class="btn btn-danger" onclick="reset()"><b>RESET</b></span>
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
	let struk = document.getElementById('struk');
	let total = document.getElementById('total');
	let totalBuy = document.getElementById('totalBuy');
	let totalPay = document.getElementById('totalPay');
	let allTotal = 0;
	let disc = 0;
	let noStruk = 0;
	let hitung = document.getElementById('hitung');
	let discount = document.getElementById('discount');
	let bayar = document.getElementById('bayar');
	let change = document.getElementById('change');
	let formInvoice = document.getElementById('form-invoice');
	let formToken = document.getElementById('token');

	const closeInvoice = () => {
		let modal = document.getElementById('invoice');
		modal.style.display = 'none';
	}

	const reset = () => {
		location.reload();
	}

	const hitungTotal = () => {
		if(parseInt(bayar.value) == 0 || bayar.value == ''){
			alert('Kolom Bayar belum di isi dan tidak boleh 0 !!!');
			return;
		}

		if(parseInt(discount.value) == 0 || discount.value == ''){
			disc = 0;
		}else{
			disc = parseInt(discount.value);
		}

		if(parseInt(bayar.value) < parseInt(totalBuy.value) ){
			alert('Pembayaran harus lebih besar atau sama dengan total pembelian');
			return;
		}

		console.log( 'total buy ' + totalBuy.value )
		let temp = parseInt( totalBuy.value ) - ( parseInt(disc) * parseInt(totalBuy.value) / 100 );
		console.log(temp)
		totalPay.value = temp;

		change.value = parseInt(bayar.value) - parseInt(totalPay.value);
	}

	const submitPesanan = () => {
		let layananField = document.getElementsByName('kode_layanan[]');
		if(layananField.length <= 0){
			alert('Belum ada layanan terpilih');
			console.log(layananField.length)
			return;
		}
		if(document.getElementById('pelanggan_id').value.trim() === ''){
			alert('Belum ada customer terpilih');
			return;
		}
		// formInvoice.submit();
	}

	const addToForm = (name, value) => {
		let itemTransaction = document.createElement('input');
		itemTransaction.setAttribute('type', 'hidden');
		itemTransaction.setAttribute('name', name);
		itemTransaction.setAttribute('value', value);
		formInvoice.appendChild(itemTransaction);
	}

	const pilihPelanggan = (id, name) => {
		document.getElementById('nama_pelanggan').value = name;
		document.getElementById('pelanggan_id').value = id;
	}
	const addtocart = (kode, jenis, nama, estimasi, harga) => {
		noStruk++;
		let jumlah = document.getElementById(kode + 'jumlahtoadd').value;
		subtotal = ( parseInt(harga) * parseFloat(jumlah) );
		
		if(jumlah === '' || parseFloat(jumlah) === 0){
			alert('jumlah tidak boleh kosong !!!');
			return;
		}
		console.log(jumlah);

		let tBody = document.getElementById('list');
		let tr = document.createElement('tr');
		let tdKode = document.createElement('td');
		let tdJenis = document.createElement('td');
		let tdNama = document.createElement('td');
		let tdEstimasi = document.createElement('td');
		let tdHarga = document.createElement('td');
		let tdJumlah = document.createElement('td');
		let tdSubtotal = document.createElement('td');
		let tdKasir = document.createElement('td');

		tdKode.innerHTML = kode;
		tdJenis.innerHTML = jenis;
		tdNama.innerHTML = nama;
		tdEstimasi.innerHTML = estimasi;
		tdHarga.innerHTML = harga;
		tdSubtotal.innerHTML = subtotal;
		tdJumlah.innerHTML = jumlah;
		tdKasir.innerHTML = '<?= Auth::user()->name ?>';

		tr.appendChild(tdKode);
		tr.appendChild(tdJenis);
		tr.appendChild(tdNama);
		tr.appendChild(tdEstimasi);
		tr.appendChild(tdHarga);
		tr.appendChild(tdJumlah);
		tr.appendChild(tdSubtotal);
		tr.appendChild(tdKasir);
		tBody.appendChild(tr);
		console.log(subtotal);

		totalBuy.value = (parseFloat(totalBuy.value) + parseFloat(subtotal));
		addToForm('kode_layanan[]', kode);
		addToForm('jumlah[]', jumlah);
		addToForm('subtotal[]', subtotal);
	}
</script>
<script>
	
</script>
@endsection