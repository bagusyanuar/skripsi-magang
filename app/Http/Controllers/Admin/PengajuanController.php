<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Pengajuan;
use App\Models\Peserta;
use App\Models\User;

class PengajuanController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Pengajuan::with(['user', 'bagian'])
            ->where('status', '=', 'menunggu')
            ->orderBy('id', 'ASC')
            ->get();
        return view('admin.pengajuan.index')->with(['data' => $data]);
    }

    public function detail($id)
    {
        $data = Pengajuan::with(['user', 'bagian'])->findOrFail($id);
        $peserta = Peserta::with('user')->where('user_id', '=', $data->user_id)->firstOrFail();
        if ($this->request->method() === 'POST') {
            try {
                $status = $this->postField('status');
                if ($status === 'tolak') {
                    $data->update([
                        'status' => 'tolak',
                        'keterangan' => $this->postField('keterangan')
                    ]);
                    $peserta->update([
                        'status' => 'menunggu'
                    ]);
                } else {
                    $data->update([
                        'status' => 'terima',
                        'keterangan' => 'Selamat Pengajuan Magang Anda Kami Terima'
                    ]);
                    $peserta->update([
                        'status' => 'aktif',
                        'pembimbing_id' => $this->postField('pembimbing'),
                        'bagian_id' => $data->bagian_id,
                        'masuk' => $data->tanggal_mulai,
                        'keluar' => $data->tanggal_selesai,
                    ]);
                }
                return redirect('/pengajuan')->with(['succes' => 'Berhasil Merubah Data...']);
            } catch (\Exception $e) {
                return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
            }
        }
        $karyawan = User::with('karyawan')->where('role', '=', 'karyawan')->get();
        return view('admin.pengajuan.detail')->with(['data' => $data, 'karyawan' => $karyawan]);
    }
}
