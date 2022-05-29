<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = User::with('karyawan')->where('role', '!=', 'peserta')->get();
        return view('admin.pengguna.karyawan.index')->with(['data' => $data]);
    }

    public function add_page()
    {
        return view('admin.pengguna.karyawan.add');
    }

    public function create()
    {
        try {
            DB::beginTransaction();
            $data = [
                'username' => $this->postField('username'),
                'password' => Hash::make($this->postField('password')),
                'role' => $this->postField('role'),
            ];
            $user = User::create($data);

            Karyawan::create([
                'user_id' => $user->id,
                'nama' => $this->postField('nama')
            ]);
            DB::commit();
            return redirect()->back()->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }

    public function edit_page($id)
    {
        $data = User::findOrFail($id);
        return view('admin.pengguna.karyawan.edit')->with(['data' => $data]);
    }

    public function patch()
    {
        try {
            $id = $this->postField('id');
            $user = User::find($id);

            $data = [
                'username' => $this->postField('username'),
                'role' => $this->postField('role'),
            ];

            if ($this->postField('password') !== '') {
                $data['password'] = Hash::make($this->postField('password'));
            }
            $user->update($data);
            return redirect('/karyawan')->with(['success' => 'Berhasil Merubah Data...']);
        }catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan' . $e->getMessage()]);
        }
    }

    public function destroy()
    {
        try {
            $id = $this->postField('id');
            User::destroy($id);
            return $this->jsonResponse('success', 200);
        }catch (\Exception $e) {
            return $this->jsonResponse('failed', 500);
        }
    }
}
