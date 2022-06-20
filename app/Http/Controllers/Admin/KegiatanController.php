<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Bagian;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Auth;

class KegiatanController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        $data = Kegiatan::all();
        return view('admin.kegiatan.index')->with(['data' => $data]);
    }

    public function add_page()
    {
        return view('admin.kegiatan.add');
    }

    public function create()
    {
        try {

            Kegiatan::create([
                'user_id' => Auth::id(),
                'tanggal' => $this->postField('tanggal'),
                'deskripsi' => $this->postField('deskripsi'),
                'nilai' => '-',
            ]);
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
                'tanggal' => $this->postField('tanggal'),
                'deskripsi' => $this->postField('deskripsi'),
            ];
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
