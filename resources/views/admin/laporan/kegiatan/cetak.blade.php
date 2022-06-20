@extends('admin.laporan.index')

@section('content')
    <div class="text-center f-bold report-title">Laporan Kegiatan Peserta</div>
    <hr>
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
@endsection
