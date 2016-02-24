@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form class="form-horizontal" role="form" id="form" method="POST" action="{{url('/namhoc')}}">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-4">
                            <input type="number" class="form-control" name="nam_bat_dau" placeholder="Năm bắt đầu" required>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-plus"></i>Thêm năm học
                            </button>
                        </div>
                    </div>
                </form>

                <div style="text-align: center;font-size: 125%"><label>Danh sách năm học</label></div>

                <div class="panel table-responsive">
                    <table class="table table-hover" style="text-align: center">
                        <thead>
                        <tr style="background-color: #337ab7;color: white; font-size: 125%;">
                            <th class="col-md-2" style="text-align: center;">#</th>
                            <th class="col-md-6" style="text-align: center;">Năm học</th>
                            <th class="col-md-2" style="text-align: center;"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $count=1; ?>
                        @foreach($data as $nam_hoc)
                            <tr class="yearRow">
                                <td>{{$count}}</td>
                                <td>
                                    {{$nam_hoc['nam_bat_dau']}} - {{$nam_hoc['nam_ket_thuc']}}
                                </td>
                                <td>
                                    <div class="deleteButton">
                                        <form action="/namhoc/{{$nam_hoc['nam_bat_dau']}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button><i class="fa fa-trash"></i></button>
                                        </form>
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

    <style>
        .yearRow .deleteButton {
            display: none;
        }
        .yearRow:hover .deleteButton {
            display: block;
        }
    </style>

    {{--<script>--}}

        {{--$('#form').submit(function(e) {--}}
            {{--var $data = $(this).serialize();--}}
            {{--alert($(this));--}}
            {{--$.post("{{ url('/namhoc/create')}}",$data,function(msg) {--}}
                {{--alert('Thành công');--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}
@endsection

