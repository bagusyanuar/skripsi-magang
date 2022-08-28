@extends('admin.layout')

@section('css')
    <style>
        .nav-pills-custom .nav-link:not(.active) {
            background-color: inherit !important;
            color: #29538d !important;
        }
        /* active (faded) */
        .nav-pills-custom .nav-link {
            background-color: #29538d !important;
            color: white !important;
        }
        a.nav-link.active {
            background-color: #29538d !important;
            color: white !important;
        }
    </style>
@endsection

@section('content')
    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire("Berhasil!", '{{\Illuminate\Support\Facades\Session::get('success')}}', "success")
        </script>
    @endif
    <div class="d-flex align-items-center justify-content-between mb-3">
        <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Peserta Magang</p>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Peserta Magang
            </li>
        </ol>
    </div>

    <div class="w-100 p-2">
{{--        <div class="text-right mb-2 pr-3">--}}
{{--            <a href="/peserta/tambah" class="btn btn-primary"><i class="fa fa-plus mr-1"></i><span--}}
{{--                    class="font-weight-bold">Tambah</span></a>--}}
{{--        </div>--}}
        <ul class="nav nav-pills nav-pills-custom mb-3" id="myTab" role="tablist">
            <li class="nav-item mr-2">
                <a class="nav-link active" id="pills-tab-aktif"
                   data-toggle="tab"
                   href="#tab-aktif" role="tab"
                   aria-controls="tab-aktif" aria-selected="true">Aktif</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-tab-selesai"
                   data-toggle="tab"
                   href="#tab-selesai" role="tab"
                   aria-controls="tab-selesai" aria-selected="true">Selesai</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-aktif"
                 role="tabpanel" aria-labelledby="tab-aktif">
                <table id="table-data" class="display w-100 table table-bordered">
                    <thead>
                    <tr>
                        <th width="5%" class="text-center">#</th>
                        <th>Username</th>
                        <th>Nama Peserta</th>
                        <th>Divisi</th>
                        <th>Pembimbing</th>
                        <th>Asal Sekolah</th>
                        <th width="20%" class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($aktif as $v)
                        <tr>
                            <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
                            <td>{{ $v->username }}</td>
                            <td>{{ $v->peserta->nama }}</td>
                            <td>{{ $v->peserta->divisi->nama }}</td>
                            <td>{{ $v->peserta->pembimbing->karyawan->nama }}</td>
                            <td>{{ $v->peserta->sekolah }}</td>
                            <td class="text-center">
                                <a href="/peserta/{{ $v->id }}/detail" class="btn btn-sm btn-info btn-detail"
                                   data-id="{{ $v->id }}"><i class="fa fa-info"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade show" id="tab-selesai"
                 role="tabpanel" aria-labelledby="tab-selesai">
                <table id="table-data-selesai" class="display w-100 table table-bordered">
                    <thead>
                    <tr>
                        <th width="5%" class="text-center">#</th>
                        <th>Username</th>
                        <th>Nama Peserta</th>
                        <th>Divisi</th>
                        <th>Pembimbing</th>
                        <th>Asal Sekolah</th>
                        <th width="20%" class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($selesai as $s)
                        <tr>
                            <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
                            <td>{{ $s->username }}</td>
                            <td>{{ $s->peserta->nama }}</td>
                            <td>{{ $s->peserta->divisi->nama }}</td>
                            <td>{{ $s->peserta->pembimbing->karyawan->nama }}</td>
                            <td>{{ $s->peserta->sekolah }}</td>
                            <td class="text-center">
                                <a href="/peserta/{{ $s->id }}/detail" class="btn btn-sm btn-info btn-detail"
                                   data-id="{{ $s->id }}"><i class="fa fa-info"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

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
            $('#table-data-selesai').DataTable();
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
