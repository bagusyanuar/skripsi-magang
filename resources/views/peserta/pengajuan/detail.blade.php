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
            <li class="breadcrumb-item">
                <a href="/pengajuan-magang">Permohonan Pengajuan Magang</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Pemberitahuan
            </li>
        </ol>
    </div>
    <div class="w-100 p-2">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-10 col-sm-11">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('/assets/icon/logo-wonogiri.png') }}" height="70">
                            <div class="flex-grow-1">
                                <p class="text-center font-weight-bold mb-0" style="font-size: 16px">DINAS KABUPATEN
                                    WONOGIRI</p>
                                <p class="text-center" style="font-size: 12px">Jl. Wonogiri No. 14, Wonogiri, Jawa
                                    Tengah</p>
                            </div>
                        </div>
                        <hr>
                        <p style="font-size: 14px" class="mb-0">Kepada Yth :</p>
                        <p style="font-size: 14px; font-weight: bold" class="mb-0">
                            Sdr. {{ ucwords($data->user->peserta->nama) }}</p>
                        <p style="font-size: 14px; font-weight: bold" class="mb-1">Siswa /
                            Mahasiswa {{ ucwords($data->user->peserta->sekolah) }}</p>
                        <p style="font-size: 14px;">di tempat</p>
                        <p class="f-14 font-italic">Dengan hormat,</p>
                        <p class="f-14 text-justify">Memperhatikan pengajuan saudara nomor : <span
                                class="font-weight-bold">{{ $data->no_pengajuan }}</span>
                            perihal permohonan kerja magang yang diajukan kepada kami, maka dengan ini kami beritahukan
                            bahwa pengajuan permohonan kerja magang saudara kami <span
                                class="font-weight-bold">{{ ucwords($data->status) }} </span>
                            @if($data->status == 'terima')
                                dengan ketentuan sebagai berikut :
                            @else
                                dengan keterangan sebagai berikut :
                            @endif
                        </p>
                        @if($data->status == 'terima')
                            <ol type="1">
                                <li>
                                    <p class="f-14 text-justify mb-0">Jadwal Kerja Magang Dilaksanakan dari
                                        tanggal {{ $data->tanggal_mulai }}
                                        s/d {{$data->tanggal_selesai}}.</p>
                                </li>
                                <li>
                                    <p class="f-14 text-justify mb-0">Peserta kerja magang melaksanakan kerja magang
                                        pada divisi <span
                                            class="font-weight-bold">{{ $data->user->peserta->divisi->nama }}</span></p>
                                </li>
                                <li>
                                    <p class="f-14 text-justify mb-0">Dalam pelaksanaan kerja magang peserta magang
                                        wajib mematuhi tata tertib institusi kami.</p>
                                </li>
                            </ol>

                        @else
                            <p class="font-weight-bold text-center f-14">{{ $data->keterangan }}</p>
                        @endif
                        <p class="f-14 text-justify">Demikianlah pemberitahuan ini kami sampaikan, atas perhatian
                            dan kerjasamanya, kami ucapkan terima kasih.
                        </p>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-lg-3 col-md-3">
                                <p class="text-center f-14">Wonogiri, {{ $data->updated_at->format('d-m-Y') }}</p>
                                <p class="text-center f-14">Hormat Kami</p>
                                <div class="text-center">
                                    <img src="{{ asset('/assets/icon/ttd.png') }}" height="80" class="text-center">
                                </div>
                                <p class="text-center f-14 mb-0 font-weight-bold">Drs. Bambang, M.M</p>
                                <p class="text-center f-14 font-weight-bold">(Kepala Dinas)</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="text-right mt-2">
                    <a href="/pengajuan-magang/{{ $data->id }}/cetak" target="_blank" class="btn btn-success">
                        <i class="fa fa-print mr-2"></i>
                        <span>Cetak</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            $('#btn-cetak').on('click', function (e) {
                e.preventDefault();
                window.open('/kegiatan/cetak', '_blank');
            })
        });
    </script>
@endsection
