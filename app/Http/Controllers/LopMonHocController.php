<?php

namespace App\Http\Controllers;

use App\bang_diem_file;
use App\hoc_ky_nam_hoc;
use App\lop_mon_hoc;
use App\lop_mon_hoc_file;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class LopMonHocController extends Controller
{
    //
    function index() {
        $this->data['hoc_ky_nam_hoc'] = hoc_ky_nam_hoc::
            join('nam_hoc','nam_hoc.id','=','hoc_ky_nam_hoc.nam_hoc_id')
            ->select('hoc_ky_nam_hoc.id','hoc_ky_nam_hoc.name','nam_hoc.nam_bat_dau','nam_hoc.nam_ket_thuc','hoc_ky_nam_hoc.bo_sung')
            ->where('nam_hoc.active',true)
            ->get();
        return view('lop_mon_hoc.index')->with('data', $this->data);
    }

    function show(Request $request, $id) {
        $this->data['id'] = $id;
        $this->data['hoc_ky_nam_hoc'] = hoc_ky_nam_hoc::
            join('nam_hoc','nam_hoc.id','=','hoc_ky_nam_hoc.nam_hoc_id')
            ->join('lop_mon_hoc', 'lop_mon_hoc.hoc_ky_nam_hoc_id', '=', 'hoc_ky_nam_hoc.id')
            ->select(DB::raw('concat(hoc_ky_nam_hoc.name," ",nam_hoc.nam_bat_dau," - ",nam_hoc.nam_ket_thuc)'))
            ->get();

        $this->data['lop_mon_hoc'] = lop_mon_hoc::
            select('lop_mon_hoc.name','lop_mon_hoc.id_name','lop_mon_hoc.so_thu_tu',
            DB::raw('concat(hoc_ky_nam_hoc.name," ",nam_hoc.nam_bat_dau," - ",nam_hoc.nam_ket_thuc) as hoc_ky_nam_hoc'))
            ->join('hoc_ky_nam_hoc', 'lop_mon_hoc.hoc_ky_nam_hoc_id','=','hoc_ky_nam_hoc.id')
            ->join('nam_hoc','nam_hoc.id','=','hoc_ky_nam_hoc.nam_hoc_id')
            ->where('lop_mon_hoc.id',$id)->get()[0];

        if (bang_diem_file::where('lop_mon_hoc_id',$id)->exists()) {
            $this->data['file'] = bang_diem_file::select('file')->where('lop_mon_hoc_id',$id)->get()[0];
        } else {
            $this->data['file'] = null;
        }
        return view('lop_mon_hoc.show')->with('data',$this->data);
    }

    function edit(Request $request, $id) {
        echo $request;
    }

    function addLHMDiem(Request $request, $id) {
        $location = "lopmonhoc/".$id;
        $rules = array(
            'LMHDiem' => 'required|max:10000000000|mimes:pdf',
        );
        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            if ($request->hasFile('LMHDiem')) {
                $file_name = time() . '_' . $request->file('LMHDiem')->getClientOriginalName();
                $request->file('LMHDiem')->move('upload/LMHDiem', $file_name);
                if (!bang_diem_file::where('lop_mon_hoc_id',$id)->exists()) {
                    $bang_diem_file = new bang_diem_file();
                    $bang_diem_file->lop_mon_hoc_id = $id;
                    $bang_diem_file->file = $file_name;

                    if ($bang_diem_file->save()) {
                    $this->alert($location,"Thêm bảng điểm thành công");
                    } else {
                    $this->alert($location,"Có lỗi xảy ra");
                    }
                } else {
                    bang_diem_file::where('lop_mon_hoc_id',$id)->update(['link'=>$file_name]);
                $this->alert($location,"Cập nhật bảng điểm");
                }
            } else {
            $this->alert($location,"Bạn chưa chọn file!");
            }
        }
        else {
            $this->alert($location,"Bạn chưa chọn file hoặc file sai định dạng!");
        }
    }

    function addLHMFile(Request $request)
    {
        $location = "lopmonhoc";
        if ($request->hasFile('LMHFile')) {
            $file_name = time() . '_' . $request->file('LMHFile')->getClientOriginalName();
            $request->file('LMHFile')->move('upload/LMHFile', $file_name);

            $lop_mon_hoc_file = new lop_mon_hoc_file();
            $lop_mon_hoc_file->hoc_ky_nam_hoc_id = $request->hoc_ky_nam_hoc_id;
            $lop_mon_hoc_file->file = $file_name;

            if ($lop_mon_hoc_file->save()) {
                $data = Excel::load('upload/LMHFile' . "/" . $file_name)->get();
                $ma_mon_hoc_count = 0;
                $so_thu_tu_count = 0;
                $name_count = 0;
                foreach ($data[0]->keys() as $key) {
                    if ($key != null) {
                        if ($key == "ma_mon_hoc")
                            $ma_mon_hoc_count++;
                        if ($key == "so_thu_tu")
                            $so_thu_tu_count++;
                        if ($key == "name")
                            $name_count++;
                    }
                }
//                echo $ma_mon_hoc_count.' '.$so_thu_tu_count.' '.$name_count;
//                echo $data[0]["ma_mon_hoc"];
                if ($ma_mon_hoc_count == 1 and $so_thu_tu_count==1 and $name_count==1) {
                    foreach ($data as $row) {
                        if ($row->ma_mon_hoc!=null and $row->name and $row->so_thu_tu) {
                            echo $row["ma_mon_hoc"].' '.$lop_mon_hoc_file->hoc_ky_nam_hoc_id.' '.$row["so_thu_tu"];
                            if (!lop_mon_hoc::where('id_name',$row["ma_mon_hoc"])
                                ->where('hoc_ky_nam_hoc_id',$lop_mon_hoc_file->hoc_ky_nam_hoc_id)
                                ->where('so_thu_tu',$row["so_thu_tu"])
                                ->exists()) {
                                echo $row["ma_mon_hoc"].' '.$lop_mon_hoc_file->hoc_ky_nam_hoc_id.' '.$row["so_thu_tu"];
                                $lop_mon_hoc = new lop_mon_hoc();
                                $lop_mon_hoc->id_name = $row["ma_mon_hoc"];
                                $lop_mon_hoc->name = $row["name"];
                                $lop_mon_hoc->hoc_ky_nam_hoc_id = $lop_mon_hoc_file->hoc_ky_nam_hoc_id;
                                $lop_mon_hoc->so_thu_tu = $row["so_thu_tu"];
                                $lop_mon_hoc->save();
                            }
                        }
                    }
                    $this->alert($location,"Thêm lớp môn học thành công");
                } else {
                    $this->alert($location,"File sai định dạng");
                }
            } else {
                $this->alert($location,"Có lỗi xảy ra");
            }
        } else {
            $this->alert($location,"Bạn chưa chọn file!");
        }
    }

    function alert($location, $message) {
        echo '<script language="javascript">';
        echo 'window.location="/'.$location.'";';
        echo 'alert("'.$message.'");';
        echo '</script>';
    }

    function destroyByHocKy($hoc_ky) {
        foreach (lop_mon_hoc::select('id')->where('hoc_ky_nam_hoc_id',$hoc_ky) as $lop_mon_hoc) {
            $this->destroy($lop_mon_hoc['id']);
        }
    }

    function destroy($id) {
        bang_diem_file::where('lop_mon_hoc_id', $id)->delete();
        lop_mon_hoc::where('hoc_ky_nam_hoc_id',$id)->delete();
    }
}
