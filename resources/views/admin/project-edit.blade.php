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
                <h1>Projects</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('projects') }}">Projects</a></div>
                    <div class="breadcrumb-item">Detail</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12">
                        <div class="card">
                            <form method="post" action="{{ route('update-project', $project->id) }}"
                                class="needs-validation" enctype="multipart/form-data" novalidate="">
                                @method('PUT')
                                @csrf
                                <div class="card-header">
                                    <h4>Edit Projects</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Nama Project</label>
                                        <input type="text" name="nama" class="form-control"
                                            value="{{ $project->nama }}">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12 col-md-6">
                                            <label>Tahun Dibuat</label>
                                            <input type="text" name="tahun" class="form-control"
                                                value="{{ $project->tahun_dibuat }}">
                                        </div>
                                        <div class="form-group col-12 col-md-6">
                                            <label>Link Preview</label>
                                            <input type="text" name="link" class="form-control"
                                                value="{{ $project->link }}">
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="img-thumbnail col-12 col-md-6 col-lg-3">
                                            <img src="{{ asset('storage/' . $project->gambar) }}" alt=""
                                                style="width:100%;display:block;
                                                border:solid 1px #333;">
                                            <input type="hidden" name="oldImage" value="{{ $project->gambar }}">
                                        </div>
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
                                <div class="card-footer text-right">
                                    <button class="btn btn-success">Save Changes</button>
                                </div>
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
