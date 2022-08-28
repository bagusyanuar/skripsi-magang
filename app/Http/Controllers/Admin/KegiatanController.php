<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Bagian;
use App\Models\Kegiatan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class KegiatanController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        $id = Auth::id();
        $data = Kegiatan::with('user')->where('user_id', '=', $id)->get();
        return view('admin.kegiatan.index')->with(['data' => $data]);
    }

    public function add_page()
    {
        return view('admin.kegiatan.add');
    }

    public function create()
    {
        try {

            $data = [
                'user_id' => Auth::id(),
                'tanggal' => Carbon::now(),
                'deskripsi' => $this->postField('deskripsi'),
                'nilai' => '-',
            ];
            $nama_gambar = $this->generateImageName('bukti');
            if ($nama_gambar !== '') {
                $data['bukti'] = $nama_gambar;
                $this->uploadImage('bukti', $nama_gambar, 'bukti');
            }
            Kegiatan::create($data);
            return redirect()->back()->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }

    public function edit_page($id)
    {
        $data = Kegiatan::findOrFail($id);
        return view('admin.kegiatan.edit')->with(['data' => $data]);
    }

    public function patch()
    {
        try {
            $id = $this->postField('id');
            $bagian = Kegiatan::find($id);
            $data = [
                'tanggal' => Carbon::now(),
                'deskripsi' => $this->postField('deskripsi'),
            ];
            $nama_gambar = $this->generateImageName('bukti');
            if ($nama_gambar !== '') {
                $data['bukti'] = $nama_gambar;
                $this->uploadImage('bukti', $nama_gambar, 'bukti');
            }
            $bagian->update($data);
            return redirect('/kegiatan')->with(['success' => 'Berhasil Merubah Data...']);
        }catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan' . $e->getMessage()]);
        }
    }

    public function destroy()
    {
        try {
            $id = $this->postField('id');
            Kegiatan::destroy($id);
            return $this->jsonResponse('success', 200);
        }catch (\Exception $e) {
            return $this->jsonResponse('failed', 500);
        }
    }
}
