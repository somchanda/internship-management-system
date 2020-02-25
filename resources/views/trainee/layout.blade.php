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
        <style>
            #img_profile {
                width: 40px;
                margin: auto;
                cursor: pointer;
            }
            .emp-profile{
                padding: 3%;
                margin-top: 3%;
                margin-bottom: 3%;
                border-radius: 0.5rem;
                background: #fff;
            }
            .profile-img{
                text-align: center;
            }
            .profile-img img{
                width: 70%;
                height: 100%;
            }
            .profile-img .file {
                position: relative;
                overflow: hidden;
                margin-top: -20%;
                width: 70%;
                border: none;
                border-radius: 0;
                font-size: 15px;
                background: #212529b8;
            }
            .profile-img .file input {
                position: absolute;
                opacity: 0;
                right: 0;
                top: 0;
            }
            .profile-head h5{
                color: #333;
            }
            .profile-head h6{
                color: #0062cc;
            }
            .profile-edit-btn{
                border: none;
                border-radius: 1.5rem;
                width: 70%;
                padding: 2%;
                font-weight: 600;
                color: #6c757d;
                cursor: pointer;
            }
            .proile-rating{
                font-size: 12px;
                color: #818182;
                margin-top: 5%;
            }
            .proile-rating span{
                color: #495057;
                font-size: 15px;
                font-weight: 600;
            }
            .profile-head .nav-tabs{
                margin-bottom:5%;
            }
            .profile-head .nav-tabs .nav-link{
                font-weight:600;
                border: none;
            }
            .profile-head .nav-tabs .nav-link.active{
                border: none;
                border-bottom:2px solid #0062cc;
            }
            .profile-work{
                padding: 14%;
                margin-top: -15%;
            }
            .profile-work p{
                font-size: 12px;
                color: #818182;
                font-weight: 600;
                margin-top: 10%;
            }
            .profile-work a{
                text-decoration: none;
                color: #495057;
                font-weight: 600;
                font-size: 14px;
            }
            .profile-work ul{
                list-style: none;
            }
            .profile-tab label{
                font-weight: 600;
            }
            .profile-tab p{
                font-weight: 600;
                color: #0062cc;
            }
        </style>
    </head>
    <body>
        <!-- profile image modal -->
        <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Your profile picture</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset(Auth::user()->photo) }}" alt="You profile picture" style="width:100%;max-width: 500px;border-radius: 10px">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
{{--        <a class="navbar-brand" href="/trainee/dashboard">Home</a>--}}
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/trainee/dashboard"><i class="fa fa-user"></i> View Profile <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/trainee/evaluation"><i class="material-icons">format_list_bulleted</i> View Evaluations <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="{{ route('logout') }}" method="post">
                @csrf
                <div class="form-group">
                    <img class="rounded rounded-circle mx-auto d-block" id="img_profile" data-toggle="modal" data-target="#imageModal" src="{{ asset(Auth::user()->photo) }}" alt="profile picture">
                    <button class="btn btn-outline-success my-2 my-sm-0" style="margin-left: 10px" type="submit">Logout</button>
                </div>

            </form>
        </div>
        </nav>
        <main role="main">
            <div class="container">
                <hr>
                @yield('content')
            </div>
        </main>
        <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script src="https://kit.fontawesome.com/8d4428d323.js"></script>
        <script src="{{ asset('js/cropper.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="{{ asset('js/jquery.dataTables.js') }}"></script>
        <script type="text/javascript"></script>
    @yield('script')
    </body>
</html>
