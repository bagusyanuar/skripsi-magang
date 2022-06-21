<?php


namespace App\Http\Controllers\Pembimbing;


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
        $id = Auth::id();
        $data = Peserta::with(['divisi', 'user'])->where('pembimbing_id', '=', $id)->get();
        return view('pembimbing.peserta-bimbingan.index')->with(['data' => $data]);
    }

    public function detail($id)
    {
        $data = Kegiatan::with('user')->where('user_id', '=', $id)->get();
        $user = User::with('peserta.divisi')->findOrFail($id);
        return view('pembimbing.peserta-bimbingan.detail')->with(['data' => $data, 'user' => $user]);
    }

    public function nilai($id)
    {
        try {
            $data = Kegiatan::with('user')->where('id', '=', $id)->first();
            if(!$data) {
                return $this->jsonResponse('kegiatan tidak ditemukan', 202);
            }
            $data->update([
                'nilai' => $this->postField('nilai')
            ]);
            return $this->jsonResponse('success', 200);
        }catch (\Exception $e) {
            return $this->jsonResponse('terjadi kesalahan', 500);
        }

    }
}
