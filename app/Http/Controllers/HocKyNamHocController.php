<?php

namespace App\Http\Controllers;

use App\hoc_ky_nam_hoc;
use App\lop_mon_hoc;
use App\nam_hoc;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HocKyNamHocController extends Controller
{
    // Hiển thị danh sách học kỳ theo năm học
    function indexByNamHoc($nam_bat_dau) {
        $hoc_ky_nam_hoc =
            hoc_ky_nam_hoc::
            join('nam_hoc', 'hoc_ky_nam_hoc.nam_hoc_id', '=', 'nam_hoc.id')
            ->join('hoc_ky', 'hoc_ky.id','=', 'hoc_ky_nam_hoc.hoc_ky_id')
            ->select('hoc_ky.id','hoc_ky.name', 'nam_hoc.nam_bat_dau', 'nam_hoc.nam_ket_thuc')
            ->where('nam_hoc.nam_bat_dau', $nam_bat_dau)->get();
        return $hoc_ky_nam_hoc;
    }

    function create(Request $request) {
        $this->store($request->nam_hoc_id, $request->name, $request->bo_sung);
        $nam_hoc = nam_hoc::select('nam_bat_dau')->where('id', $request->nam_hoc_id)->get()[0];
        return redirect("/namhoc/".$nam_hoc['nam_bat_dau']);
    }

    function store($nam_hoc_id, $name, $bo_sung) {
        $hoc_ky = new hoc_ky_nam_hoc();
        $hoc_ky->nam_hoc_id = $nam_hoc_id;
        $hoc_ky->name = $name;
        $hoc_ky->bo_sung = $bo_sung;
        $hoc_ky->save();
    }
    function createByNamHoc($nam_hoc_id) {
        $this->store($nam_hoc_id, "Học kỳ 1", "");
        $this->store($nam_hoc_id, "Học kỳ 2", "");
        $this->store($nam_hoc_id, "Học kỳ 1", "Lớp mở đợt 2");
        $this->store($nam_hoc_id, "Học kỳ 2", "Lớp mở đợt 2");
        $this->store($nam_hoc_id, "Học kỳ phụ", "");
    }

    function destroyByNamHoc($nam_hoc_id) {
        foreach (hoc_ky_nam_hoc::select('id')->where('nam_hoc_id', $nam_hoc_id)->get() as $hoc_ky_nam_hoc) {
            echo $hoc_ky_nam_hoc['id'];
            $this->destroy($hoc_ky_nam_hoc['id']);
        }
    }

    function delete(Request $request, $id) {
        $this->destroy($id);
        return redirect('namhoc/'.$request->nam_hoc);
    }
    function destroy($id) {
        $lop_mon_hoc = new LopMonHocController();
        $lop_mon_hoc->destroyByHocKy($id);
        hoc_ky_nam_hoc::where('id', $id)->delete();
    }
}
