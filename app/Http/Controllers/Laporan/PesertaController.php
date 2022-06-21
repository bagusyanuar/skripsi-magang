<?php


namespace App\Http\Controllers\Laporan;


use App\Helper\CustomController;
use App\Models\Kegiatan;
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
        $data = User::with(['peserta.divisi', 'peserta.pembimbing.karyawan'])->where('role', '=', 'peserta')->get();
        return view('admin.laporan.peserta.index')->with(['data' => $data]);
    }

    public function cetak()
    {
        $data = User::with(['peserta.divisi', 'peserta.pembimbing.karyawan'])->where('role', '=', 'peserta')->get();
        return $this->convertToPdf('admin.laporan.peserta.cetak', [
            'data' => $data,
        ]);
    }
}
