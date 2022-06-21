<?php


namespace App\Http\Controllers\Laporan;


use App\Helper\CustomController;
use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class KegiatanPesertaController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        return view('admin.laporan.kegiatan-peserta.index');
    }
    public function laporan_kegiatan()
    {
        try {
            $tgl1 = $this->field('tgl1');
            $tgl2 = $this->field('tgl2');
            $data = Kegiatan::with(['user.peserta.pembimbing.karyawan', 'user.peserta.divisi'])
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
        $data = Kegiatan::with(['user.peserta.pembimbing.karyawan', 'user.peserta.divisi'])
            ->whereBetween('tanggal', [$tgl1, $tgl2])
            ->get();
        return $this->convertToPdf('admin.laporan.kegiatan-peserta.cetak', [
            'tgl1' => $tgl1,
            'tgl2' => $tgl2,
            'data' => $data
        ]);
    }
}
