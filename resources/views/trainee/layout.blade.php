<!doctype html>
<html lang="en">
<head>
    <title>Internship Management System</title>
    <link rel="icon" href="{{ asset('img/system_icon.png') }}"/>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/admin_layout_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cropper.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.dataTables.css') }}">
    @yield('stylesheet')
    <link rel="stylesheet" href="{{asset('css/trainee_layout.css')}}">
</head>
<body>


<div class="container">
    <div class="view-account">
        <section class="module">
            <div class="module-inner">
                <div class="side-bar">
                    <div class="user-info">
                        <img class="img-profile img-circle img-responsive center-block" src="{{ asset(Auth::user()->photo) }}" alt="">
                        <ul class="meta list list-unstyled">
                            <li class="name">{{ Auth::user()->first_name.' '.Auth::user()->last_name }}
                                <label class="label label-info">{{ Auth::user()->type }}</label>
                            </li>
                        </ul>
                    </div>
                    <nav class="side-menu">
                        <ul class="nav">
                            <li class="active"><a href="#"><span class="fa fa-user"></span> Profile</a></li>
                            <li><a href="#"><span class="fa fa-cog"></span> Settings</a></li>
                            <li><a href="#"><span class="fa fa-credit-card"></span> Billing</a></li>
                            <li><a href="#"><span class="fa fa-envelope"></span> Messages</a></li>

                            <li><a href="user-drive.html"><span class="fa fa-th"></span> Drive</a></li>
                            <li><a href="#"><span class="fa fa-clock-o"></span> Reminders</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="content-panel">
                    <h2 class="title">Profile<span class="pro-label label label-warning">PRO</span></h2>
                    @yield('content')
                </div>
            </div>
        </section>
    </div>
</div>

<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://kit.fontawesome.com/8d4428d323.js"></script>
<script src="{{ asset('js/cropper.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('js/jquery.dataTables.js') }}"></script>
<script type="text/javascript"></script>
</body>
</html>
