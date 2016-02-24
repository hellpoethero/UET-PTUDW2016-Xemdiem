<?php

namespace App\Http\Controllers;

use App\hoc_ky_nam_hoc;
use App\nam_hoc;

use App\Http\Requests;
use Illuminate\Http\Request;

class NamHocController extends Controller
{
    //
    function index() {
        $nam_hoc_list = nam_hoc::select('nam_bat_dau', 'nam_ket_thuc')->get();
        return view('nam_hoc.index')->with('data', $nam_hoc_list);
    }

    function show(Request $request, $id) {
        $hoc_ky_by_year = new HocKyNamHocController();
        return view('nam_hoc.show')->with('data', $hoc_ky_by_year->indexByNamHoc($request,$id));
    }

    function store(Request $request) {
        if ($request->nam_bat_dau != null and is_numeric($request->nam_bat_dau) ) {
            $nam_hoc = new nam_hoc();
            $nam_hoc->nam_bat_dau = $request->nam_bat_dau;
            $nam_hoc->nam_ket_thuc = $request->nam_bat_dau + 1;
            if (nam_hoc::where('nam_bat_dau', '=', $nam_hoc->nam_bat_dau)->exists()) {

                //lỗi trùng dữ liệu trong database
                echo '<script language="javascript">';
                echo 'window.location="/namhoc";';
                echo 'alert("Năm học đã tồn tại")';
                echo '</script>';
            }

            //dữ liệu hợp lệ
            if ($nam_hoc->save()) {
                // Tự động thêm học kỳ sau khi thêm năm học thành công
                $hoc_ky_nam_hoc = new HocKyNamHocController();
                $hoc_ky_nam_hoc->create($request,$nam_hoc->id);

                echo '<script language="javascript">';
                echo 'window.location="/namhoc";';
                echo 'alert("Thêm năm học thành công")';
                echo '</script>';
            }
        }
        //lỗi dữ liệu không hợp lệ
        echo '<script language="javascript">';
        echo 'window.location="/namhoc";';
        echo 'alert("Thông tin không hợp lệ")';
        echo '</script>';
    }

    function destroy(Request $request, $nam_bat_dau) {
        $nam_hoc = nam_hoc::where('nam_bat_dau',$nam_bat_dau)->get();
        if ($nam_hoc != null) {
            $id = nam_hoc::select('id')->where('nam_bat_dau',$nam_bat_dau)->get();
            hoc_ky_nam_hoc::where('nam_hoc_id', $id[0]['id'])->delete();
            nam_hoc::where('nam_bat_dau',$nam_bat_dau)->delete();
        }
        return redirect('/namhoc');
    }
}
