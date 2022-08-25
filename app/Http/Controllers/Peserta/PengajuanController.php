<?php


namespace App\Http\Controllers\Peserta;


use App\Helper\CustomController;
use App\Models\Bagian;
use App\Models\Pengajuan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Pengajuan::with(['user.peserta', 'bagian'])
            ->where('user_id', '=', Auth::id())
            ->get();
        return view('peserta.pengajuan.index')->with(['data' => $data]);
    }

    public function add_page()
    {
        $bagian = Bagian::all();
        return view('peserta.pengajuan.add')->with(['bagian' => $bagian]);
    }

    public function create()
    {
        try {
            $data = [
                'user_id' => Auth::id(),
                'tanggal' => Carbon::now(),
                'bagian_id' => $this->postField('divisi'),
                'tanggal_mulai' => $this->postField('mulai'),
                'tanggal_selesai' => $this->postField('selesai'),
                'status' => 'menunggu',
                'keterangan' => ''
            ];
            Pengajuan::create($data);
            return redirect()->back()->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }
}
