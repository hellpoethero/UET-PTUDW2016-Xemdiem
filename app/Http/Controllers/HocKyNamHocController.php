<?php

namespace App\Http\Controllers;

use App\hoc_ky_nam_hoc;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HocKyNamHocController extends Controller
{
    // Hiển thị danh sách học kỳ theo năm học
    function indexByNamHoc(Request $request, $nam_bat_dau) {
        $hoc_ky_nam_hoc =
            hoc_ky_nam_hoc::
            join('nam_hoc', 'hoc_ky_nam_hoc.nam_hoc_id', '=', 'nam_hoc.id')
            ->join('hoc_ky', 'hoc_ky.id','=', 'hoc_ky_nam_hoc.hoc_ky_id')
            ->select('hoc_ky.id','hoc_ky.name', 'nam_hoc.nam_bat_dau', 'nam_hoc.nam_ket_thuc')
            ->where('nam_hoc.nam_bat_dau', $nam_bat_dau)->get();
        return $hoc_ky_nam_hoc;
    }

    function create(Request $request, $id) {
        $hoc_ky_nam_hoc_1 = new hoc_ky_nam_hoc();
        $hoc_ky_nam_hoc_2 = new hoc_ky_nam_hoc();
        $hoc_ky_nam_hoc_1->hoc_ky_id = 1;
        $hoc_ky_nam_hoc_2->hoc_ky_id = 2;
        $hoc_ky_nam_hoc_1->nam_hoc_id = $id;
        $hoc_ky_nam_hoc_2->nam_hoc_id = $id;
        $hoc_ky_nam_hoc_1->save();
        $hoc_ky_nam_hoc_2->save();
    }
}
