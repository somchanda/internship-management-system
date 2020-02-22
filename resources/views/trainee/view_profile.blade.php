@extends('trainee.layout')
@section('stylesheet')
    <style>
        body{
            background: -webkit-linear-gradient(left, #3931af, #00c6ff);
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
@endsection
@section('content')
    <br>
    <br>
    <div class="container emp-profile">
            <div class="row">
                <div class="col-md-3">
                    <div class="profile-img">
                        <img src="{{asset(Auth::user()->photo)}}" alt=""/>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="profile-head">
                        <h5>
                            {{ Auth::user()->first_name.' '.Auth::user()->last_name }}
                        </h5>
                        <h6>
                            {{ Auth::user()->type }}
                        </h6>
                        <h6>{{ Auth::user()->email }}</h6>
                        <br>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Information</a>
                            </li>
                            @if(count($skills) != 0)
                                <li class="nav-item">
                                    <a class="nav-link" id="skill-tab" data-toggle="tab" href="#skill" role="tab" aria-controls="skill" aria-selected="true">Skill</a>
                                </li>
                            @endif
                            @if(count($exps) != 0)
                                <li class="nav-item">
                                    <a class="nav-link" id="skill-tab" data-toggle="tab" href="#exp" role="tab" aria-controls="exp" aria-selected="true">Work Experience</a>
                                </li>
                            @endif
                            @if(count($edus) != 0)
                                <li class="nav-item">
                                    <a class="nav-link" id="edu-tab" data-toggle="tab" href="#edu" role="tab" aria-controls="edu" aria-selected="true">Education</a>
                                </li>
                            @endif
                            @if(count($trainees) != 0)
                                <li class="nav-item">
                                    <a class="nav-link" id="reference-tab" data-toggle="tab" href="#reference" role="tab" aria-controls="reference" aria-selected="true">Reference</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="/trainee/dashboard">
                        <button class="btn btn-info">Back</button>
                    </a>
                </div>
            </div>
    <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-7">
            <div class="tab-content profile-tab" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <label>User Id</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{ Auth::user()->id }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>First name</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{ Auth::user()->first_name }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Last name</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{ Auth::user()->last_name }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Sex</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{ Auth::user()->sex }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Email</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Phone</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{ Auth::user()->phone }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Type</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{ Auth::user()->type }}</p>
                        </div>
                    </div>
                    @if(count($trainees) != 0)
                        <div class="row">
                            <div class="col-md-6">
                                <label>Internship status</label>
                            </div>
                            <div class="col-md-6">
                                <p> {{ $trainees[0]->internship_status }} </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Position</label>
                            </div>
                            <div class="col-md-6">
                                <p> {{ $trainees[0]->position }} </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Start Date</label>
                            </div>
                            <div class="col-md-6">
                                <p> {{ date('d/M/Y', strtotime($trainees[0]->start_date)) }} </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>End Date</label>
                            </div>
                            <div class="col-md-6">
                                <p> {{ date('d/M/Y', strtotime($trainees[0]->end_date)) }} </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Address</label>
                            </div>
                            <div class="col-md-6">
                                <p> {{ $trainees[0]->address }} </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Martial Status</label>
                            </div>
                            <div class="col-md-6">
                                <p> {{ $trainees[0]->martial_status }} </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Height</label>
                            </div>
                            <div class="col-md-6">
                                <p> {{ $trainees[0]->height. __(' m')}} </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Nationality</label>
                            </div>
                            <div class="col-md-6">
                                <p> {{ $trainees[0]->nationality }} </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Date of birth</label>
                            </div>
                            <div class="col-md-6">
                                <p> {{ date('d/M/Y', strtotime($trainees[0]->dob)) }} </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Place of birth</label>
                            </div>
                            <div class="col-md-6">
                                <p> {{ $trainees[0]->place_of_birth }} </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Hobbies</label>
                            </div>
                            <div class="col-md-6">
                                <p> {{ $trainees[0]->hobbies }} </p>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="tab-pane fade" id="reference" role="tabpanel" aria-labelledby="reference-tab">
                    @if(count($trainees) != 0)
                        <h4>REFERENCE</h4>
                        <div class="row">
                            <div class="col-md-6 pl-5">
                                <label>{{ __('Name:') }}</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $trainees[0]->reference_name }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pl-5">
                                <label>{{ __('Position:') }}</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $trainees[0]->reference_position }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pl-5">
                                <label>{{ __('Phone:') }}</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $trainees[0]->reference_phone }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pl-5">
                                <label>{{ __('Email:') }}</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $trainees[0]->reference_email }}</p>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="tab-pane fade" id="skill" role="tabpanel" aria-labelledby="skill-tab">
                    @if(count($skills) != 0)
                        <h4>SKILLS</h4>
                        @foreach($skills as $skill)
                            <div class="row">
                                <div class="col-md-6 pl-5">
                                    <label>{{ $skill->skill }}</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="10" style="width:{{ $skill->rate }}0%">
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="tab-pane fade" id="exp" role="tabpanel" aria-labelledby="exp-tab">
                    <h4>WORK EXPERIENCE</h4>
                    @foreach($exps as $exp)
                        <div class="row">
                            <div class="col-md-6 pl-5">
                                <label>{{ $exp->date }}</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $exp->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="tab-pane fade" id="edu" role="tabpanel" aria-labelledby="edu-tab">
                    <h4>EDUCATIONS</h4>
                    @foreach($edus as $edu)
                        <div class="row">
                            <div class="col-md-6 pl-5">
                                <label>{{ $edu->date }}</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $edu->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>



{{--            <div class="row">--}}
{{--                <div class="col-md-6">--}}
{{--                    <div class="profile-work">--}}
{{--                        <p>EDUCATIONS</p>--}}
{{--                        @foreach($educations as $education)--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-sm-4">--}}
{{--                                    <a href="">{{ $education->date }}</a>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-8">--}}
{{--                                    <a href="">:{{ $education->description }}</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                        <p>WORK EXPERIENCE</p>--}}
{{--                        @foreach($works as $work)--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-sm-4">--}}
{{--                                    <a href="">{{ $work->date }}</a>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-8">--}}
{{--                                    <a href="">:{{ $work->description }}</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                        <p>SKILLS and RATE:</p>--}}
{{--                        @foreach($skills as $skill)--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-sm-4">--}}
{{--                                    <a href="">{{ $skill->skill }}</a>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-8">--}}
{{--                                    <a href="">:{{ $skill->rate }}</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                        <p>LANGUAGE</p>--}}
{{--                        @foreach($languages as $language)--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-sm-4">--}}
{{--                                    <a href="">{{ $language->language }}</a>--}}
{{--                                </div>--}}
{{--                                <div class="col-sm-8">--}}
{{--                                    <a href="">:{{ $language->description }}</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                        <p>REFERENCE</p>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-sm-4">--}}
{{--                                <a href="">Name:</a>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-8">--}}
{{--                                <a href="">:{{ $trainee->reference_name }}</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-sm-4">--}}
{{--                                <a href="">Position:</a>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-8">--}}
{{--                                <a href="">:{{ $trainee->reference_position }}</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-sm-4">--}}
{{--                                <a href="">Phone:</a>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-8">--}}
{{--                                <a href="">:{{ $trainee->reference_phone }}</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-sm-4">--}}
{{--                                <a href="">Email:</a>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-8">--}}
{{--                                <a href="">:{{ $trainee->reference_email }}</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-6">--}}
{{--                    <div class="tab-content profile-tab" id="myTabContent">--}}
{{--                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <label>User Id</label>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <p>{{ $trainee->user_id }}</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <label>First name</label>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <p>{{ $trainee->first_name }}</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <label>Last name</label>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <p>{{ $trainee->last_name }}</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <label>Sex</label>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <p>{{ $trainee->sex }}</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <label>Email</label>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <p>{{ $trainee->email }}</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <label>Phone</label>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <p>{{ $trainee->phone }}</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <label>Position</label>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <p>{{ $trainee->position }}</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <label>Type</label>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <p>{{ $trainee->type }}</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <label>Internship status</label>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <p>{{ $trainee->internship_status }}</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <label>Start Date</label>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <p>{{ $trainee->start_date }}</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <label>End Date</label>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <p>{{ $trainee->end_date }}</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <label>Address</label>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <p>{{ $trainee->address }}</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <label>Martial status</label>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <p>{{ $trainee->martial_status }}</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <label>Height</label>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <p>{{ $trainee->height }} m</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <label>Nationality</label>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <p>{{ $trainee->nationality }}</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <label>Date of birth</label>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <p>{{ $trainee->dob }}</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <label>Hobbies</label>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <p>{{ $trainee->hobbies }}</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <label>Place of birth</label>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <p>{{ $trainee->place_of_birth }}</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
    </div>
@endsection
@section('script')
    <script>

    </script>
@endsection




