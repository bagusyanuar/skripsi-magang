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
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Pengajuan Magang</p>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/pengajuan-magang">Pengajuan Magang</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Buat
            </li>
        </ol>
    </div>
    <div class="w-100 p-2 mt-2">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6 col-sm-11">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="/pengajuan-magang/create">
                            @csrf
                            <div class="w-100 mb-1">
                                <label for="mulai" class="form-label">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="mulai" value="{{ date('Y-m-d') }}"
                                       name="mulai">
                            </div>
                            <div class="w-100 mb-1">
                                <label for="selesai" class="form-label">Tanggal Selesai</label>
                                <input type="date" class="form-control" id="selesai" value="{{ date('Y-m-d') }}"
                                       name="selesai">
                            </div>
                            <div class="form-group w-100">
                                <label for="divisi">Divisi</label>
                                <select class="select2" name="divisi" id="divisi" style="width: 100%;">
                                    <option value="">--Pilih Divisi--</option>
                                    @foreach($bagian as $v)
                                        <option value="{{ $v->id }}">{{ $v->nama }}</option>
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
