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
    <style>
        body {
            height: 100vh;
            background:linear-gradient(-120deg, #ba5112, #ffcd00, #c9c9c9);
        }

        #text_logo {
            font-family: "Times New Roman", Times, serif;
            font-size: 30px;
            font-weight: bold;
        }

    </style>
    @yield('stylesheet')
</head>
<body>
    <div class="row align-items-center h-100">
        <div class="col">
            @yield('content')
        </div>
    </div>


<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="https://kit.fontawesome.com/8d4428d323.js"></script>
@yield('javascript')
</body>
</html>
