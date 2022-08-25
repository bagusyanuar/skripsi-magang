<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;

class PengajuanController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('admin.pengajuan.index');
    }

    public function detail()
    {
        return view('admin.pengajuan.detail');
    }
}
