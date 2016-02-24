@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                @if(Auth::user())
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/diem') }}" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <div class="col-md-7">
                                <div class="col-md-4">
                                    <select class="form-control" name="hoc_ky_nam_hoc" required>
                                        <option value="">Chọn học kỳ</option>
                                        @foreach($data['hoc_ky_nam_hoc'] as $hoc_ky_nam_hoc)
                                            <option value={{$hoc_ky_nam_hoc['id']}}>
                                                {{$hoc_ky_nam_hoc['name']}} {{$hoc_ky_nam_hoc['nam_bat_dau']}} - {{$hoc_ky_nam_hoc['nam_ket_thuc']}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" name="lop_mon_hoc" required>
                                        <option value="">Chọn lớp môn học</option>
                                        @foreach($data['lop_mon_hoc'] as $lop_mon_hoc)
                                            <option value="{{$lop_mon_hoc['id']}}">
                                                {{$lop_mon_hoc['name']}} -  {{$lop_mon_hoc['id_name']}}  {{$lop_mon_hoc['so_thu_tu']}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="col-md-7">
                                    <input class="form-control" id="uploadFile" placeholder="Chọn bảng điểm" disabled="disabled"/>
                                </div>
                                <label class="btn btn-default col-md-0">
                                        <i class="fa fa-folder-open"></i>
                                        <input name="bangdiem" id="uploadBtn" type="file" style="display: none" required/>
                                </label>
                                <button id="submit" type="submit" class="btn btn-primary col-md-offset-1">
                                    <i class="fa fa-upload"></i> Upload
                                </button>
                            </div>
                        </div>
                    </form>
                @else
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <div class="col-md-7">
                                <div class="col-md-4">
                                    <select class="form-control" name="hoc_ky_nam_hoc" required>
                                        <option value="">Chọn học kỳ</option>
                                        @foreach($data['hoc_ky_nam_hoc'] as $hoc_ky_nam_hoc)
                                            <option value={{$hoc_ky_nam_hoc['id']}}>
                                                {{$hoc_ky_nam_hoc['name']}} {{$hoc_ky_nam_hoc['nam_bat_dau']}} - {{$hoc_ky_nam_hoc['nam_ket_thuc']}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                @endif

                <div style="text-align: center;font-size: 125%">
                    <label>Danh sách điểm</label>
                </div>
                <div class="panel table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr style="background-color: #337ab7;color: white; font-size: 125%;">
                            <th class="col-md-1" style="text-align: center;">#</th>
                            <th class="col-md-2" style="text-align: center;">Mã sinh viên</th>
                            <th class="col-md-3" style="text-align: center;">Họ tên</th>
                            <th class="col-md-4" style="text-align: center;">Tên môn học</th>
                            <th class="col-md-2" style="text-align: center;">Lớp môn học</th>
                            <th class="col-md-1" style="text-align: center;">Điểm</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr id="search">
                            <td><select class="form-control" style="text-align: center;">
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="75">75</option>
                                    <option value="100">100</option>
                                </select>
                            </td>
                            <td><input class="form-control" type="text"></td>
                            <td><input class="form-control" type="text"></td>
                            <td><input class="form-control" type="text"></td>
                            <td><input class="form-control" type="text"></td>
                            <td></td>
                        </tr>
                        <?php $count=1; ?>
                        @foreach($data['diem'] as $diem)
                            <tr class="yearRow">
                                <td style="text-align: center">{{$count}}</td>
                                <td>{{$diem['ma_sinh_vien']}}</td>
                                <td>{{$diem['hoten']}}</td>
                                <td>{{$diem['name']}}</td>
                                <td>{{$diem['id_name']}} {{$diem['so_thu_tu']}}</td>
                                <td>{{$diem['diem']}}</td>
                                {{--<td>--}}
                                {{--<div class="deleteButton">--}}
                                {{--<form action="/monhoc/{{$nam_hoc['nam_bat_dau']}}" method="POST">--}}
                                {{--{{ csrf_field() }}--}}
                                {{--{{ method_field('DELETE') }}--}}
                                {{--<button class="fa">Xóa</button>--}}
                                {{--</form>--}}
                                {{--</div>--}}
                                {{--</td>--}}
                            </tr>
                            <?php $count++; ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        .yearRow .deleteButton {
            display: none;
        }
        .yearRow:hover .deleteButton {
            display: block;
        }
    </style>

    <script>
        document.getElementById("submit").onclick = function() {
            if (document.getElementById("uploadBtn").value == "") {
                alert('Vui lòng chọn bảng điểm để upload');
            }
        }
        document.getElementById("uploadBtn").onchange = function () {
            document.getElementById("uploadFile").value = this.value;
        };
    </script>
@endsection

