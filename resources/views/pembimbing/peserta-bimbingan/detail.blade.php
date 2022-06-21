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
            <li class="breadcrumb-item">
                <a href="/peserta-bimbingan">Peserta Bimbingan</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Kegiatan Magang
            </li>
        </ol>
    </div>
    <div class="w-100 p-2">
        <div class="row mb-2">
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <span class="font-weight-bold">Nama Peserta</span>
                            </div>
                            <div class="col-lg-8 col-md-8">
                                <span class="font-weight-bold">: {{ $user->peserta->nama }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <span class="font-weight-bold">Asal Sekolah</span>
                            </div>
                            <div class="col-lg-8 col-md-8">
                                <span class="font-weight-bold">: {{ $user->peserta->sekolah }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <span class="font-weight-bold">Divisi</span>
                            </div>
                            <div class="col-lg-8 col-md-8">
                                <span class="font-weight-bold">: {{ $user->peserta->divisi->nama }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table id="table-data" class="display w-100 table table-bordered">
            <thead>
            <tr>
                <th width="5%" class="text-center">#</th>
                <th width="15%">Tanggal</th>
                <th>Deskripsi Kegiatan</th>
                <th width="15%">Nilai</th>
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
                    <td class="text-center">
                        <a href="#" class="btn btn-sm btn-success btn-nilai"
                           data-id="{{ $v->id }}" data-nama="{{ $v->deskripsi }}" data-nilai="{{ $v->nilai }}"><i
                                class="fa fa-sticky-note"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="modal-nilai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Penilaian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="user" value="{{ $user->id }}">
                    <input type="hidden" name="kegiatan" id="kegiatan" value="">
                    <span id="nama-kegiatan" class="mb-3"></span>
                    <div class="w-100 mb-1 mt-2">
                        <label for="nilai" class="form-label">Nilai Huruf</label>
                        <input type="text" class="form-control" id="nilai"
                               name="nilai" value="-">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save-nilai">Simpan</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script type="text/javascript">

        function setNilai(id, nilai) {
            AjaxPost('/peserta-bimbingan/' + id + '/nilai', {
                nilai: nilai
            }, function () {
                window.location.reload();
            })
        }

        $(document).ready(function () {
            $('#table-data').DataTable();
            $('.btn-nilai').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                let nama = this.dataset.nama;
                let nilai = this.dataset.nilai;
                $('#nama-kegiatan').html(nama);
                $('#kegiatan').val(id);
                $('#nilai').val(nilai);
                $('#modal-nilai').modal('show');
            });

            $('#btn-save-nilai').on('click', function (e) {
                e.preventDefault();
                let id = $('#kegiatan').val();
                let nilai = $('#nilai').val();
                setNilai(id, nilai)
            });
        });
    </script>
@endsection
