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
        <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Peserta Bimbingan Magang</p>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Peserta Bimbingan Magang
            </li>
        </ol>
    </div>
    <div class="w-100 p-2">

        <table id="table-data" class="display w-100 table table-bordered">
            <thead>
            <tr>
                <th width="5%" class="text-center">#</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Divisi</th>
                <th>No. Hp</th>
                <th>alamat</th>
                <th>Asal Sekolah</th>
                <th width="12%" class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $v)
                <tr>
                    <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
                    <td>{{ $v->user->username }}</td>
                    <td>{{ $v->nama }}</td>
                    <td>{{ $v->divisi->nama }}</td>
                    <td>{{ $v->no_hp }}</td>
                    <td>{{ $v->alamat }}</td>
                    <td>{{ $v->sekolah }}</td>
                    <td class="text-center">
                        <a href="/peserta-bimbingan/{{ $v->user->id }}/detail" class="btn btn-sm btn-info btn-detail" data-id="{{ $v->user->id }}"><i
                                class="fa fa-info"></i></a>
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
            AjaxPost('/peserta/delete', {id}, function () {
                window.location.reload();
            });
        }

        $(document).ready(function () {
            $('#table-data').DataTable();
            $('.btn-delete').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                AlertConfirm('Apakah Anda Yakin?', 'Data yang dihapus tidak dapat dikembalikan!', function () {
                    destroy(id);
                })
            });
        });
    </script>
@endsection
