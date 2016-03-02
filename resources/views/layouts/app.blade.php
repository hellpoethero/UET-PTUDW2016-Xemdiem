<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{--<title>@yield('title')</title>--}}
    <title>Tra cứu điểm thi Đại học Công nghệ</title>

    <!-- Fonts -->
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href='{{asset('css/font.css')}}' rel='stylesheet' type='text/css'>

    {{--icon--}}
    <link rel="shortcut icon" href="{{ asset('UET.png') }}" >
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    {{--boostrap--}}
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>

    <!-- JavaScripts -->
    <script type="text/javascript" src="{{asset('js/jquery-2.2.0.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.sticky.js')}}"></script>

    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

</head>
<body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header" >

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <img src="{{ asset('UET.png') }}" height="48" style="padding: 8px 8px;">

                <a class="navbar-brand" href="/">
                    Tra cứu điểm Đại học Công nghệ
                </a>

            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                @if(Auth::guest())
                @else
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Trang chủ</a></li>
                    <li><a href="{{ url('/namhoc') }}">Năm học</a></li>
                    <li><a href="{{ url('/lopmonhoc') }}">Lớp môn học</a></li>
                </ul>
                @endif

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        {{--<li><a href="{{ url('/login') }}">Login</a></li>--}}
                        {{--<li><a href="{{ url('/register') }}">Register</a></li>--}}
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/management') }}"><i class="fa fa-btn fa-cog"></i>Quản lý</a></li>
                                <li><a href="{{ url('/user') }}"><i class="fa fa-btn fa-user"></i>Cá nhân</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <style>
        .yearRow .deleteButton {
            display: none;
        }
        .yearRow:hover .deleteButton {
            display: block;
        }
    </style>
    <script>

    </script>
</body>
</html>
