<?php


namespace App\Http\Controllers\Laporan;


use App\Helper\CustomController;
use App\Models\Kegiatan;
use App\Models\Peserta;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PesertaController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('admin.laporan.peserta.index');
    }

    public function data()
    {
        try {
            $status = $this->field('status');
            $data = Peserta::with(['user', 'pembimbing.karyawan', 'divisi'])
                ->where('status', '=', $status)
                ->get();
            return $this->basicDataTables($data);
        }catch (\Exception $e) {
            return $this->basicDataTables([]);
        }
    }

    public function cetak()
    {
        $status = $this->field('status');
        $data = Peserta::with(['user', 'pembimbing.karyawan', 'divisi'])
            ->where('status', '=', $status)
            ->get();
        return $this->convertToPdf('admin.laporan.peserta.cetak', [
            'data' => $data,
            'status' => $status,
        ]);
    }
}
