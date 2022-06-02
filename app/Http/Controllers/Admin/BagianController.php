<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Bagian;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BagianController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index() {
        $data = Bagian::all();
        return view('admin.bagian.index')->with(['data' => $data]);
    }

    public function add_page()
    {
        return view('admin.bagian.add');
    }

    public function create()
    {
        try {

            Bagian::create([
                'nama' => $this->postField('nama')
            ]);
            return redirect()->back()->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }

    public function edit_page($id)
    {
        $data = Bagian::findOrFail($id);
        return view('admin.bagian.edit')->with(['data' => $data]);
    }

    public function patch()
    {
        try {
            $id = $this->postField('id');
            $bagian = Bagian::find($id);
            $data = [
                'nama' => $this->postField('nama'),
            ];
            $bagian->update($data);
            return redirect('/divisi')->with(['success' => 'Berhasil Merubah Data...']);
        }catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan' . $e->getMessage()]);
        }
    }

    public function destroy()
    {
        try {
            $id = $this->postField('id');
            Bagian::destroy($id);
            return $this->jsonResponse('success', 200);
        }catch (\Exception $e) {
            return $this->jsonResponse('failed', 500);
        }
    }
}
