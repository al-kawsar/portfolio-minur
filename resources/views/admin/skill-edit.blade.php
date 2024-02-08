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
                <h1>Skills</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item active"><a href="{{ route('skills') }}">Skills</a></div>
                    <div class="breadcrumb-item">Detail</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12">
                        <div class="card">
                            <form method="post" action="{{ route('update-skills', $skill->id) }}" class="needs-validation"
                                enctype="multipart/form-data" novalidate="">
                                @method('PUT')
                                @csrf
                                <div class="card-header">
                                    <h4>Edit Skills</h4>
                                </div>
                                <div class="card-body">
                                        <div class="form-group">
                                            <label>Nama Skill</label>
                                            <input type="text" name="nama" class="form-control" value="{{ $skill->nama }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Tingkat Skill</label>
                                            <input type="text" name="skill" class="form-control" value="{{ $skill->tingkat }}">
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
