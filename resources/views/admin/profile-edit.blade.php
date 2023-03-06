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
                <h1>Profile</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('profiles') }}">Profiles</a></div>
                    <div class="breadcrumb-item">Detail</div>
                </div>
            </div>
            <div class="section-body">
                <form method="post" class="needs-validation" novalidate=""
                    action="{{ route('update-profile', $profile->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row mt-sm-4">
                        <div class="col-12 col-md-12 col-lg-5">
                            <div class="card profile-widget">
                                <div class="profile-widget-header">
                                    <img alt="image" src="{{ asset('storage/' . $profile->gambar) }}"
                                        class="rounded-circle profile-widget-picture">
                                    <input type="file" name="image" class="mt-2 ml-5">
                                    <input type="hidden" name="oldImage" value="{{ $profile->gambar }}">
                                </div>
                                <div class="profile-widget-description">
                                    <div class="profile-widget-name">{{ $profile->nama }}
                                    </div>{!! $profile->bio !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>Akun Instagram<span class="text-primary"> (opsional)</span></label>
                                    <input type="text" class="form-control" placeholder="contoh: rehan.dev"
                                        name="akun_instagram" value="{{ $contact->akun_instagram ?? '' }}">
                                    {{-- <span class="text-danger">tidak usah memakai tanda "@"</span> --}}
                                </div>
                                <div class="form-group col-12">
                                    <label>Akun Facebook<span class="text-primary"> (opsional)</span></label>
                                    <input type="text" class="form-control" placeholder="contoh: " name="akun_facebook"
                                        value="{{ $contact->akun_facebook ?? '' }}">
                                    {{-- <span class="text-danger">tidak usah memakai tanda "@"</span> --}}
                                </div>
                                <div class="form-group col-12">
                                    <label>Akun Twitter<span class="text-primary"> (opsional)</span></label>
                                    <input type="text" class="form-control" placeholder="contoh: " name="akun_twitter"
                                        value="{{ $contact->akun_twitter ?? '' }}">
                                    {{-- <span class="text-danger">tidak usah memakai tanda "@"</span> --}}
                                </div>
                                <div class="form-group col-12">
                                    <label>Akun Github<span class="text-primary"> (opsional)</span></label>
                                    <input type="text" class="form-control" placeholder="contoh: " name="akun_github"
                                        value="{{ $contact->akun_github ?? '' }}">
                                    {{-- <span class="text-danger">tidak usah memakai tanda "@"</span> --}}
                                </div>
                                <div class="form-group col-12">
                                    <label>Akun Youtube<span class="text-primary"> (opsional)</span></label>
                                    <input type="text" class="form-control" placeholder="contoh: " name="akun_youtube"
                                        value="{{ $contact->akun_youtube ?? '' }}">
                                    {{-- <span class="text-danger">tidak usah memakai tanda "@"</span> --}}
                                </div>
                                <div class="form-group col-12">
                                    <label>Akun Linkedin<span class="text-primary"> (opsional)</span></label>
                                    <input type="text" class="form-control" placeholder="contoh: " name="akun_linkedin"
                                        value="{{ $contact->akun_linkedin ?? '' }}">
                                    {{-- <span class="text-danger">tidak usah memakai tanda "@"</span> --}}
                                </div>
                            </div>

                        </div>
                        <div class="col-12 col-md-12 col-lg-7">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Edit Profile</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Nama<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="{{ $profile->nama }}"
                                                name="nama" required="">
                                            <div class="invalid-feedback">
                                                nama tidak boleh kosong!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12 col-md-6">
                                            <label>Email<span class="text-danger">*</span></label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror "
                                                value="{{ $profile->email }}" name="email" required="">
                                            <div class="invalid-feedback">
                                                @error('email')
                                                    {{ $message }}
                                                @enderror </div>
                                        </div>
                                        <div class="form-group col-12 col-md-6">
                                            <label>Status</label>
                                            <select class="form-control " name="status">
                                                @if ($profile->status == 0)
                                                    <option value="0" selected>Not Active</option>
                                                    <option value="1" >Active</option>
                                                    @else
                                                    <option value="1" selected>Active</option>
                                                    <option value="0">Not Active</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group col-md-7 col-12">
                                            <label>Nomor HP<span class="text-danger">*</span></label>
                                            <input type="tel" class="form-control" name="nomor_hp"
                                                value="{{ $profile->nomor_hp }}">
                                        </div>
                                        <div class="form-group col-md-5 col-12">
                                            <label>Tanggal Lahir<span class="text-danger">*</span></label>
                                            <input type="date" class="form-control"
                                                value="{{ $profile->tanggal_lahir }}" name="tanggal_lahir">
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Alamat<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="alamat"
                                                value="{{ $profile->alamat }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Bio<span class="text-danger">*</span></label>
                                            <textarea class="form-control summernote-simple" name="bio">{{ old('bio', $profile->bio) }}</textarea>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-info">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

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

    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>

    <!-- Page Specific JS File -->
@endpush
