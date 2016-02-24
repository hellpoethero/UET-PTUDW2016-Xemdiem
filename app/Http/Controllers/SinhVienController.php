<?php

namespace App\Http\Controllers;

use App\sinh_vien;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SinhVienController extends Controller
{
    //
    function index() {
        $sinh_vien_list = sinh_vien::select('ma_sinh_vien', 'name')->get();
        return view('sinh_vien.index')->with('data', $sinh_vien_list);
    }
}
