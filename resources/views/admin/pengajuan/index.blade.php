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
        <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Permohonan Peserta Magang</p>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Permohonan Peserta Magang
            </li>
        </ol>
    </div>
    <div class="w-100 p-2">
        <table id="table-data" class="display w-100 table table-bordered">
            <thead>
            <tr>
                <th width="5%" class="text-center">#</th>
                <th width="15%">Nama Peserta</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Divisi</th>
                <th width="10%" class="text-center">Detail</th>
            </tr>
            </thead>
            <tbody>
            {{--            @foreach($data as $v)--}}
                            <tr>
                                <td width="5%" class="text-center">1</td>
                                <td>Peserta 1</td>
                                <td>24-08-2022</td>
                                <td>24-11-2022</td>
                                <td class="text-center">
                                    IT Support
                                </td>
                                <td class="text-center">
                                    <a href="/pengajuan/detail" class="btn btn-sm btn-info btn-edit"
                                       data-id=""><i class="fa fa-info"></i></a>
                                </td>
                            </tr>
            {{--            @endforeach--}}
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
