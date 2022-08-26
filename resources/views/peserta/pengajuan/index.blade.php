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
        <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Permohonan Pengajuan Magang</p>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Permohonan Pengajuan Magang
            </li>
        </ol>
    </div>
    <div class="w-100 p-2">
        <div class="text-right mb-2">
            @if(auth()->user()->peserta->status == 'menunggu')
                <a href="/pengajuan-magang/tambah" class="btn btn-primary"><i class="fa fa-plus mr-1"></i><span
                        class="font-weight-bold">Buat Pengajuan</span></a>
            @endif
        </div>
        <table id="table-data" class="display w-100 table table-bordered">
            <thead>
            <tr>
                <th width="5%" class="text-center">#</th>
                <th width="20%">Tanggal Pengajuan</th>
                <th width="15%">Tanggal Mulai</th>
                <th width="15%">Tanggal Selesai</th>
                <th class="text-center">Divisi</th>
                <th class="text-center">Status</th>
                <th width="10%" class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $v)
                <tr>
                    <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
                    <td width="15%">{{ $v->tanggal }}</td>
                    <td width="15%">{{ $v->tanggal_mulai }}</td>
                    <td width="15%">{{ $v->tanggal_selesai }}</td>
                    <td class="text-center">{{ $v->bagian->nama }}</td>
                    <td class="text-center">{{ $v->status }}</td>
                    <td class="text-center">
                        @if($v->status == 'menunggu')
                            -
                        @else
                            <a href="/pengajuan-magang/{{ $v->id }}/detail" class="btn btn-sm btn-success"
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
