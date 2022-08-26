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
                <a href="/pengajuan">Permohonan Pengajuan Magang</a>
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
                                <span class="font-weight-bold">No. Pengajuan :</span>
                            </div>
                            <div class="col-lg-8">
                                <span class="font-weight-bold">{{ $data->no_pengajuan }}</span>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-4">
                                <span class="font-weight-bold">Nama Peserta :</span>
                            </div>
                            <div class="col-lg-8">
                                <span class="font-weight-bold">{{ $data->user->peserta->nama }}</span>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-4">
                                <span class="font-weight-bold">No. Hp :</span>
                            </div>
                            <div class="col-lg-8">
                                <span class="font-weight-bold">{{ $data->user->peserta->no_hp }}</span>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-4">
                                <span class="font-weight-bold">Alamat :</span>
                            </div>
                            <div class="col-lg-8">
                                <span class="font-weight-bold">{{ $data->user->peserta->alamat }}</span>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-4">
                                <span class="font-weight-bold">Asal Sekolah :</span>
                            </div>
                            <div class="col-lg-8">
                                <span class="font-weight-bold"> {{ $data->user->peserta->sekolah }}</span>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-4">
                                <span class="font-weight-bold">Tanggal Mulai :</span>
                            </div>
                            <div class="col-lg-8">
                                <span class="font-weight-bold">{{ $data->tanggal_mulai }}</span>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-4">
                                <span class="font-weight-bold">Tanggal Selesai :</span>
                            </div>
                            <div class="col-lg-8">
                                <span class="font-weight-bold">{{ $data->tanggal_selesai }}</span>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-lg-4">
                                <span class="font-weight-bold">Divisi :</span>
                            </div>
                            <div class="col-lg-8">
                                <span class="font-weight-bold">{{ $data->bagian->nama }}</span>
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
                        <form method="post">
                            @csrf
                            <div class="form-group w-100 mt-2">
                                <label for="status">Proses Persetujuan</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="terima">Terima</option>
                                    <option value="tolak">Tolak</option>
                                </select>
                            </div>
                            <div class="form-group w-100 d-block" id="panel-pembimbing">
                                <label for="pembimbing">Pembimbing</label>
                                <select class="select2" name="pembimbing" id="pembimbing" style="width: 100%;">
                                    <option value="">--Pilih Pembimbing--</option>
                                    @foreach($karyawan as $v)
                                        <option value="{{ $v->id }}">{{ $v->karyawan->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group w-100 d-none" id="reason">
                                <label for="keterangan">Alasan</label>
                                <textarea class="form-control" rows="3" name="keterangan" id="keterangan"></textarea>
                            </div>
                            <div class="w-100 mb-2 mt-3 text-right">
                                <button type="submit" class="btn btn-success">Submit</button>
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
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script>
        $(document).ready(function () {
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
