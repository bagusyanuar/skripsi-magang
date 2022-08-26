<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="css/bootstrap3.min.css" rel="stylesheet">
    <style>
        .report-title {
            font-size: 14px;
            font-weight: bolder;
        }
        .f-bold {
            font-weight: bold;
        }
        .footer {
            position: fixed;
            bottom: 0cm;
            right: 0cm;
            height: 2cm;
        }
        .w-50 {
            width: 50%;
        }
        .font-weight-bold {
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
        .d-flex {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .mb-0{
            margin-bottom: 0;
        }

        .f12 {
            font-size: 12px;
        }

        .font-italic {
            font-style: italic;
        }
    </style>
</head>
<body>
<div style="position: relative">
    <img src="{{ public_path('assets/icon/logo-wonogiri.png') }}" height="50" style="position: absolute; top: 0; left: 0">
    <div class="text-center f-bold report-title">DINAS KABUPATEN WONOGIRI</div>
    <div class="text-center">
        <span>Jl. Wonogiri No. 14, Wonogiri, Jawa Tengah</span>
    </div>
</div>

<hr>
<p class="mb-0 f12">Kepada Yth :</p>
<p class="mb-0 f-bold f12">Sdr. {{ ucwords($data->user->peserta->nama) }}</p>
<p style="margin-bottom: 10px" class="f-bold f12">Siswa / Mahasiswa {{ ucwords($data->user->peserta->sekolah) }}</p>
<p class="f12">di tempat</p>
<p class="f12 font-italic">Dengan hormat,</p>
<p class="f12 text-justify">Memperhatikan pengajuan saudara nomor : <span
        class="f-bold">{{ $data->no_pengajuan }}</span>
    perihal permohonan kerja magang yang diajukan kepada kami, maka dengan ini kami beritahukan
    bahwa pengajuan permohonan kerja magang saudara kami <span
        class="f-bold">{{ ucwords($data->status) }} </span>
    @if($data->status == 'terima')
        dengan ketentuan sebagai berikut :
    @else
        dengan keterangan sebagai berikut :
    @endif
</p>
@if($data->status == 'terima')
    <ol type="1">
        <li>
            <p class="f12 text-justify mb-0">Jadwal Kerja Magang Dilaksanakan dari
                tanggal {{ $data->tanggal_mulai }}
                s/d {{$data->tanggal_selesai}}.</p>
        </li>
        <li>
            <p class="f12 text-justify mb-0">Peserta kerja magang melaksanakan kerja magang
                pada divisi <span
                    class="font-weight-bold">{{ $data->user->peserta->divisi->nama }}</span></p>
        </li>
        <li>
            <p class="f12 text-justify mb-0">Dalam pelaksanaan kerja magang peserta magang
                wajib mematuhi tata tertib institusi kami.</p>
        </li>
    </ol>

@else
    <p class="f-bold text-center f12">{{ $data->keterangan }}</p>
@endif
<p class="f12 text-justify">Demikianlah pemberitahuan ini kami sampaikan, atas perhatian
    dan kerjasamanya, kami ucapkan terima kasih.
</p>
<br>
<br>
<div class="row">
    <div class="col-xs-3">
        <p class="text-center f12">Wonogiri, {{ $data->updated_at->format('d-m-Y') }}</p>
        <p class="text-center f12">Hormat Kami</p>
        <div class="text-center">
            <img src="{{ public_path('/assets/icon/ttd.png') }}" height="80" class="text-center">
        </div>
        <p class="text-center f12 mb-0 f-bold">Drs. Bambang, M.M</p>
        <p class="text-center f12 f-bold">(Kepala Dinas)</p>
    </div>
</div>
</body>
</html>
