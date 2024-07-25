@extends('admin.layout.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"> Edit Customer</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('admin.customer.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $customer->id }}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="name" value="{{ $customer->name }}" class="form-control" placeholder="Nama" required>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" value="{{ $customer->email }}" class="form-control" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('admin.customer.index') }}" class="btn btn-danger">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
