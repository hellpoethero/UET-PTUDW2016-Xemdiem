<?php

namespace App\Http\Controllers;

use App\hoc_ky_nam_hoc;
use App\nam_hoc;

use App\Http\Requests;
use Illuminate\Http\Request;

class NamHocController extends Controller
{
    //hiển thị danh sách năm học
    function index() {
        $nam_hoc_list = nam_hoc::select('id', 'nam_bat_dau', 'nam_ket_thuc')->get();
        return view('nam_hoc.index')->with('data', $nam_hoc_list);
    }

    //hiển thị một năm học
    function show($nam_bat_dau) {
        $this->data['nam_hoc'] = nam_hoc::
            select('nam_bat_dau', 'nam_ket_thuc')
            ->where('nam_bat_dau',$nam_bat_dau)
            ->get()[0];
        $this->data['hoc_ky_nam_hoc'] = hoc_ky_nam_hoc::
            join('nam_hoc', 'nam_hoc.id','=','hoc_ky_nam_hoc.nam_hoc_id')
            ->select('hoc_ky_nam_hoc.id','hoc_ky_nam_hoc.name','hoc_ky_nam_hoc.bo_sung')
            ->where('nam_hoc.nam_bat_dau', $nam_bat_dau)->get();
        return view('nam_hoc.show')->with('data', $this->data);
    }

    function store(Request $request) {
        $location = "namhoc/";
        if ($request->nam_bat_dau != null and is_numeric($request->nam_bat_dau) ) {
            $nam_hoc = new nam_hoc();
            $nam_hoc->nam_bat_dau = $request->nam_bat_dau;
            $nam_hoc->nam_ket_thuc = $request->nam_bat_dau + 1;
            $nam_hoc->active = true;

            //Kiểm tra xem dữ liệu có bị trùng không
            if (!nam_hoc::where('nam_bat_dau', '=', $nam_hoc->nam_bat_dau)->exists()) {

                //dữ liệu hợp lệ
                if ($nam_hoc->save()) {
                    // Tự động thêm học kỳ sau khi thêm năm học thành công
                    $hoc_ky_nam_hoc = new HocKyNamHocController();
                    $hoc_ky_nam_hoc->createByNamHoc($nam_hoc->id);

                    $this->alert($location, "Thêm năm học thành công!");
                } else {
                    //Có lỗi hệ thống xảy ra
                    $this->alert($location, "Có lỗi xảy ra!");
                }
            } else {
                //lỗi trùng dữ liệu trong database
                $this->alert($location, "Năm học đã tồn tại!");
            }
        }
        //lỗi dữ liệu không hợp lệ
        $this->alert($location, "Thông tin không hợp lệ!");
    }

    function destroy($nam_bat_dau) {
        $nam_hoc = nam_hoc::where('nam_bat_dau',$nam_bat_dau)->get();
        if ($nam_hoc != null) {
            $id = nam_hoc::select('id')->where('nam_bat_dau',$nam_bat_dau)->get()[0]['id'];
            $hoc_ky_nam_hoc = new HocKyNamHocController();
            $hoc_ky_nam_hoc->destroyByNamHoc($id);
            nam_hoc::where('nam_bat_dau',$nam_bat_dau)->delete();
        }
        return redirect('/namhoc');
    }

    function alert($location, $message) {
        echo '<script language="javascript">';
        echo 'window.location="/'.$location.'";';
        echo 'alert("'.$message.'");';
        echo '</script>';
    }
}
