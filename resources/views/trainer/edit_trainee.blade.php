@extends('trainer.layout')

@section('section_title')
    Edit trainee({{ $trainee->first_name.' '.$trainee->last_name }})'s information
@endsection

@section('content')
    {{--    modal for cropping image--}}
    <div class="modal fade" id="modalCropImage2" tabindex="-1" role="dialog" aria-labelledby="modalLabel2" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel2">Crop the image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <img id="image2" src="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="crop2">Crop</button>
                </div>
            </div>
        </div>
    </div>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Basic Infomation</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="cvInfo-tab" data-toggle="tab" href="#cvInfo" role="tab" aria-controls="cvInfo" aria-selected="false">CV Information</a>
        </li>
    </ul>
    <div class="tab-content mt-2 mb-2" id="myTabContent">
        <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
            <form method="post" action="/user/update_user" class="col-10 offset-1">
                @csrf
                <input type="hidden" name="id" id="id" value="{{ $trainee->id }}">
                <div class="form-group">
                    <label for="fist_name">First name</label>
                    <input type="text" name="first_name" value="{{($trainee->first_name)}}" class="form-control" id="fist_name" placeholder="First name">
                    @if($errors != null)
                        <small class="text-sm-left text-danger">{{ $errors->first('first_name') }}</small>
                    @endif
                </div>
                <div class="form-group">
                    <label for="last_name">Last name</label>
                    <input type="text" name="last_name" value="{{($trainee->last_name)}}" class="form-control" id="last_name" placeholder="Last name">
                    @if($errors != null)
                        <small class="text-sm-left text-danger">{{ $errors->first('last_name') }}</small>
                    @endif
                </div>
                <div class="form-group">
                    <label for="sex">Sex</label>
                    <select  name="sex" class="form-control" id="sex">
                        <option @if($trainee->sex == 'Male') selected @endif value="Male">Male</option>
                        <option @if($trainee->sex == 'Female') selected @endif value="Female">Female</option>
                    </select>
                    @if($errors != null)
                        <small class="text-sm-left text-danger">{{ $errors->first('sex') }}</small>
                    @endif
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" value="{{($trainee->phone)}}" class="form-control" id="phone" placeholder="Phone">
                    @if($errors != null)
                        <small class="text-sm-left text-danger">{{ $errors->first('phone') }}</small>
                    @endif
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" value="{{($trainee->email)}}" class="form-control" id="email" placeholder="Email">
                    @if($errors != null)
                        <small class="text-sm-left text-danger">{{ $errors->first('email') }}</small>
                    @endif
                </div>
                <div class="form-group">
                    <label for="photo">{{ __('Profile Picture') }}</label>

                    <div class="col-md-6">
                        <div class="avatar" id="avatar">
                            <img id="photo2"  src="{{asset('img/man_profile_icon.png')}}" alt="">
                            <div class="avatar1">
                                <p class="text-center text-light">Choose</p>
                                <input type="file" id="photoInput2" name="photo">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="cropedImage2" value=""/>
                </div>
                <input type="submit" name="btn_save" value="Save Change" class="btn btn-info">
            </form>
        </div>

        <div class="tab-pane fade" id="cvInfo" role="tabpanel" aria-labelledby="cvInfo-tab">
            <form method="post" action="/trainee/update_cv_info" class="col-10 offset-1">
                @csrf
                <div class="form-group">
                    <label for="internship_status">Internship status</label>
                    <select name="internship_status" class="form-control" id="internship_status">
                        <option @if($traineeInfo->internship_status == 'Doing Internship') selected @endif value="Interning">Doing Internship</option>
                        <option @if($traineeInfo->internship_status == 'Fail') selected @endif value="Fail">Fail</option>
                        <option @if($traineeInfo->internship_status == 'Stop') selected @endif value="Stop">Stop</option>
                        <option @if($traineeInfo->internship_status == 'Continue') selected @endif value="Continue">Continue</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="position">Position</label>
                    <input type="text" name="position" value="{{$traineeInfo->position}}" class="form-control" id="position" placeholder="position">
                    @if($errors != null)
                        <small class="text-sm-left text-danger">{{ $errors->first('position') }}</small>
                    @endif
                </div>

                <div class="row">
                    <div class="col-5">
                        <hr class="w-100">
                    </div>
                    <div class="col-2 text-center">Skills</div>
                    <div class="col-5">
                        <hr class="w-100">
                    </div>
                </div>
                @if($skills != null)
                    <?php
                        $counter = 1;
                    ?>
                @foreach($skills as $skill)
                    <div class="row mb-1" id="rowSkill{{ $counter }}">
                        <div class="col-8">
                            <input type="text" name="skill{{ $counter }}" value="{{ $skill->skill }}" class="form-control" id="skill{{ $counter }}" placeholder="skill">
                        </div>
                        <div class="col-3">
                            <input type="number" min="1" max="10" name="skill_rate{{ $counter }}" value="{{ $skill->rate }}" class="form-control" id="skill_rate{{ $counter }}" placeholder="rate">
                        </div>
                        <div class="col-1">
                            <div class="btn btn-outline-danger" id="btnRemoveSkill{{ $counter }}">
                                <i class="fas fa-minus-circle"></i>
                            </div>
                        </div>
                    </div>
                    <?php
                        $counter += 1;
                    ?>
                @endforeach
                @endif

                <div class="row mb-2">
                    <div class="col-12">
                        <div class="btn btn-outline-primary w-100 text-center" id="buttonAddSkill">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-5">
                        <hr class="w-100">
                    </div>
                    <div class="col-2 text-center">
                        Work Experiences
                    </div>
                    <div class="col-5">
                        <hr class="w-100">
                    </div>
                </div>
                @if($workExperiences != null)
                    <?php
                    $counter = 1;
                    ?>
                    @foreach($workExperiences as $workExp)
                        <div class="row mb-1" id="rowWorkExperience{{ $counter }}">
                            <div class="col-2">
                                <input type="text" name="work_experience_date{{ $counter }}" value="{{ $workExp->date }}" class="form-control text-center" id="work_experience_date{{ $counter }}" placeholder="Date">
                            </div>
                            <div class="col-9">
                                <input type="text" name="work_experience_description{{ $counter }}" value="{{ $workExp->description }}" class="form-control" id="work_experience_description{{ $counter }}" placeholder="Description">
                            </div>
                            <div class="col-1">
                                <div class="btn btn-outline-danger" id="btnRemoveWorkExperience{{ $counter }}">
                                    <i class="fas fa-minus-circle"></i>
                                </div>
                            </div>
                        </div>
                        <?php
                        $counter += 1;
                        ?>
                    @endforeach
                @endif

                <div class="row mb-2">
                    <div class="col-12">
                        <div class="btn btn-outline-primary w-100 text-center" id="buttonAddWorkExperience">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-5">
                        <hr class="w-100">
                    </div>
                    <div class="col-2 text-center">
                        <div>Educations</div>
                    </div>
                    <div class="col-5">
                        <hr class="w-100">
                    </div>
                </div>

                @if($educations != null)
                    <?php
                    $counter = 1;
                    ?>
                    @foreach($educations as $edu)
                        <div class="row mb-1">
                            <div class="col-2" id="rowEducation{{ $counter }}">
                                <input type="text" name="education_date{{ $counter }}" value="{{ $edu->date }}" class="form-control text-center" id="education_date{{ $counter }}" placeholder="Date">
                            </div>
                            <div class="col-9">
                                <input type="text" name="education_description{{ $counter }}" value="{{ $edu->description }}" class="form-control" id="education_description{{ $counter }}" placeholder="Description">
                            </div>
                            <div class="col-1">
                                <div class="btn btn-outline-danger" id="btnRemoveEducation{{ $counter }}">
                                    <i class="fas fa-minus-circle"></i>
                                </div>
                            </div>
                        </div>
                        <?php
                        $counter += 1;
                        ?>
                    @endforeach
                @endif

                <div class="row mb-2">
                    <div class="col-12">
                        <div class="btn btn-outline-primary w-100 text-center" id="buttonAddEducation">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-5">
                        <hr class="w-100">
                    </div>
                    <div class="col-2 text-center">
                        <div>Languages</div>
                    </div>
                    <div class="col-5">
                        <hr class="w-100">
                    </div>
                </div>

                @if($languages != null)
                    <?php
                    $counter = 1;
                    ?>
                    @foreach($languages as $lang)
                        <div class="row mb-1" id="rowLanguage{{ $counter }}">
                            <div class="col-2">
                                <input type="text" name="language{{ $counter }}" value="{{ $lang->date }}" class="form-control" id="language{{ $counter }}" placeholder="Language">
                            </div>
                            <div class="col-9">
                                <input type="text" name="language_description{{ $counter }}" value="{{ $lang->description }}" class="form-control" id="language_description{{ $counter }}" placeholder="Description">
                            </div>
                            <div class="col-1">
                                <div class="btn btn-outline-danger" id="btnRemoveLanguage{{ $counter }}">
                                    <i class="fas fa-minus-circle"></i>
                                </div>
                            </div>
                        </div>
                        <?php
                        $counter += 1;
                        ?>
                    @endforeach
                @endif

                <div class="row mb-2">
                    <div class="col-12">
                        <div class="btn btn-outline-primary w-100 text-center" id="buttonAddLanguage">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <hr class="w-100">
                    </div>
                </div>


                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" value="{{($traineeInfo->address)}}" class="form-control" id="address" placeholder="Address">
                    @if($errors != null)
                        <small class="text-sm-left text-danger">{{ $errors->first('address') }}</small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="height">Height</label>
                    <input type="text" name="height" value="{{($traineeInfo->height)}}" class="form-control" id="height" placeholder="Height">
                    @if($errors != null)
                        <small class="text-sm-left text-danger">{{ $errors->first('height') }}</small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="dob">Date of birth</label>
                    <input type="date" name="dob" value="{{($traineeInfo->dob)}}" class="form-control" id="dob" placeholder="Date of birth">
                    @if($errors != null)
                        <small class="text-sm-left text-danger">{{ $errors->first('dob') }}</small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="place_of_birth">Place of birth</label>
                    <input type="text" name="place_of_birth" value="{{($traineeInfo->place_of_birth)}}" class="form-control" id="place_of_birth" placeholder="Place of birth">
                    @if($errors != null)
                        <small class="text-sm-left text-danger">{{ $errors->first('place_of_birth') }}</small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="nationality">Nationality</label>
                    <input type="text" name="nationality" value="{{($traineeInfo->nationality)}}" class="form-control" id="nationality" placeholder="Nationality">
                    @if($errors != null)
                        <small class="text-sm-left text-danger">{{ $errors->first('nationality') }}</small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="martial_status">Martial status</label>
                    <select name="martial_status" class="form-control" id="martial_status">
                        <option @if($traineeInfo->martial_status == 'Married') selected @endif value="Married">Married</option>
                        <option @if($traineeInfo->martial_status == 'Single') selected @endif value="Single">Single</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="hobbies">Hobbies</label>
                    <input type="text" name="hobbies" value="{{($traineeInfo->hobbies)}}" class="form-control" id="hobbies" placeholder="Hobbies">
                    @if($errors != null)
                        <small class="text-sm-left text-danger">{{ $errors->first('hobbies') }}</small>
                    @endif
                </div>

                <div class="row">
                    <div class="col-5">
                        <hr class="w-100">
                    </div>
                    <div class="col-2 text-center">
                        Reference
                    </div>
                    <div class="col-5">
                        <hr class="w-100">
                    </div>
                </div>

                <div class="form-group">
                    <label for="reference_name">Name</label>
                    <input type="text" name="reference_name" value="{{($traineeInfo->reference_name)}}" class="form-control" id="reference_name" placeholder="Name">
                    @if($errors != null)
                        <small class="text-sm-left text-danger">{{ $errors->first('reference_name') }}</small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="reference_position">Position</label>
                    <input type="text" name="reference_position" value="{{($traineeInfo->reference_position)}}" class="form-control" id="reference_position" placeholder="Position">
                    @if($errors != null)
                        <small class="text-sm-left text-danger">{{ $errors->first('reference_position') }}</small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="reference_phone">Phone</label>
                    <input type="text" name="reference_phone" value="{{($traineeInfo->reference_phone)}}" class="form-control" id="reference_phone" placeholder="Phone">
                    @if($errors != null)
                        <small class="text-sm-left text-danger">{{ $errors->first('reference_phone') }}</small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="reference_email">Email</label>
                    <input type="text" name="reference_email" value="{{($traineeInfo->reference_email)}}" class="form-control" id="reference_email" placeholder="Email">
                    @if($errors != null)
                        <small class="text-sm-left text-danger">{{ $errors->first('reference_email') }}</small>
                    @endif
                </div>


                <input type="submit" name="btn_save" value="Save Change" class="btn btn-info">
            </form>
        </div>
    </div>






@endsection
@section('javascript')
    <script>
        // for cropping image
        window.addEventListener('DOMContentLoaded', function () {
            var avatar2 = document.getElementById('photo2');
            var image2 = document.getElementById('image2');
            var input2 = document.getElementById('photoInput2');
            var $modal2 = $('#modalCropImage2');
            var cropper2;

            input2.addEventListener('change', function (e) {
                var files = e.target.files;
                var done = function (url) {
                    input2.value = '';
                    image2.src = url;
                    $modal2.modal('show');
                };
                var reader;
                var file;

                if (files && files.length > 0) {
                    file = files[0];

                    if (URL) {
                        done(URL.createObjectURL(file));
                    } else if (FileReader) {
                        reader = new FileReader();
                        reader.onload = function (e) {
                            done(reader.result);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });

            $modal2.on('shown.bs.modal', function () {
                cropper2 = new Cropper(image2, {
                    aspectRatio: 1,
                    viewMode: 3,
                });
                console.log('cropper opened')
            }).on('hidden.bs.modal', function () {
                console.log('modal on hidden work')
                cropper2.destroy();
                cropper2 = null;
            });

            document.getElementById('crop2').addEventListener('click', function () {
                $modal2.modal('hide');

                if (cropper2) {
                    canvas = cropper2.getCroppedCanvas({
                        width: 800,
                        height: 800,
                    });
                    avatar2.src = canvas.toDataURL();
                    $('input[name="cropedImage2"]').val(avatar2.src);
                }
            });
        });
    </script>
@endsection



