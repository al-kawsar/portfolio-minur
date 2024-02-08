@extends('layouts.app')

@section('title', 'DataTables')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Admins DataTables</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Admins</div>

                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="row">
                                <div class="col-6 card-header">
                                    <h4 class="mx-3">DataTables Admins</h4>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="mx-5 mt-3 btn btn-primary float-right" id="modalAdmins"><i
                                            class="fa-solid fa-plus"></i></button>
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
                                                <th>Fullname</th>
                                                <th>Username</th>
                                                <th>Created At</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($admins as $number => $admin)
                                                <tr>
                                                    <td>
                                                        {{ $number + 1 }}
                                                    </td>
                                                    <td>{{ $admin->name }}</td>
                                                    <td>{{ $admin->email }}</td>
                                                    <td>{{ $admin->created_at->format('Y/m/d') }}</td>
                                                    <td>
                                                        <div class="badge badge-warning">
                                                            {{ $admin->role == '2' ? 'Admin' : 'SuperAdmin' }}</div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <a href="{{ route('admins.detail', $admin->email) }}"
                                                                class="btn btn-info mr-2">Detail</a>
                                                            <form id="delete-form" method="post">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger delete-link"
                                                                    data-dataid='{{ $admin->id }}'>Delete</button>
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



    <!-- JS Abal-abal -->
    @if ($errors->any())
        <script>
            $(document).ready(function() {
                swal('Gagal', 'Masukkan dengan benar!', 'error');
            });
        </script>
    @endif
    @if (session()->has('success'))
        <script>
            $(document).ready(function() {
                swal('Berhasil', `{{ session()->get('success') }}`, 'success');
            });
        </script>
    @endif

    <!-- Modal Create -->
    <script>
        $("#modalAdmins").fireModal({
            body: `<form action="{{ route('create-admin') }}" method="POST" class="needs-validation" novalidate="">
                @method('POST')
                @csrf
                <div class="card-body">
                        <div class="form-group">
                            <label>Fullname</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required="">
                            <div class="invalid-feedback">
                                nama wajib diisi
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <input type="number" class="form-control" name="role" disabled value="2" readonly required="">
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror " name="email" value="{{ old('email') }}" required="">
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required="">
                            <div class="invalid-feedback">
                                password tidak boleh kosong!
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
                    text: 'Setelah Dihapus, Anda tidak akan dapat memulihkan data admin ini',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        const form = document.getElementById('delete-form');
                        form.action = `/admin/admins/${id}`;
                        form.submit(); // Mengirim form penghapusan
                    } else {
                        swal('Data tidak dihapus!');
                    }
                });
        });
    </script>


    <!-- Page Specific JS File -->
    <script src="{{ asset('js/sweetalert-admin.js') }}"></script>
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
@endpush
