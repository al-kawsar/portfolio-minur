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


    <link rel="stylesheet" href="{{ asset('css/skills.css') }}">
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Skills DataTables</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Skills</div>

                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="row">
                                <div class="col-6 card-header">
                                    <h4 class="mx-3">DataTables Skills</h4>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="mx-5 mt-3 btn btn-primary float-right"
                                        id="modalCreateSkill"><i class="fa-solid fa-plus"></i></button>
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
                                                <th class="text-center">Tingkat</th>
                                                <th>Created At</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($skills as $number => $skill)
                                                <tr>
                                                    <td>
                                                        {{ $number + 1 }}
                                                    </td>
                                                    <td>
                                                        {{ $skill->nama }}
                                                    </td>
                                                    <td class="text-center">
                                                        <div
                                                            class="badge badge-@php if($skill->tingkat >= '85')echo 'success'; if($skill->tingkat >= '65' && $skill->tingkat < '85')echo 'info'; if($skill->tingkat >= '40' && $skill->tingkat < '65')echo 'warning'; if($skill->tingkat < '40')echo 'danger'; @endphp">
                                                            {{ $skill->tingkat . '%' }}
                                                        </div>
                                                    </td>
                                                    <td>{{ $skill->created_at->format('Y/m/d') }}</td>
                                                    <td>
                                                        <div
                                                            class="d-flex
                                                            justify-content-center g-3">
                                                            <a href="{{ route('edit-skills', $skill->id) }}"
                                                                class="btn btn-warning mr-1">Edit</a>
                                                            <form id="delete-form" method="post">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger delete-link"
                                                                    data-dataid='{{ $skill->id }}'>Delete</button>
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
        $("#modalCreateSkill").fireModal({
            body: `<form action="{{ route('create-skills') }}" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <div class="card-body">
                    <div class="form-group mb-1">
                                    <label>Nama Skill<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('skill') is-invalid @enderror"
                                            name="skill" required="" value="" placeholder="ex: HTML">
                    </div>
                    <div class="form-group mt-1 row align-items-center">
                        <div class="col-6  col-lg-5">
                                                        <label>Tingkat Skill<span class="text-danger">*</span></label>
                                                    </div>
                        <div class="col-6  col-lg-7">
                                                <input type="text" class="form-control mt-2"
                                                name="level" required="" value="" max="3">
                                                </div>
                </div>
                    @error('nama')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

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
                    text: 'Setelah Dihapus, Anda tidak akan dapat memulihkan data slider ini',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        const form = document.getElementById('delete-form');
                        form.action = `/admin/skills/${id}`;
                        form.submit(); // Mengirim form penghapusan
                    } else {
                        swal('Data tidak jadi dihapus!');
                    }
                });
        });
    </script>

    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/upload-preview/upload-preview.js') }}"></script>

    <script src="{{ asset('js/page/features-post-create.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script>
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
@endpush
