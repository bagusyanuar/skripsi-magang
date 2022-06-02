@extends('admin.layout')

@section('css')
    <link href="{{ asset('/adminlte/plugins/select2/select2.css') }}" rel="stylesheet">
    <style>
        .select2-selection {
            height: 40px !important;
            line-height: 40px !important;
        }
    </style>
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
        <h4 class="mb-0">Halaman Tambah Peserta Magang</h4>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/peserta">Peserta Magang</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit
            </li>
        </ol>
    </div>
    <div class="w-100 p-2 mt-2">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6 col-sm-11">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="/peserta/patch">
                            @csrf
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <div class="w-100 mb-1">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" placeholder="Username"
                                       name="username" value="{{ $data->username }}">
                            </div>
                            <div class="w-100 mb-1">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password"
                                       name="password">
                            </div>
                            <div class="w-100 mb-1">
                                <label for="nama" class="form-label">Nama Peserta</label>
                                <input type="text" class="form-control" id="nama" placeholder="Nama Karyawan"
                                       name="nama" value="{{ $data->peserta->nama }}">
                            </div>
                            <div class="w-100 mb-1">
                                <label for="no_hp" class="form-label">No. Hp</label>
                                <input type="number" class="form-control" id="no_hp"
                                       name="no_hp" value="{{ $data->peserta->no_hp }}">
                            </div>
                            <div class="w-100 mb-1">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea rows="3" class="form-control" id="alamat" placeholder="Alamat"
                                          name="alamat">{{ $data->peserta->alamat }}</textarea>
                            </div>
                            <div class="w-100 mb-1">
                                <label for="sekolah" class="form-label">Asal Sekolah</label>
                                <input type="text" class="form-control" id="sekolah" placeholder="Asal Sekolah"
                                       name="sekolah" value="{{ $data->peserta->sekolah }}">
                            </div>
                            <div class="form-group w-100">
                                <label for="divisi">Divisi</label>
                                <select class="select2" name="divisi" id="divisi" style="width: 100%;">
                                    <option value="">--Pilih Divisi--</option>
                                    @foreach($bagian as $v)
                                        <option value="{{ $v->id }}" {{ $data->peserta->bagian_id == $v->id ? 'selected' : '' }}>{{ $v->nama }}</option>
                                    @endforeach
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
    <script src="{{ asset('/adminlte/plugins/select2/select2.js') }}"></script>
    <script src="{{ asset('/adminlte/plugins/select2/select2.full.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2({
                width: 'resolve'
            });
        });
    </script>
@endsection
