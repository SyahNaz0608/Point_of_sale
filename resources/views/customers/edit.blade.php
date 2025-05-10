@extends('layouts.master')

@section('title')
    Edit Pelanggan
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Pelanggan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('customers.index') }}">Pelanggan</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3>Daftar Pelanggan</h3>
                            </div>
                            @if (session('success'))
                                <div class="card-body">
                                    <div class="alert alert-success alert-dismissible">
                                        {!! session('success') !!}
                                    </div>
                                </div>
                            @endif

                            <form role="form" action="{{ route('customers.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email"
                                        name="email"
                                        value="{{ $customer->email }}"
                                        class="form-control {{ $errors->has('email') ? 'is-invalid': '' }}" id="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama Pelanggan</label>
                                    <input type="text"
                                        name="name"
                                        value="{{ $customer->name }}"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid': '' }}" id="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <textarea name="address"
                                        id="address"
                                        cols="5" rows="5"
                                        class="form-control {{ $errors->has('address') ? 'is-invalid': '' }}">{{ $customer->address }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="phone">No. Hp</label>
                                    <input type="text"
                                        name="phone"
                                        value="{{ $customer->phone }}"
                                        class="form-control {{ $errors->has('phone') ? 'is-invalid': '' }}" id="phone" required>
                                </div>

                                <div class="card-footer">
                                    <button class="btn btn-info">Update</button>
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