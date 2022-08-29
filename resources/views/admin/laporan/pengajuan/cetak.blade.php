@extends('admin.laporan.index')

@section('content')
    <div class="text-center f-bold report-title">Laporan Pengajuan Peserta Magang</div>
    <div class="text-center">Periode Laporan {{ $tgl1 }} - {{ $tgl2 }} </div>
    <hr>
    <br>
    <table id="my-table" class="table display">
        <thead>
        <tr>
            <th width="5%" class="text-center">#</th>
            <th width="15%">Tanggal</th>
            <th>No. Pengajuan</th>
            <th>Nama Peserta</th>
            <th>Sekolah</th>
            <th>Divisi</th>
            <th>Mulai</th>
            <th>Selesai</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $v)
            <tr>
                <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
                <td>{{ $v->tanggal }}</td>
                <td>{{ $v->no_pengajuan }}</td>
                <td>{{ $v->user->peserta->nama }}</td>
                <td>{{ $v->user->peserta->sekolah }}</td>
                <td>{{ $v->bagian->nama }}</td>
                <td>{{ $v->tanggal_mulai }}</td>
                <td>{{ $v->tanggal_selesai }}</td>
                <td>{{ $v->status }}</td>
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
                <p class="text-center">Wonogiri, {{ date('d-m-Y') }}</p>
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
