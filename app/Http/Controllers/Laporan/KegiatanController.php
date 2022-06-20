<?php


namespace App\Http\Controllers\Laporan;


use App\Helper\CustomController;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Auth;

class KegiatanController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function cetak()
    {
        $id = Auth::id();
        $data = Kegiatan::with(['user.peserta.pembimbing'])->where('user_id', '=', $id)->get();
        return $this->convertToPdf('admin.laporan.kegiatan.cetak', [
            'data' => $data
        ]);
    }
}
