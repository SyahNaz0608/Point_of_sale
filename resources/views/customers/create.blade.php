@extends('layouts.master')
​
@section('title')
    Manajemen Pelanggan
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manajemen Pelanggan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Pelanggan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md">
                        <div class="card">
                            <div class="card-header row">
                                <div class="col-9 h3 float-start">Tambah Pelanggan</div>
                                <div class="col-3" style="text-align: right;">
                                    <a href="{{ route('customers.index') }}" class="btn btn-lg btn-info float-end">Kembali</a>
                                </div>
                                @if (session('error'))
                                <div class="card-body">
                                    <div class="alert alert-danger alert-dismissible">
                                        {!! session('error') !!}
                                    </div>
                                </div>
                                @endif
                            </div>
                            ​
                            <form role="form" action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" placeholder="Nama Pelanggan" required>
                                </div>
                                <div class="form-group">
                                    <textarea name="address" id="address" cols="5" rows="5" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" placeholder="Alamat"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" id="phone" placeholder="No. Hp" required autofocus>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary">Simpan</button>
                                    <input type="reset" class="btn btn-md btn-warning pull-right">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
