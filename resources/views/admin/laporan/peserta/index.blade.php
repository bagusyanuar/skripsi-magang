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
        <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Laporan Peserta Magang</p>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Laporan Peserta Magang
            </li>
        </ol>
    </div>
    <div class="w-100 p-2">
        <div class="d-flex justify-content-between align-items-end mb-2">
            <div class="form-group w-25 mb-1">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="aktif">Aktif</option>
                    <option value="selesai">Selesai</option>
                </select>
            </div>
            <div class="text-right mb-2 pr-3">
                <a href="#" target="_blank" class="btn btn-success btn-cetak"><i class="fa fa-print mr-1"></i><span
                        class="font-weight-bold">Cetak</span></a>
            </div>
        </div>

        <table id="table-data" class="display w-100 table table-bordered">
            <thead>
            <tr>
                <th width="5%" class="text-center">#</th>
                <th>Nama</th>
                <th>Divisi</th>
                <th>Pembimbing</th>
                <th>Asal Sekolah</th>
                <th>Mulai</th>
                <th>Selesai</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script type="text/javascript">
        var table;

        function reload() {
            table.ajax.reload();
        }

        $(document).ready(function () {
            table = DataTableGenerator('#table-data', '/laporan-peserta/data', [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'nama'},
                {data: 'divisi.nama'},
                {data: 'pembimbing.karyawan.nama'},
                {data: 'sekolah'},
                {data: 'masuk'},
                {data: 'keluar'},
            ], [], function (d) {
                d.status = $('#status').val();
            }, {
                dom: 'ltipr',
            });

            $('#status').on('change', function (e) {
                reload();
            });

            $('.btn-cetak').on('click', function (e) {
                e.preventDefault();
                let status = $('#status').val();
                window.open('/laporan-peserta/cetak?status=' + status, '_blank');
            })
        });
    </script>
@endsection
