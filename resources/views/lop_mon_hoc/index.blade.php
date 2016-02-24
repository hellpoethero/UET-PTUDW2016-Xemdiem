@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/lopmonhoc/') }}">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <div class="col-md-4">
                            <select class="form-control" name="hoc_ky_nam_hoc_id" required>
                                <option value="">Chọn học kỳ</option>
                                @foreach($data['hoc_ky_nam_hoc'] as $hoc_ky_nam_hoc)
                                    <option value="{{$hoc_ky_nam_hoc['id']}}">
                                        {{$hoc_ky_nam_hoc['name']}} {{$hoc_ky_nam_hoc['nam_bat_dau']}} - {{$hoc_ky_nam_hoc['nam_ket_thuc']}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control" name="mon_hoc_id" required>
                                <option value="">Chọn môn học</option>
                                @foreach($data['mon_hoc'] as $mon_hoc)
                                    <option value="{{$mon_hoc['id']}}">{{$mon_hoc['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-plus"></i>Thêm lớp
                            </button>
                        </div>
                    </div>
                </form>

                <div style="text-align: center;font-size: 125%">
                    <label>Danh sách lớp môn học</label>
                </div>
                <div class="panel table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr style="background-color: #337ab7;color: white; font-size: 125%;">
                            <th class="col-md-2" style="text-align: center;">#</th>
                            <th class="col-md-3" style="text-align: center;">Lớp môn học</th>
                            <th class="col-md-6" style="text-align: center;">Tên môn học</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr id="search">
                            <td>
                                <select class="col-md-12 form-control" style="text-align: center;">
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="75">75</option>
                                    <option value="100">100</option>
                                </select>
                            </td>
                            <td><input class="col-md-12 form-control" type="text"></td>
                            <td><input class="col-md-12 form-control" type="text"></td>
                        </tr>
                        <?php $count=1; ?>
                        @foreach($data['lop_mon_hoc'] as $lop_mon_hoc)
                            <tr class="yearRow">
                                <td style="text-align: center">{{$count}}</td>
                                <td>{{$lop_mon_hoc['id_name']}} {{$lop_mon_hoc['so_thu_tu']}}</td>
                                <td>{{$lop_mon_hoc['name']}}</td>
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
@endsection

