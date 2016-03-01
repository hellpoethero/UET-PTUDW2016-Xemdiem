<?php

namespace App\Http\Controllers;

use App\lop_mon_hoc;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class getDataController extends Controller
{
    //
    public function getData(Request $request) {
        switch ($request->data) {
            case "lop_mon_hoc":
                $data = $this->getLHM($request->hoc_ky_nam_hoc,
                    $request->name,
                    $request->id_name
                );
                break;
            default:
                $data = [];
        }
//        echo json_encode($data);
        return response()->json($data);
    }

    public function getLHM($hoc_ky_nam_hoc, $name, $id_name) {
        $data = lop_mon_hoc::leftJoin('bang_diem_file','bang_diem_file.lop_mon_hoc_id','=','lop_mon_hoc.id')
            ->select('lop_mon_hoc.id','lop_mon_hoc.name', 'lop_mon_hoc.id_name', 'lop_mon_hoc.so_thu_tu','bang_diem_file.file')
            ->where("lop_mon_hoc.hoc_ky_nam_hoc_id",$hoc_ky_nam_hoc)
//            ->where("lop_mon_hoc.name",'like','%'.$name.'%')
//            ->where(DB::raw('concat(lop_mon_hoc.id_name," ",lop_mon_hoc.so_thu_tu)'),'like','%'.$id_name.'%')
            ->get();

        return $data;
    }
}
