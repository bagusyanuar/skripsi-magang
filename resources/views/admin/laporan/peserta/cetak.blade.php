@extends('admin.laporan.index')

@section('content')
    <div class="text-center f-bold report-title">Laporan Peserta
        Magang {{ $status == 'aktif' ? 'Aktif' : 'Selesai' }}</div>
    <hr>
    <br>
    <table id="my-table" class="table display">
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
        @foreach($data as $v)
            <tr>
                <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
                <td>{{ $v->nama }}</td>
                <td>{{ $v->divisi->nama }}</td>
                <td>{{ $v->pembimbing->karyawan->nama }}</td>
                <td>{{ $v->sekolah }}</td>
                <td>{{ $v->masuk }}</td>
                <td>{{ $v->keluar }}</td>
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
