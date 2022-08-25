<?php


namespace App\Http\Controllers\Peserta;


use App\Helper\CustomController;
use App\Models\Bagian;
use App\Models\Pengajuan;
use App\Models\Peserta;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            ->orderBy('id', 'DESC')
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
        DB::beginTransaction();
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
            $peserta = Peserta::with('user')
                ->where('user_id', '=', Auth::id())
                ->first();
            $peserta->update([
                'status' => 'mengajukan'
            ]);
            DB::commit();
            return redirect('/pengajuan-magang')->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }
}
