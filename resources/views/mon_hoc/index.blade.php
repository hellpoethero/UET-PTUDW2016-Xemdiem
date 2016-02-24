@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/monhoc/') }}">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="name" placeholder="Tên môn học" required>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="id_name" placeholder="Mã môn học" required>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-plus"></i>Thêm môn học
                            </button>
                        </div>
                    </div>
                </form>
                <div style="text-align: center;font-size: 125%">
                    <label>Danh sách môn học</label>
                </div>

                <div class="panel table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr style="background-color: #337ab7;color: white; font-size: 125%;">
                            <th class="col-md-2" style="text-align: center;">#</th>
                            <th class="col-md-4" style="text-align: center;">Mã môn học</th>
                            <th class="col-md-6" style="text-align: center;">Môn học</th>
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
                        @foreach($data as $mon_hoc)
                            <tr class="yearRow">
                                <td style="text-align: center">{{$count}}</td>
                                <td>{{$mon_hoc['id_name']}}</td>
                                <td>{{$mon_hoc['name']}}</td>
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

