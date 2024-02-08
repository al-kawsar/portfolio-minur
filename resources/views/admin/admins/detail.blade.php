@extends('layouts.app')

@section('title', 'Profile')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/assets/css/bootstrap.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Admins</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('admins') }}">Admins</a></div>
                    <div class="breadcrumb-item">Detail</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12">
                        <div class="card">
                            <form method="post" action="{{ route('update-admin', $user->id) }}" class="needs-validation"
                                novalidate="">
                                @method('PUT')
                                @csrf
                                <div class="card-header">
                                    <h4>Edit Admins</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" value="{{ old('name', $user->name) }}" required="">
                                        <div class="invalid-feedback">
                                            nama tidak boleh kosong!
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-7 col-12">
                                            <label>Email</label>
                                            <input type="email"
                                                class="form-control @error('email')
                                            @if ($message == 'email tidak boleh kosong!')
                                            is-invalid
                                            @endif
                                        @enderror"
                                                name="email" value="{{ old('email', $user->email) }}" required="">
                                            <div class="invalid-feedback">
                                                @error('email')
                                                    @if ($message == 'email sudah di gunakan,gunakan email yang lain!')
                                                        {{ $message }}
                                                    @endif
                                                @enderror
                                                email wajib di isi!
                                            </div>
                                        </div>
                                        <div class="form-group col-md-5 col-12">
                                            <label>Role</label>
                                            <input type="text" disabled readonly class="form-control"
                                                value="{{ $user->role }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <a href="{{ route('admin.reset-password', $user->email) }}" class="btn btn-info">Reset
                                        Password</a>
                                    <button class="btn btn-success">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    @if (session()->has('success'))
        <script>
            $(document).ready(function() {
                swal('Data Berhasil Diubah!', {
                    icon: "success"
                });
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            $(document).ready(function() {
                swal('Data Gagal Diubah!', {
                    icon: "error"
                });
            });
        </script>
    @endif


    <script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>

    <!-- Page Specific JS File -->
@endpush
