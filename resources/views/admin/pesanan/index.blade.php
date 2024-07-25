@extends('admin.layout.app')
@section('content')
    <div class="container-fluid my-3" style="padding-left: 1%;">
        <a href="{{ route('admin.pesanan.add') }}" class="btn btn-primary">Tambah Data</a>
    </div>
    <br>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- /.card -->

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            {!! implode('', $errors->all('<li>:message</li>')) !!}
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Pesanan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Kasir</th>
                                        <th>Pelanggan</th>
                                        <th>Layanan</th>
                                        <th>Quantity</th>
                                        <th>Total Pesanan</th>
                                        <th>Status Pesanan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pesanan as $index => $row)
                                        <tr>
                                            <td>{{ ++$index }}</td>
                                            <td>{{ $row->kode }}</td>
                                            <td>{{ $row->kasir->name }}</td>
                                            <td>{{ $row->pelanggan->name }}</td>
                                            <td>
                                                <ol>
                                                    @foreach($row->layanan as $key => $layanan)
                                                        <li>{{ $layanan->kode . ' - ' . $layanan->nama . ' - ' . $layanan->harga}}</li>
                                                    @endforeach
                                                </ol>
                                            </td>
                                            <td>
                                                <ul>
                                                    @foreach($row->layanan as $key => $layanan)
                                                        <li>{{ $layanan->pivot->jumlah }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                <?php
                                                    $total = 0;
                                                    foreach($row->layanan as $l){
                                                        $total += intval($l->pivot->subtotal);
                                                    }
                                                    echo $total;
                                                ?>
                                            </td>
                                            <td>{{ $row->status }}</td>
                                            <td>
                                                <a href="{{ route('admin.pesanan.edit', ['kode' => $row->kode]) }}"
                                                    class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                                <a href="{{ route('admin.pesanan.delete', ['kode' => $row->kode]) }}"
                                                    onclick="return confirm('Are you sure?'); return false;"
                                                    class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
