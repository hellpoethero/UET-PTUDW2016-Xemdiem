<?php

namespace App\Http\Controllers;

use App\hoc_ky_nam_hoc;
use App\lop_mon_hoc;
use App\mon_hoc;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LopMonHocController extends Controller
{
    //
    function index() {
        $this->data['lop_mon_hoc'] = lop_mon_hoc::
        join('mon_hoc','lop_mon_hoc.mon_hoc_id','=','mon_hoc.id')
            ->select('mon_hoc.name', 'mon_hoc.id_name', 'lop_mon_hoc.so_thu_tu','lop_mon_hoc.id','lop_mon_hoc.hoc_ky_nam_hoc_id')
            ->get();
        $this->data['mon_hoc'] = mon_hoc::select('id','name','id_name')->get();
        $this->data['hoc_ky_nam_hoc'] = hoc_ky_nam_hoc::
            join('hoc_ky','hoc_ky.id','=','hoc_ky_nam_hoc.hoc_ky_id')
            ->join('nam_hoc','nam_hoc.id','=','hoc_ky_nam_hoc.nam_hoc_id')
            ->select('hoc_ky_nam_hoc.id','hoc_ky.name','nam_hoc.nam_bat_dau','nam_hoc.nam_ket_thuc')->get();
        return view('lop_mon_hoc.index')->with('data', $this->data);
    }

    function create() {
        return view('lop_mon_hoc.create');
    }

    function store(Request $request) {
        if ($request->hoc_ky_nam_hoc_id != null and $request->mon_hoc_id != null) {
            $lop_mon_hoc = new lop_mon_hoc();
            $lop_mon_hoc->mon_hoc_id = $request->mon_hoc_id;
            $lop_mon_hoc->hoc_ky_nam_hoc_id = $request->hoc_ky_nam_hoc_id;

            if (lop_mon_hoc::
                where('mon_hoc_id', '=', $lop_mon_hoc->mon_hoc_id)
                ->where('hoc_ky_nam_hoc_id', '=', $lop_mon_hoc->hoc_ky_nam_hoc_id)
                ->exists()) {
                $max = lop_mon_hoc::
                    where('mon_hoc_id', '=', $lop_mon_hoc->mon_hoc_id)
                    ->where('hoc_ky_nam_hoc_id', '=', $lop_mon_hoc->hoc_ky_nam_hoc_id)
                    ->max('so_thu_tu');
                $lop_mon_hoc->so_thu_tu = $max+1;
            } else {
                $lop_mon_hoc->so_thu_tu = 1;
            }

            //dữ liệu hợp lệ
            if ($lop_mon_hoc->save()) {

                echo '<script language="javascript">';
//                echo 'window.location="/lopmonhoc";';
                echo 'alert("Thêm lớp môn học thành công")';
                echo '</script>';
            }
        }
        //lỗi dữ liệu không hợp lệ
        echo '<script language="javascript">';
        echo 'window.location="/lopmonhoc";';
        echo 'alert("Thông tin không hợp lệ")';
        echo '</script>';
    }
}
