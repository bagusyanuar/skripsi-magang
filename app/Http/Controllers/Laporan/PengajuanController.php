<?php


namespace App\Http\Controllers\Laporan;


use App\Helper\CustomController;
use App\Models\Pengajuan;

class PengajuanController extends CustomController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('admin.laporan.pengajuan.index');
    }

    public function data()
    {
        try {
            $tgl1 = $this->field('tgl1');
            $tgl2 = $this->field('tgl2');
            $data = Pengajuan::with(['user.peserta', 'bagian'])
                ->whereBetween('tanggal', [$tgl1, $tgl2])
                ->get();
            return $this->basicDataTables($data);
        }catch (\Exception $e) {
            return $this->basicDataTables([]);
        }
    }

    public function cetak()
    {
        $tgl1 = $this->field('tgl1');
        $tgl2 = $this->field('tgl2');
        $data = Pengajuan::with(['user.peserta', 'bagian'])
            ->whereBetween('tanggal', [$tgl1, $tgl2])
            ->get();
        return $this->convertToPdf('admin.laporan.pengajuan.cetak', [
            'tgl1' => $tgl1,
            'tgl2' => $tgl2,
            'data' => $data
        ]);
    }
}
