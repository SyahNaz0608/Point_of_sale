@extends('layouts.master')
​
@section('title')
    Manajemen Kategori
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manajemen Kategori</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Kategori</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h3>Tambah Kategori</h3>
                            </div>
                            @if (session('error'))
                                <div class="card-body">
                                    <div class="alert alert-danger alert-dismissible">
                                        {!! session('error') !!}
                                    </div>
                                </div>
                            @endif
                            ​
                            <form role="form" action="{{ route('categories.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nama Kategori</label>
                                    <input type="text" name="name"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <textarea name="description" id="description" cols="5" rows="5"
                                        class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"></textarea>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary">Simpan</button>
                                    <input type="reset" class="btn btn-md btn-warning pull-right">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3>Daftar Kategori</h3>
                            </div>
                            @if (session('success'))
                                <div class="card-body">
                                    <div class="alert alert-success alert-dismissible">
                                        {!! session('success') !!}
                                    </div>
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>Kategori</td>
                                            <td>Deskripsi</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($categories as $row)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $row->name }}</td>
                                                <td>{{ $row->description }}</td>
                                                <td>
                                                    <form action="{{ route('categories.destroy', $row->id) }} " onsubmit="return confirm('Apakah Anda Yakin ?');" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <a href="{{ route('categories.edit', $row->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
