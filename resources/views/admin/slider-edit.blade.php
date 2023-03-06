@extends('layouts.app')

@section('title', 'Profile')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Sliders</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('sliders') }}">Sliders</a></div>
                    <div class="breadcrumb-item">Detail</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12">
                        <div class="card">
                            <form method="post" action="{{ route('update-slider', $slider->id) }}" class="needs-validation"
                                enctype="multipart/form-data" novalidate="">
                                @method('PUT')
                                @csrf
                                <div class="card-header">
                                    <h4>Edit Sliders</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-12 col-md-4">
                                            <label>Status</label>
                                            <select class="form-control selectric" name="status">
                                                <option value="{{ $slider->status == 'Active' ? '1' : '0' }}"
                                                    {{ $slider->status == 'Active' ? 'selected' : '' }}>
                                                    {{ $slider->status }}
                                                </option>
                                                <option value="{{ $slider->status == 'Active' ? '0' : '1' }}">
                                                    {{ $slider->status == 'Active' ? 'Not Active' : 'Active' }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <img src="{{ asset('storage/' . $slider->gambar) }}" alt=""
                                                style="width:100%;
                                                border:solid 1px #333;">
                                            <input type="hidden" name="oldImage" value="{{ $slider->gambar }}">

                                        </div>
                                        <div class="col-12">
                                            <div class="form-group  my-4">
                                                <div>
                                                    <input type="file" name="image">
                                                </div>
                                                <div class="text-danger">
                                                    {{ $errors->first('image') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
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

    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>



    <!-- Page Specific JS File -->
@endpush
