@extends('layouts.app')

@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html">
        <div class="row">
            <div class="col-md-6 col-md-offset-0">
                <form class="form-horizontal" role="form" method="POST" action="/lopmonhoc/{{$data['id']}}/upload" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="col-md-8 col-md-offset-0">
                        <input class="form-control" id="uploadFile" placeholder="Chọn bảng điểm" disabled="disabled"/>
                    </div>
                    <label class="btn btn-default">
                        <i class="fa fa-folder-open"></i>
                        <input name="LMHDiem" id="uploadBtn" type="file" style="display: none" required/>
                    </label>
                    <button id="submit" type="submit" class="btn btn-primary col-md-offset-1" >
                        <i class="fa fa-upload"></i> Upload
                    </button>
                </form>
                <br>
                <form class="form-horizontal" role="form" id="editForm" method="post" action="/lopmonhoc/{{$data['id']}}">
                    {!! csrf_field() !!}
                    <label style="font-size: 125%">Môn học</label>
                    <input id="name" name="name" disabled type="text" class="form-control" value="{{$data['lop_mon_hoc']['name']}}" required>
                    </br>
                    <label style="font-size: 125%">Mã môn học</label>
                    <input id="id_name" name="id_name" disabled type="text" class="form-control" value="{{$data['lop_mon_hoc']['id_name']}}" required>
                    </br>
                    <label style="font-size: 125%">Số thứ tự</label>
                    <input id="so_thu_tu" name="so_thu_tu" disabled type="text" class="form-control" value="{{$data['lop_mon_hoc']['so_thu_tu']}}" required>
                    <label style="font-size: 125%">Số thứ tự</label>
                    <input disabled type="text" class="form-control" value="{{$data['lop_mon_hoc']['hoc_ky_nam_hoc']}}">
                    </br>
                    <button type="button" class="btn btn-warning col-md-offset-0 col-md-3" id="editButton" onclick="changeButton()" value="edit"><i class="fa fa-pencil"></i> Sửa</button>
                    <button type="submit" class="btn btn-success col-md-offset-6 col-md-3" style="display: none" id="submitButton"><i class="fa fa-check"></i> Xác nhận</button>
                </form>
                </div>
            <div class="col-md-6">
                @if ($data['file'] != null)
                    <div style="text-align: center;">
                        <label style="font-size: 24px;">Bảng điểm</label>
                    </div>

                    <embed src="{{asset('upload/LMHDiem/'.$data['file']['file'])}}" style="width: 100%; height: 100%;min-height: 512px"></embed>
                @else
                    <div style="text-align: center;">
                        <label style="font-size: 24px;">Chưa có bảng điểm!</label>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{asset('js/myJS.js')}}"></script>
    <script>
        function changeButton() {
            var editButton = document.getElementById("editButton");
            var submitButton = document.getElementById("submitButton");
            var name = document.getElementById("name");
            var id_name = document.getElementById("id_name");
            var so_thu_tu = document.getElementById("so_thu_tu");
            if (editButton.value == "edit") {
                editButton.value = "cancel";
                editButton.innerHTML = "<i class='fa fa-ban'></i> Hủy";
                editButton.className = "btn btn-default col-md-offset-0 col-md-3";
                submitButton.style.display = "";
                name.disabled = false;
                id_name.disabled = false;
                so_thu_tu.disabled = false;
            } else {
                editButton.value = "edit";
                editButton.innerHTML = "<i class='fa fa-pencil'></i> Sửa";
                editButton.className = "btn btn-warning col-md-offset-0 col-md-3";
                submitButton.style.display = "none";
                name.disabled = true;
                id_name.disabled = true;
                so_thu_tu.disabled = true;
            }
        }
    </script>
@endsection