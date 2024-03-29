@extends('admin.layout')

@section('css')
@endsection

@section('content')
    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire("Berhasil!", '{{\Illuminate\Support\Facades\Session::get('success')}}', "success")
        </script>
    @endif
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Kegiatan Magang</p>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Kegiatan Magang
            </li>
        </ol>
    </div>
    <div class="w-100 p-2">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <p class="font-weight-bold">Informasi Pembimbing Magang</p>
                        <hr>
                        <div class="row">
                            <div class="col-lg-4">Nama Pembimbing :</div>
                            <div class="col-lg-8">{{ auth()->user()->peserta->pembimbing->karyawan->nama }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right mb-2">
            @if(auth()->user()->peserta->status == 'aktif')
                <a href="/kegiatan/tambah" class="btn btn-primary"><i class="fa fa-plus mr-1"></i><span
                        class="font-weight-bold">Tambah</span></a>
            @endif
            <a href="#" class="btn btn-success ml-2" id="btn-cetak"><i class="fa fa-print mr-1"></i><span
                    class="font-weight-bold">Cetak</span></a>
        </div>

        <table id="table-data" class="display w-100 table table-bordered">
            <thead>
            <tr>
                <th width="5%" class="text-center">#</th>
                <th width="15%">Tanggal</th>
                <th>Deskripsi Kegiatan</th>
                <th width="15%">Nilai</th>
                <th width="20%">Bukti</th>
                <th width="10%" class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $v)
                <tr>
                    <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
                    <td>{{ $v->tanggal }}</td>
                    <td>{{ $v->deskripsi }}</td>
                    <td>{{ $v->nilai }}</td>
                    <td>
                        <a target="_blank"
                           href="{{ asset('assets/bukti')."/".$v->bukti }}">
                            <img
                                src="{{ asset('assets/bukti')."/".$v->bukti }}"
                                alt="Gambar Produk"
                                style="width: 75px; height: 80px; object-fit: cover"/>
                        </a>
                    </td>
                    <td class="text-center">
                        @if(auth()->user()->role == 'peserta' )
                            @if($v->nilai == '-')
                                <a href="/kegiatan/edit/{{ $v->id }}" class="btn btn-sm btn-warning btn-edit"
                                   data-id="{{ $v->id }}"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-sm btn-danger btn-delete" data-id="{{ $v->id }}"><i
                                        class="fa fa-trash"></i></a>
                            @else
                                <span>-</span>
                            @endif
                        @else
                            <a href="/kegiatan/detail/{{ $v->id }}" class="btn btn-sm btn-success btn-delete"
                               data-id="{{ $v->id }}"><i
                                    class="fa fa-info"></i></a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script type="text/javascript">
        function destroy(id) {
            AjaxPost('/divisi/delete', {id}, function () {
                window.location.reload();
            });
        }

        $(document).ready(function () {
            $('#table-data').DataTable();
            $('.btn-delete').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                AlertConfirm('Apakah anda yakin menghapus?', 'Data yang dihapus tidak dapat dikembalikan!', function () {
                    destroy(id);
                })
            });

            $('#btn-cetak').on('click', function (e) {
                e.preventDefault();
                window.open('/kegiatan/cetak', '_blank');
            })
        });
    </script>
@endsection
