<?php


namespace App\Http\Controllers\Laporan;


use App\Helper\CustomController;
use App\Models\Kegiatan;
use App\Models\User;
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
        $data = Kegiatan::with(['user.peserta.pembimbing.karyawan'])->where('user_id', '=', $id)->get();
        $user = User::with('peserta.divisi')->findOrFail($id);
        return $this->convertToPdf('admin.laporan.kegiatan.cetak', [
            'data' => $data,
            'user' => $user
        ]);
    }
}
