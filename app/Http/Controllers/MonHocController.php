<?php

namespace App\Http\Controllers;

use App\mon_hoc;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MonHocController extends Controller
{
    //
    function index() {
        $mon_hoc_list = mon_hoc::all();
        return view('mon_hoc.index')->with('data', $mon_hoc_list);
    }

    function store(Request $request) {
        if ($request->name != null and $request->id_name != null) {
            $mon_hoc = new mon_hoc();
            $mon_hoc->id_name = $request->id_name;
            $mon_hoc->name = $request->name;
            if (mon_hoc::where('id_name', '=', $mon_hoc->id_name)->exists()) {

                //lỗi trùng dữ liệu trong database
                echo '<script language="javascript">';
//                echo 'window.location="/monhoc";';
                echo 'alert("Môn học đã tồn tại")';
                echo '</script>';
            }

            //dữ liệu hợp lệ
            if ($mon_hoc->save()) {

                echo '<script language="javascript">';
                echo 'window.location="/monhoc";';
                echo 'alert("Thêm môn học thành công")';
                echo '</script>';
            }
        }
        //lỗi dữ liệu không hợp lệ
        echo '<script language="javascript">';
        echo 'window.location="/monhoc";';
        echo 'alert("Thông tin không hợp lệ")';
        echo '</script>';
    }
}
