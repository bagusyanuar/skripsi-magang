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
        <h4 class="mb-0">Halaman Peserta Magang</h4>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/peserta">Peserta Magang</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Detail
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
                                <span class="font-weight-bold">{{ $data->peserta->nama }}</span>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-4">
                                <span class="font-weight-bold">No. Hp :</span>
                            </div>
                            <div class="col-lg-8">
                                <span class="font-weight-bold">{{ $data->peserta->no_hp }}</span>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-4">
                                <span class="font-weight-bold">Alamat :</span>
                            </div>
                            <div class="col-lg-8">
                                <span class="font-weight-bold">{{ $data->peserta->alamat }}</span>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-4">
                                <span class="font-weight-bold">Asal Sekolah :</span>
                            </div>
                            <div class="col-lg-8">
                                <span class="font-weight-bold"> {{ $data->peserta->sekolah }}</span>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-4">
                                <span class="font-weight-bold">Tanggal Mulai :</span>
                            </div>
                            <div class="col-lg-8">
                                <span class="font-weight-bold">{{ $data->peserta->masuk }}</span>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-4">
                                <span class="font-weight-bold">Tanggal Selesai :</span>
                            </div>
                            <div class="col-lg-8">
                                <span class="font-weight-bold">{{ $data->peserta->keluar }}</span>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-4">
                                <span class="font-weight-bold">Divisi :</span>
                            </div>
                            <div class="col-lg-8">
                                <span class="font-weight-bold">{{ $data->peserta->divisi->nama }}</span>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-4">
                                <span class="font-weight-bold">Pembimbing :</span>
                            </div>
                            <div class="col-lg-8">
                                <span class="font-weight-bold">{{ $data->peserta->pembimbing->karyawan->nama }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <p class="font-weight-bold">Tabel Kegiatan Peserta Magang</p>
        <table id="table-data" class="display w-100 table table-bordered">
            <thead>
            <tr>
                <th width="5%" class="text-center">#</th>
                <th width="15%">Tanggal</th>
                <th>Deskripsi Kegiatan</th>
                <th width="15%">Nilai</th>
                <th width="20%">Bukti</th>
            </tr>
            </thead>
            <tbody>
            @foreach($kegiatan as $v)
                <tr>
                    <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
                    <td>{{ $v->tanggal }}</td>
                    <td>{{ $v->deskripsi }}</td>
                    <td>{{ $v->nilai }}</td>
                    <td><a target="_blank"
                           href="{{ asset('assets/bukti')."/".$v->bukti }}">
                            <img
                                src="{{ asset('assets/bukti')."/".$v->bukti }}"
                                alt="Gambar Produk"
                                style="width: 75px; height: 80px; object-fit: cover"/>
                        </a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('js')
    <script src="{{ asset('/adminlte/plugins/select2/select2.js') }}"></script>
    <script src="{{ asset('/adminlte/plugins/select2/select2.full.js') }}"></script>
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#table-data').DataTable();
            $('.select2').select2({
                width: 'resolve'
            });
            $('#status').on('change', function () {
                let val = this.value;
                if (val === 'tolak') {
                    $('#reason').removeClass('d-none')
                    $('#reason').addClass('d-block')
                    $('#panel-pembimbing').removeClass('d-block')
                    $('#panel-pembimbing').addClass('d-none')
                } else {
                    $('#reason').removeClass('d-block')
                    $('#reason').addClass('d-none')
                    $('#panel-pembimbing').removeClass('d-none')
                    $('#panel-pembimbing').addClass('d-block')
                }
            });
        });
    </script>
@endsection
