<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Bagian;
use App\Models\Karyawan;
use App\Models\Peserta;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PesertaController extends CustomController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = User::with(['peserta.divisi', 'peserta.pembimbing.karyawan'])->where('role', '=', 'peserta')->get();
        return view('admin.pengguna.peserta.index')->with(['data' => $data]);
    }

    public function add_page()
    {
        $bagian = Bagian::all();
        $karyawan = User::with('karyawan')->where('role', '=', 'karyawan')->get();
        return view('admin.pengguna.peserta.add')->with(['bagian' => $bagian, 'karyawan' => $karyawan]);
    }

    public function create()
    {
        try {
            DB::beginTransaction();
            $data = [
                'username' => $this->postField('username'),
                'password' => Hash::make($this->postField('password')),
                'role' => 'peserta',
            ];
            $user = User::create($data);

            Peserta::create([
                'user_id' => $user->id,
                'bagian_id' => $this->postField('divisi'),
                'pembimbing_id' => $this->postField('pembimbing') == '' ? null : $this->postField('pembimbing'),
                'nama' => $this->postField('nama'),
                'no_hp' => $this->postField('no_hp'),
                'alamat' => $this->postField('alamat'),
                'sekolah' => $this->postField('sekolah'),
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
        $data = User::with(['peserta.divisi', 'peserta.pembimbing.karyawan'])->findOrFail($id);
        $karyawan = User::with('karyawan')->where('role', '=', 'karyawan')->get();
        $bagian = Bagian::all();
        return view('admin.pengguna.peserta.edit')->with(['data' => $data, 'bagian' => $bagian, 'karyawan' => $karyawan]);
    }

    public function patch()
    {
        try {
            DB::beginTransaction();
            $id = $this->postField('id');
            $user = User::find($id);

            $data = [
                'username' => $this->postField('username'),
                'role' => 'peserta'
            ];

            if ($this->postField('password') !== '') {
                $data['password'] = Hash::make($this->postField('password'));
            }
            $user->update($data);

            $peserta = Peserta::with('user')->where('user_id', '=', $user->id)->firstOrFail();
            $peserta_data = [
                'bagian_id' => $this->postField('divisi'),
                'nama' => $this->postField('nama'),
                'no_hp' => $this->postField('no_hp'),
                'sekolah' => $this->postField('sekolah'),
                'alamat' => $this->postField('alamat'),
                'pembimbing_id' => $this->postField('pembimbing') == '' ? null : $this->postField('pembimbing'),
            ];
            $peserta->update($peserta_data);
            DB::commit();
            return redirect('/peserta')->with(['success' => 'Berhasil Merubah Data...']);
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan' . $e->getMessage()]);
        }
    }

    public function destroy()
    {
        try {
            DB::beginTransaction();
            $id = $this->postField('id');
            Peserta::where('user_id', '=', $id)->delete();
            User::destroy($id);
            DB::commit();
            return $this->jsonResponse('success', 200);
        }catch (\Exception $e) {
            DB::rollBack();
            return $this->jsonResponse('failed', 500);
        }
    }
}
