<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use App\Models\Member;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'role' => 'admin'
        ]);

        Karyawan::create([
            'user_id' => $user->id,
            'nama' => 'Administrator',
        ]);
    }
}
