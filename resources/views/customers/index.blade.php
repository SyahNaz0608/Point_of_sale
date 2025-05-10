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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header row">
                                <div class="col-9 h3 float-start">Daftar Pelanggan</div>
                                <div class="col-3" style="text-align: right;">
                                    <a href="{{ route('customers.create') }}" class="btn btn-lg btn-primary float-end">Tambah</a>
                                </div>

                                <!-- pop up  message -->
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
                                            <td>Email</td>
                                            <td>Name</td>
                                            <td>Address</td>
                                            <td>phone</td>
                                            <td>Update</td>
                                            <td width=100>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($customers as $row)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $row->email }}</td>
                                                <td>{{ $row->name }}</td>
                                                <td>{{ $row->address }}</td>
                                                <td>{{ $row->phone }}</td>
                                                <td>{{ $row->updated_at }}</td>
                                                <td>
                                                    <form action="{{ route('customers.destroy', $row->id) }}" onsubmit="return confirm('Are You Sure?');" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <a href="{{ route('customers.edit', $row->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
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
                                    {!! $customers->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
