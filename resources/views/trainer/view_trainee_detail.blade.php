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
                        {{$trainee->type}}
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
            <div class="col-md-6 offset-4">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
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
                                <label>Phone</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $trainee->phone }}</p>
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
                    </div>


                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Internship Status</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $traineeInfo->internship_status }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Position</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $traineeInfo->position }}</p>
                            </div>
                        </div>

{{--   ------------------   skills ---------------------------------}}

                        <div class="row">
                            <div class="col-5">
                                <hr class="w-100">
                            </div>
                            <div class="col-2">
                                Skills
                            </div>
                            <div class="col-5">
                                <hr class="w-100">
                            </div>
                        </div>

                        @foreach($skills as $skill)
                            <div class="row">
                                <div class="col-md-6">
                                    <label>{{ $skill->skill }}</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: {{ $skill->rate * 10 }}%" aria-valuenow="{{ $skill->rate }}" aria-valuemin="0" aria-valuemax="10"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
{{--           ----------------------------------------             --}
{{--   ------------------   work experience ---------------------------------}}

                        <div class="row">
                            <div class="col-4">
                                <hr class="w-100">
                            </div>
                            <div class="col-4">
                                Work Experiences
                            </div>
                            <div class="col-4">
                                <hr class="w-100">
                            </div>
                        </div>

                        @foreach($workExperiences as $workExperience)
                            <div class="row">
                                <div class="col-md-6">
                                    <label>{{ $workExperience->date }}</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $workExperience->description }}</p>
                                </div>
                            </div>
                        @endforeach
{{--           ----------------------------------------             --}}
{{--   ------------------   educations  ---------------------------------}}

                        <div class="row">
                            <div class="col-5">
                                <hr class="w-100">
                            </div>
                            <div class="col-2">
                                <div>Educations</div>
                            </div>
                            <div class="col-5">
                                <hr class="w-100">
                            </div>
                        </div>

                        @foreach($educations as $education)
                            <div class="row">
                                <div class="col-md-6">
                                    <label>{{ $education->date }}</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $education->description }}</p>
                                </div>
                            </div>
                        @endforeach
{{--           ----------------------------------------             --}}
{{--   ------------------   educations  ---------------------------------}}

                        <div class="row">
                            <div class="col-5">
                                <hr class="w-100">
                            </div>
                            <div class="col-2">
                                <div>Languages</div>
                            </div>
                            <div class="col-5">
                                <hr class="w-100">
                            </div>
                        </div>

                        @foreach($languages as $language)
                            <div class="row">
                                <div class="col-md-6">
                                    <label>{{ $language->language }}</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $language->description }}</p>
                                </div>
                            </div>
                        @endforeach
                        <div class="row">
                            <div class="col-12">
                                <hr class="w-100">
                            </div>
                        </div>
{{--           ----------------------------------------             --}}

                        <div class="row">
                            <div class="col-md-6">
                                <label>Address</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $traineeInfo->address }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Height</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $traineeInfo->height }} m</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Date of birth</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $traineeInfo->dob }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Place of birth</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $traineeInfo->place_of_birth }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Nationality</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $traineeInfo->nationality }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Martial status</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $traineeInfo->martial_status }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Hobbies</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $traineeInfo->hobbies }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <hr class="w-100">
                            </div>
                            <div class="col-2">
                                Reference
                            </div>
                            <div class="col-5">
                                <hr class="w-100">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Name</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $traineeInfo->reference_name }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Position</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $traineeInfo->reference_position }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Phone</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $traineeInfo->reference_phone }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Email</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $traineeInfo->reference_email }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('javascript')
    <script>

    </script>
@endsection



