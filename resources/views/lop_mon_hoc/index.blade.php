@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @if(Auth::user())
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/lopmonhoc/') }}" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <div class="col-md-3">
                            <select class="col-md-12 form-control" name="hoc_ky_nam_hoc_id" required>
                                <option value="">Chọn học kỳ</option>
                                @foreach($data['hoc_ky_nam_hoc'] as $hoc_ky_nam_hoc)
                                <option value="{{$hoc_ky_nam_hoc['id']}}">
                                    {{$hoc_ky_nam_hoc['name']}} {{$hoc_ky_nam_hoc['nam_bat_dau']}} -
                                    {{$hoc_ky_nam_hoc['nam_ket_thuc']}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-8 col-md-offset-0">
                                <input class="form-control" id="uploadFile" placeholder="Chọn danh sách lớp môn học" disabled="disabled"/>
                            </div>
                            <label class="btn btn-default">
                                <i class="fa fa-folder-open"></i>
                                <input name="LMHFile" id="uploadBtn" type="file" style="display: none" required/>
                            </label>
                            <button id="submit" type="submit" class="btn btn-primary col-md-offset-1">
                                <i class="fa fa-upload"></i> Upload
                            </button>
                        </div>
                    </div>
                </form>
                @endif

                <div style="text-align: center;font-size: 125%">
                    <label>Danh sách lớp môn học</label>
                </div>
                <div class="panel table-responsive">
                    <table id="LMHTableHeader" class="table table-hover">
                        <thead>
                        <tr style="background-color: #337ab7;color: white; font-size: 125%;">
                            <th class="col-md-1" style="text-align: center;">#</th>
                            <th class="col-md-2" style="text-align: center;">Lớp môn học</th>
                            <th class="col-md-6" style="text-align: center;">Tên môn học</th>
                        </tr>
                        <tr id="search">
                            <td>
                            </td>
                            <td>
                                <input id="id_name_filter" class="col-md-12 form-control" type="text" oninput="filterInput()">
                            </td>
                            <td>
                                <div class="col-md-7">
                                    <input id="name_filter" class="form-control" type="text" oninput="filterInput()">
                                </div>
                                <div class="col-md-5">
                                    <select class="form-control" id="hoc_ky_nam_hoc_filer" onchange="filterHocKy()" required>
                                        <option value="">Chọn học kỳ</option>
                                        @foreach($data['hoc_ky_nam_hoc'] as $hoc_ky_nam_hoc)
                                            <option value="{{$hoc_ky_nam_hoc['id']}}">
                                                {{$hoc_ky_nam_hoc['name']}} {{$hoc_ky_nam_hoc['nam_bat_dau']}} -
                                                {{$hoc_ky_nam_hoc['nam_ket_thuc']}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                        </tr>
                        </thead>
                        <tbody id="LMHTableContent">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function filterHocKy() {
            var hoc_ky_nam_hoc_filer = document.getElementById("hoc_ky_nam_hoc_filer");
            var url = 'http://localhost:8000/get'+
                    '?data=lop_mon_hoc'+
                    '&hoc_ky_nam_hoc='+hoc_ky_nam_hoc_filer.value;
            $.getJSON(url, function(data) {
                var LMHTableContent = document.getElementById('LMHTableContent');
                LMHTableContent.innerHTML = "";
                var count=0;
                $.each(data, function() {
                    updateTable(LMHTableContent,data,count);
                    count++;
                });
            });
        }

        function filterInput() {
            var id_name_filter = document.getElementById("id_name_filter").value;
            var name_filter = document.getElementById("name_filter").value;
            var LMHTableContent = document.getElementById('LMHTableContent');
            for (var i=0; LMHTableContent.rows[i] != null; i++) {
                var id_name_row = LMHTableContent.rows[i].childNodes[1].textContent;
                var name_row = LMHTableContent.rows[i].childNodes[2].firstElementChild.innerText;
                if (id_name_filter!="") {
                    id_name_filter = id_name_filter.toLowerCase();
                }
                if (name_filter!="") {
                    name_filter = name_filter.toLowerCase();
                }
                if (id_name_row.toLowerCase().indexOf(id_name_filter)>-1 &&
                        name_row.toLowerCase().indexOf(name_filter)>-1) {
                    LMHTableContent.rows[i].style.display = "";
                } else {
                    LMHTableContent.rows[i].style.display = "none";
                }
            }
        }

        function updateTable(LMHTableContent,data, count) {
            var row = LMHTableContent.insertRow(count);
            var stt = row.insertCell(0);
            var lmh_ID = row.insertCell(1);
            var lmh_name = row.insertCell(2);

            row.className = "yearRow";
            var link ="";
            if (data[count]['file'] != null) {
                var fileURL = 'upload/LMHDiem/' + data[count]['file'];
                link = '<a href="'+fileURL+'" target="_blank">';
            }
            stt.innerHTML = count+1;
            stt.style.textAlign = "center";

            lmh_ID.innerHTML = data[count]['id_name']+' '+data[count]['so_thu_tu'];

            var namediv = document.createElement('div');
            namediv.innerHTML = link+data[count]['name'];
            namediv.className = "col-md-10";
            lmh_name.appendChild(namediv);

            @if(Auth::user())
            var editdiv = document.createElement('div');
            editdiv.className = 'col-md-1 deleteButton';
            var editlink = document.createElement('a');
            editdiv.appendChild(editlink);
            editlink.href = "/lopmonhoc/"+data[count]['id'];
            editlink.innerHTML = "<button class = 'btn btn-info'><i class='fa fa-pencil'></i> Sửa</button>";
            lmh_name.appendChild(editdiv);
            @endif
        }
    </script>

    @if(Auth::user())
    <script type="text/javascript" src="{{asset('js/myJS.js')}}"></script>
    @endif
@endsection

