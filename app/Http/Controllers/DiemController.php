<?php

namespace App\Http\Controllers;

use App\nam_hoc;
use App\sinh_vien_diem;
use Illuminate\Http\Request;

use App\hoc_ky_nam_hoc;
use App\lop_mon_hoc;
use App\mon_hoc;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class DiemController extends Controller
{
    //
    function index() {
        $this->data['diem'] = sinh_vien_diem::
            join('sinh_vien', 'sinh_vien.ma_sinh_vien','=','sinh_vien_diem.ma_sinh_vien')
            ->join('lop_mon_hoc','lop_mon_hoc.id','=','sinh_vien_diem.lop_mon_hoc_id')
            ->join('mon_hoc', 'mon_hoc.id','=','lop_mon_hoc.mon_hoc_id')
            ->select('sinh_vien.ma_sinh_vien','mon_hoc.name'
            ,'sinh_vien.name as hoten','mon_hoc.id_name','lop_mon_hoc.so_thu_tu'
            ,'sinh_vien_diem.diem')
            ->get();
        $this->data['lop_mon_hoc'] = lop_mon_hoc::
            join('mon_hoc','lop_mon_hoc.mon_hoc_id','=','mon_hoc.id')
            ->select('mon_hoc.name', 'mon_hoc.id_name', 'lop_mon_hoc.so_thu_tu','lop_mon_hoc.id','lop_mon_hoc.hoc_ky_nam_hoc_id')
            ->get();
        $this->data['mon_hoc'] = mon_hoc::select('id','name','id_name')->get();
        $this->data['hoc_ky_nam_hoc'] = hoc_ky_nam_hoc::
            join('hoc_ky','hoc_ky.id','=','hoc_ky_nam_hoc.hoc_ky_id')
            ->join('nam_hoc','nam_hoc.id','=','hoc_ky_nam_hoc.nam_hoc_id')
            ->select('hoc_ky_nam_hoc.id','hoc_ky.name','nam_hoc.nam_bat_dau','nam_hoc.nam_ket_thuc')->get();
        return view('diem.index')->with('data',$this->data);
    }

    function store(Request $request) {
        if ($request->hasFile('bangdiem')) {
            $file_name = $request->hoc_ky_nam_hoc.'_'.$request->lop_mon_hoc.'_'.
                $request->file('bangdiem')->getClientOriginalName();
            $request->file('bangdiem')->move('upload/bangdiem', $file_name);
        }
        Excel::load('upload/bangdiem'."/".$file_name, function($reader) {
            $data = $reader->get();
            echo $data;
        });
    }
}
