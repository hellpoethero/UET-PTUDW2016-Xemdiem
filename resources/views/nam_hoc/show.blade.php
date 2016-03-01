@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">

                {{--<form class="form-horizontal" role="form" id="form" method="POST" action="{{url('/namhoc')}}">--}}
                    {{--{!! csrf_field() !!}--}}
                    {{--<div class="form-group">--}}
                        {{--<div class="col-md-4 col-md-offset-4">--}}
                            {{--<input type="number" class="form-control" name="nam_bat_dau" placeholder="Năm bắt đầu" required>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-2">--}}
                            {{--<button type="submit" class="btn btn-primary">--}}
                                {{--<i class="fa fa-btn fa-plus"></i>Thêm năm học--}}
                            {{--</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</form>--}}

                <div style="text-align: center;font-size: 125%"><label>Năm học {{$data['nam_hoc']['nam_bat_dau']}} - {{$data['nam_hoc']['nam_ket_thuc']}}</label></div>

                <div class="panel table-responsive">
                    <table class="table table-hover" style="text-align: center">
                        <thead>
                        <tr style="background-color: #337ab7;color: white; font-size: 125%;">
                            <th class="col-md-1" style="text-align: center;">#</th>
                            <th class="col-md-3" style="text-align: center;">Học kỳ</th>
                            <th class="col-md-3" style="text-align: center;">Ghi chú</th>
                            <th class="col-md-1" style="text-align: center;"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $count=1; ?>
                        @foreach($data['hoc_ky_nam_hoc'] as $hoc_ky_nam_hoc)
                            <tr class="yearRow">
                                <td>{{$count}}</td>
                                <td>
                                    {{$hoc_ky_nam_hoc['name']}}
                                </td>
                                <td>
                                    {{$hoc_ky_nam_hoc['bo_sung']}}
                                </td>
                                <td>
                                    <div class="deleteButton">
                                        <form action="/hockynamhoc/{{$hoc_ky_nam_hoc['id']}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        </form>
                                        <button><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php $count++; ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection