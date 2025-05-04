@extends('layouts.master')
​
@section('title')
    Manajemen Produk
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manajemen Produk</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Produk</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header row">
                                <div class="col-9 h3 float-start">Daftar Produk</div>
                                <div class="col-3" style="text-align: right;">
                                    <a href="{{ route('products.create') }}" class="btn btn-lg btn-primary float-end">Tambah</a>
                                </div>
                                @if (session('success'))
                                <div class="card-body">
                                    <div class="alert alert-success alert-dismissible">
                                        {!! session('success') !!}
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>Foto</td>
                                            <!-- <td>Kode Produk</td> -->
                                            <td>Nama Produk</td>
                                            <td>Deskripsi</td>
                                            <td>Stok</td>
                                            <td>Harga</td>
                                            <td>Kategori</td>
                                            <td>Update</td>
                                            <td width=100>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($products as $row)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>
                                                    @if (!empty($row->photo))
                                                        <img src="{{ asset('uploads/product/' . $row->photo) }}" alt="{{ $row->name }}" width="50px" height="50px">
                                                    @else
                                                        <img src="https://via.placeholder.com/50x50" alt="{{ $row->name }}">
                                                    @endif
                                                </td>
                                                <td>
                                                    <sup class="label label-success">{{ $row->code }}</sup> 
                                                    <strong>{{ ucfirst($row->name) }}</strong>
                                                </td>
                                                <td>{{ $row->description }}</td>
                                                <td>{{ $row->stock }}</td>
                                                <td>Rp {{ number_format($row->price) }}</td>
                                                <td>{{ $row->category->name }}</td>
                                                <td>{{ $row->updated_at }}</td>
                                                <td>
                                                    <form action="{{ route('products.destroy', $row->id) }} " onsubmit="return confirm('Apakah Anda Yakin ?');" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <a href="{{ route('products.edit', $row->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak ada data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="float-right">
                                    {!! $products->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
