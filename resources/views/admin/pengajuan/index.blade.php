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
        <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Pengajuan Permohonan Peserta Magang</p>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Pengajuan Permohonan Peserta Magang
            </li>
        </ol>
    </div>
    <div class="w-100 p-2">
        <table id="table-data" class="display w-100 table table-bordered">
            <thead>
            <tr>
                <th width="5%" class="text-center">#</th>
                <th>Nama Peserta</th>
                <th width="15%">Tanggal Mulai</th>
                <th width="15%">Tanggal Selesai</th>
                <th class="text-center">Divisi</th>
                <th width="10%" class="text-center">Detail</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $v)
                <tr>
                    <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
                    <td>{{ $v->user->peserta->nama }}</td>
                    <td>{{ $v->tanggal_mulai }}</td>
                    <td>{{ $v->tanggal_selesai }}</td>
                    <td class="text-center">
                        {{ $v->bagian->nama }}
                    </td>
                    <td class="text-center">
                        <a href="/pengajuan/{{ $v->id }}" class="btn btn-sm btn-info btn-edit"
                           data-id=""><i class="fa fa-info"></i></a>
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
