@extends('admin.layout.app')
@section('content')
    <div class="container-fluid my-3" style="padding-left: 1%;">
        <a href="{{ route('admin.product.add') }}" class="btn btn-primary">Tambah Data</a>
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
                            <h3 class="card-title">Data Products</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Product Code</th>
                                        <th>Name</th>
                                        <th>Photo</th>
                                        <th>Price</th>
                                        <th>Weight</th>
                                        <th>Stock</th>
                                        <th>Description</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $index => $row)
                                        <tr>
                                            <td>{{ ++$index }}</td>
                                            <td class="nipRow">{{ $row->code }}</td>
                                            <td class="nameRow">{{ $row->name }}</td>
                                            <td class="nameRow"><img src="{{ asset($row->photo ? 'image/photo-product/' . $row->photo : '') }}" alt="" srcset="" class="img rounded mb-3" width="150"></td>
                                            <td class="nameRow">{{ $row->price }}</td>
                                            <td class="nameRow">{{ $row->weight }}</td>
                                            <td class="nameRow">{{ $row->stock }}</td>
                                            <td class="nameRow">{{ $row->description }}</td>
                                            <td>
                                                <a href="{{ route('admin.product.edit', ['code' => $row->code]) }}"
                                                    class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                <a href="{{ route('admin.product.delete', ['code' => $row->code]) }}"
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const nipRows = document.querySelectorAll('.nipRow');
            const nameRows = document.querySelectorAll('.nameRow');
            const passUtama = localStorage.getItem('passUtama');

            nipRows.forEach(function (nipRow) {
                const encryptedNip = nipRow.textContent;
                const decryptedNip = decryptWithBlowfish(passUtama, encryptedNip);
                nipRow.textContent = decryptedNip;
            });

            nameRows.forEach(function (nameRow) {
                const encryptedName = nameRow.textContent;
                const decryptedName = decryptWithBlowfish(passUtama, encryptedName);
                nameRow.textContent = decryptedName;
            });

            function decryptWithBlowfish(key, data) {
                const bf = new Blowfish(key);
                console.log(key)
                let decrypted = bf.decrypt(data);
                decrypted = bf.trimZeros(decrypted); 
                return decrypted; 
            }
        });
    </script>
@endsection
