@extends('trainer.layout')
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
    <div class="container emp-profile">
        @foreach($trainees as $trainee)
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        <img src="{{asset($trainee->photo)}}" alt=""/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-head">
                        <h5>
                            {{ $trainee->first_name.' '.$trainee->last_name }}
                        </h5>
                        <h6>
                            {{ $trainee->position }}
                        </h6>
                        <p class="proile-rating">Date : <span>{{ $trainee->created_at }}</span></p>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">More</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="/user">
                        <button class="btn btn-info">Back</button>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="profile-work">
                        <p>EDUCATIONS</p>
                        @foreach($educations as $education)
                            <div class="row">
                                <div class="col-sm-4">
                                    <a href="">{{ $education->date }}</a>
                                </div>
                                <div class="col-sm-8">
                                    <a href="">:{{ $education->description }}</a>
                                </div>
                            </div>
                        @endforeach
                        <p>WORK EXPERIENCE</p>
                        @foreach($works as $work)
                            <div class="row">
                                <div class="col-sm-4">
                                    <a href="">{{ $work->date }}</a>
                                </div>
                                <div class="col-sm-8">
                                    <a href="">:{{ $work->description }}</a>
                                </div>
                            </div>
                        @endforeach
                        <p>SKILLS and RATE:</p>
                        @foreach($skills as $skill)
                           <div class="row">
                               <div class="col-sm-4">
                                   <a href="">{{ $skill->skill }}</a>
                               </div>
                               <div class="col-sm-8">
                                   <a href="">:{{ $skill->rate }}</a>
                               </div>
                           </div>
                        @endforeach
                        <p>LANGUAGE</p>
                        @foreach($languages as $language)
                            <div class="row">
                                <div class="col-sm-4">
                                    <a href="">{{ $language->language }}</a>
                                </div>
                                <div class="col-sm-8">
                                    <a href="">:{{ $language->description }}</a>
                                </div>
                            </div>
                        @endforeach
                        <p>REFERENCE</p>
                        <div class="row">
                            <div class="col-sm-4">
                                <a href="">Name:</a>
                            </div>
                            <div class="col-sm-8">
                                <a href="">:{{ $trainee->reference_name }}</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <a href="">Position:</a>
                            </div>
                            <div class="col-sm-8">
                                <a href="">:{{ $trainee->reference_position }}</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <a href="">Phone:</a>
                            </div>
                            <div class="col-sm-8">
                                <a href="">:{{ $trainee->reference_phone }}</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <a href="">Email:</a>
                            </div>
                            <div class="col-sm-8">
                                <a href="">:{{ $trainee->reference_email }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="tab-content profile-tab" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>User Id</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $trainee->user_id }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>First name</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $trainee->first_name }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Last name</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $trainee->last_name }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Sex</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $trainee->sex }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $trainee->email }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Phone</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $trainee->phone }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Position</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $trainee->position }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Type</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $trainee->type }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Internship status</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $trainee->internship_status }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Start Date</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $trainee->start_date }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>End Date</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $trainee->end_date }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Address</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $trainee->address }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Martial status</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $trainee->martial_status }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Height</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $trainee->height }} m</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Nationality</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $trainee->nationality }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Date of birth</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $trainee->dob }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Hobbies</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $trainee->hobbies }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Place of birth</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $trainee->place_of_birth }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('javascript')
    <script>

    </script>
@endsection



