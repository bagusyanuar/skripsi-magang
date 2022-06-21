@extends('admin.laporan.index')

@section('content')
    <div class="text-center f-bold report-title">Laporan Peserta Magang</div>
    <hr>
    <br>
    <table id="my-table" class="table display">
        <thead>
        <tr>
            <th width="5%" class="text-center">#</th>
            <th>Username</th>
            <th>Nama</th>
            <th>Divisi</th>
            <th>Pembimbing</th>
            <th>No. Hp</th>
            <th>alamat</th>
            <th>Asal Sekolah</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $v)
            <tr>
                <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
                <td>{{ $v->username }}</td>
                <td>{{ $v->peserta->nama }}</td>
                <td>{{ $v->peserta->divisi->nama }}</td>
                <td>{{ $v->peserta->pembimbing == null ? 'Belum Ada Pembimbing' : $v->peserta->pembimbing->karyawan->nama }}</td>
                <td>{{ $v->peserta->no_hp }}</td>
                <td>{{ $v->peserta->alamat }}</td>
                <td>{{ $v->peserta->sekolah }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <hr>
    <br>
    <div class="row">
        <div class="col-xs-8"></div>
        <div class="col-xs-3">
            <div class="text-center">
                <p class="text-center">Sukoharjo, {{ date('d-m-Y') }}</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-3">
            <div class="text-center">
                <p class="text-center"></p>
                <p class="text-center">Pimpinan</p>
            </div>
        </div>
        <div class="col-xs-5"></div>
        <div class="col-xs-3">
            <div class="text-center">
                <p class="text-center">Mengetahui,</p>
                <p class="text-center">Admin,</p>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-xs-3">
            <div class="text-center">
                <p class="text-center">(...................)</p>
            </div>
        </div>
        <div class="col-xs-5"></div>
        <div class="col-xs-3">
            <div class="text-center">
                <p class="text-center">(...................)</p>
            </div>
        </div>
    </div>
@endsection
