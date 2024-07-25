@extends('admin.layout.app')
@section('content')
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
                            <h3 class="card-title">Data Pembayaran</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Pesanan</th>
                                        <th>Kasir</th>
                                        <th>Pelanggan</th>
                                        <th>Total Pesanan</th>
                                        <th>Status Pembayaran</th>
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
                                                <?php
                                                    $total = 0;
                                                    foreach($row->layanan as $l){
                                                        $total += intval($l->pivot->subtotal);
                                                    }
                                                    echo $total;
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if($row->pembayaran == null){
                                                        echo "Belum dibayar";
                                                    }else{
                                                        echo "Sudah dibayar";
                                                    }
                                                    // var_dump($row->pembayaran);
                                                ?>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.pesanan.view', ['kode' => $row->kode]) }}"
                                                    class="btn btn-warning"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('admin.pembayaran.edit', ['kode' => $row->kode]) }}"
                                                    class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                                @if($row->pembayaran != null)
                                                    <a href="{{ route('admin.pembayaran.delete', ['kode' => $row->pembayaran->kode]) }}"
                                                    onclick="return confirm('Are you sure?'); return false;"
                                                    class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                @endif
                                                
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
