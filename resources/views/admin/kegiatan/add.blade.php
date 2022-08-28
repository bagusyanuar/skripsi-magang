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
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Kegiatan Magang</p>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/kegiatan">Kegiatan Magang</a>
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
                        <form method="post" action="/kegiatan/create" enctype="multipart/form-data">
                            @csrf
{{--                            <div class="w-100 mb-1">--}}
{{--                                <label for="tanggal" class="form-label">Tanggal Kegiatan</label>--}}
{{--                                <input type="date" class="form-control" id="tanggal" value="{{ date('Y-m-d') }}"--}}
{{--                                          name="tanggal">--}}
{{--                            </div>--}}
                            <div class="w-100 mb-1">
                                <label for="deskripsi" class="form-label">Deskripsi Kegiatan</label>
                                <textarea rows="3" class="form-control" id="deskripsi" placeholder="Kegiatan"
                                          name="deskripsi"></textarea>
                            </div>
                            <div class="w-100 mb-1">
                                <label for="bukti" class="form-label">Gambar Bukti Kegiatan</label>
                                <input type="file" class="form-control-file" id="bukti"
                                       placeholder="Gambar Bukti"
                                       name="bukti" required>
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
