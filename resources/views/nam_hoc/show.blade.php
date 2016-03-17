@extends("layouts.app")

@section("content")
    <div class="container" xmlns="http://www.w3.org/1999/html">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div style="text-align: center;font-size: 125%">
                    <label>
                        Năm học {{$data['nam_hoc']['nam_bat_dau']}} - {{$data['nam_hoc']['nam_ket_thuc']}}
                    </label>
                </div>
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
                                        <form id="deleteHocKy" action="/hocky/{{$hoc_ky_nam_hoc['id']}}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <input hidden name="nam_hoc" value="{{$data['nam_hoc']['nam_bat_dau']}}">
                                            <button type="button" onclick="deleteSubmit(this)"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php $count++; ?>
                        @endforeach
                        <tr>
                            <form id="addHocKy" method="post" action="/hocky">
                                {{csrf_field()}}
                                <td><input hidden name="nam_hoc_id" value={{$data['nam_hoc']['id']}}></td>
                                <td><input class="form-control" type="text" placeholder="Học kỳ" name="name"></td>
                                <td><input class="form-control" type="text" placeholder="Thông tin bổ sung" name="bo_sung"></td>
                            </form>
                            <td><button class="btn btn-primary" onclick="addSubmit()">Thêm</button></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function addSubmit() {
        document.getElementById('addHocKy').submit();
    }
    function deleteSubmit(deleteButton) {
        deleteButton.parentNode.submit();
    }
</script>