@extends('admin.laporan.index')

@section('content')
    <div class="text-center f-bold report-title">Laporan Kegiatan Peserta</div>
    <hr>
    <div class="row">
        <div class="col-xs-2">
            <span class="font-weight-bold">Nama Peserta</span>
        </div>
        <div class="col-xs-3">
            <span class="font-weight-bold">: {{ $user->peserta->nama }}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-2 col-md-4">
            <span class="font-weight-bold">Asal Sekolah</span>
        </div>
        <div class="col-xs-3 col-md-8">
            <span class="font-weight-bold">: {{ $user->peserta->sekolah }}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-2 col-md-4">
            <span class="font-weight-bold">Divisi</span>
        </div>
        <div class="col-xs-8 col-md-8">
            <span class="font-weight-bold">: {{ $user->peserta->divisi->nama }}</span>
        </div>
    </div>
    <hr>
    <br>
    <table id="my-table" class="table display">
        <thead>
        <tr>
            <th width="5%" class="text-center">#</th>
            <th width="15%">Tanggal</th>
            <th>Deskripsi</th>
            <th width="15%">Nilai</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $v)
            <tr>
                <td class="text-center">{{ $loop->index + 1 }}</td>
                <td>{{ $v->tanggal }}</td>
                <td>{{ $v->deskripsi }}</td>
                <td class="text-center">{{ $v->nilai }}</td>
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
                <p class="text-center">Peserta Magang</p>
            </div>
        </div>
        <div class="col-xs-5"></div>
        <div class="col-xs-3">
            <div class="text-center">
                <p class="text-center">Mengetahui,</p>
                <p class="text-center">Pembimbing,</p>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-xs-3">
            <div class="text-center">
                <p class="text-center">({{ $data[0]->user->peserta->nama }})</p>
            </div>
        </div>
        <div class="col-xs-5"></div>
        <div class="col-xs-3">
            <div class="text-center">
                <p class="text-center">({{ $data[0]->user->peserta->pembimbing->karyawan->nama }})</p>
            </div>
        </div>
    </div>
@endsection
