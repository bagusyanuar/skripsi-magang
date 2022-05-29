@extends('admin.layout')

@section('css')
@endsection

@section('content')
    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire("Berhasil!", '{{\Illuminate\Support\Facades\Session::get('success')}}', "success")
        </script>
    @endif

    @if (\Illuminate\Support\Facades\Session::has('failed'))
        <script>
            Swal.fire("Gagal", '{{\Illuminate\Support\Facades\Session::get('failed')}}', "error")
        </script>
    @endif
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Halaman Tambah Karyawan</h4>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/karyawan">Karyawan</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tambah
            </li>
        </ol>
    </div>
    <div class="w-100 p-2 mt-2">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6 col-sm-11">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="/karyawan/create">
                            @csrf
                            <div class="w-100 mb-1">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" placeholder="Username"
                                       name="username">
                            </div>
                            <div class="w-100 mb-1">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password"
                                       name="password">
                            </div>
                            <div class="w-100 mb-1">
                                <label for="nama" class="form-label">Nama Karyawan</label>
                                <input type="text" class="form-control" id="nama" placeholder="Nama Karyawan"
                                       name="nama">
                            <div class="form-group w-100 mb-1">
                                <label for="role">Hak Akses</label>
                                <select class="form-control" id="role" name="role">
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="w-100 mb-2 mt-3 text-right">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
