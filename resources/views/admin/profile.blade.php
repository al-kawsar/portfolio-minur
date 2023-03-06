@extends('layouts.app')

@section('title', 'DataTables')

@push('style')
    <!-- CSS Libraries -->
    {{-- <link rel="stylesheet"
        href="assets/modules/datatables/datatables.min.css">
    <link rel="stylesheet"
        href="assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css"> --}}

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">

    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">


    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Projects Profiles</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Profile</div>

                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="row">
                                <div class="col-6 card-header">
                                    <h4 class="mx-3">DataTables Profiles</h4>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="mx-5 mt-3 btn btn-primary float-right"
                                        id="modalCreateProfile"><i class="fa-solid fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Nama</th>
                                                <th>Deskripsi</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Alamat</th>
                                                <th>Nomor HP</th>
                                                <th>Gambar</th>
                                                <th>Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($profiles as $number => $profile)
                                                <tr>
                                                    <td>
                                                        {{ $number + 1 }}
                                                    </td>
                                                    <td>
                                                        {{ $profile->nama }}
                                                    </td>
                                                    <td>{!! $profile->bio !!}</td>
                                                    <td>{{ $profile->tanggal_lahir }}</td>
                                                    <td>{{ $profile->alamat }}</td>
                                                    <td>{{ $profile->nomor_hp }}</td>
                                                    <td><img src="{{ asset('storage/' . $profile->gambar) }}"
                                                            alt="" width="100" height="100" class="border"
                                                            style="object-fit: cover;object-position: center;"></td>
                                                    <td>
                                                        <div
                                                            class="badge badge-{{ $profile->status == 1 ? 'success' : 'warning' }}">
                                                            {{ $profile->status == 1 ? 'Active' : 'Not Active' }}</div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center g-3">
                                                            <a href="{{ route('edit-profile', $profile->id) }}"
                                                                class="btn btn-warning mr-1">Edit</a>
                                                            <form id="delete-form" method="post">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger delete-link"
                                                                    data-dataid='{{ $profile->id }}'>Delete</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>

    {{-- <script src="{{ asset('library/cleave.js/dist/cleave.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('library/cleave.js/dist/addons/cleave-phone.us.js') }}"></script> --}}
    {{-- <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script> --}}
    {{-- <script src="{{ asset('library/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script> --}}
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>




    <!-- JS Abal-abal -->

    @if ($errors->any())
        <script>
            $(document).ready(function() {
                swal('Gagal', 'Masukkan dengan benar!', 'error');
            });
        </script>
    @endif

    <!-- Modal Create -->
    <script>
        $("#modalCreateProfile").fireModal({
            body: `<form action="{{ route('create-profile') }}" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <div class="card-body">
                    <div class="row">
                    <div class="form-group col-12 col-md-6">
                                    <label>Nama Anda<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            name="nama" required="" value="{{ old('nama') }}">
                    </div>
                    @error('nama')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group col-12 col-md-6">
                                    <label>Status</label>
                                    <select class="form-control selectric" name="status">
                                        <option value="0">Not Active</option>
                                        <option value="1">Active</option>
                                    </select>
                                </div>
                    <div class="form-group col-12 col-md-6">
                                    <label>Tanggal Lahir<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                            name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required="" max="2023-12-31">
                    </div>
                    <div class="form-group col-12 col-md-6">
                                    <label>Alamat<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                            name="alamat" value="{{ old('alamat') }}" required="">
                    </div>
                    <div class="form-group col-12 col-md-6">
                                    <label>Nomor HP<span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control @error('nomor_hp') is-invalid @enderror"
                                            name="nomor_hp" value="{{ old('nomor_hp') }}" required="">
                    </div>
                    <div class="form-group col-12 col-md-6">
                                    <label>Email<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required="">
                    </div>
                    <div class="form-group col-12">
                                            <label>Deskripsi Anda<span class="text-danger">*</span></label>
                                            <textarea class="form-control summernote-simple" name="deskripsi" required >{{ old('deskripsi') }}</textarea>
                                        </div>
                    </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label col-12 mb-3">Gambar Profile<span class="text-danger">*</span></label>
                                    <div class="col-12">
                                        <div id="image-preview"
                                            class="image-preview m-auto">
                                            <label for="image-upload"
                                                id="image-label">Choose File</label>
                                            <input type="file"
                                                name="image"
                                                id="image-upload" />
                                        </div>
                                    </div>
                                    <div class="text-danger">
                                        {{ $errors->first('image') }}
                                    </div>
                                </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>`
        });
    </script>
    <script>
        $(".delete-link").click(function(event) {
            event.preventDefault(); // Menghentikan tindakan default tautan

            const id = $(this).data('dataid');

            swal({
                    title: 'Anda Yakin?',
                    text: 'Setelah Dihapus, Anda tidak akan dapat memulihkan data Profile ini',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        const form = document.getElementById('delete-form');
                        form.action = `/admin/profile/${id}`;
                        form.submit(); // Mengirim form penghapusan
                    } else {
                        swal('Data tidak jadi dihapus!');
                    }
                });
        });
    </script>

    {{-- <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script> --}}
    {{-- <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script> --}}
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/upload-preview/upload-preview.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-post-create.js') }}"></script>


    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script>
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
@endpush
