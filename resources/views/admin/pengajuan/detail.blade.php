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
        <h4 class="mb-0">Halaman Persetujuan Permohonan Peserta Magang</h4>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/peserta">Permohonan Pengajuan Magang</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Persetujuan
            </li>
        </ol>
    </div>
    <div class="w-100 p-2 mt-2">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-11">
                <div class="card">
                    <div class="card-body">
                        <p class="font-weight-bold">Informasi Peserta Magang</p>
                        <hr>
                        <div class="row mb-1">
                            <div class="col-lg-4">
                                <span class="font-weight-bold">Nama Peserta :</span>
                            </div>
                            <div class="col-lg-8">
                                <span class="font-weight-bold">Peserta 1</span>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-4">
                                <span class="font-weight-bold">No. Hp :</span>
                            </div>
                            <div class="col-lg-8">
                                <span class="font-weight-bold">0892726372</span>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-4">
                                <span class="font-weight-bold">Alamat :</span>
                            </div>
                            <div class="col-lg-8">
                                <span class="font-weight-bold">Alamat</span>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-4">
                                <span class="font-weight-bold">Asal Sekolah :</span>
                            </div>
                            <div class="col-lg-8">
                                <span class="font-weight-bold">UDB</span>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-4">
                                <span class="font-weight-bold">Tanggal Mulai :</span>
                            </div>
                            <div class="col-lg-8">
                                <span class="font-weight-bold">22-08-2022</span>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-4">
                                <span class="font-weight-bold">Tanggal Selesai :</span>
                            </div>
                            <div class="col-lg-8">
                                <span class="font-weight-bold">22-11-2022</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <p class="font-weight-bold">Persetujuan</p>
                        <hr>
                        <div class="form-group w-100 mb-1">
                            <label for="role">Status</label>
                            <select class="form-control" id="role" name="role">
                                <option value="admin">Terima</option>
                                <option value="karyawan">Tolak</option>
                            </select>
                        </div>
                        <div class="w-100 mb-1">
                            <label for="alamat" class="form-label">Keterangan</label>
                            <textarea rows="3" class="form-control" id="alamat" placeholder="Keterangan"
                                      name="alamat"></textarea>
                        </div>
                        <div class="w-100 mb-2 mt-3 text-right">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
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
