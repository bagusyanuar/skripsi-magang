<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }


}
