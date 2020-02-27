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
{{--        @if($traineeInfo != null)--}}
        <li class="nav-item">
            <a class="nav-link" id="cvInfo-tab" data-toggle="tab" href="#cvInfo" role="tab" aria-controls="cvInfo" aria-selected="false">CV Information</a>
        </li>
{{--        @endif--}}
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

{{--        @if($traineeInfo != null)--}}
        <div class="tab-pane fade" id="cvInfo" role="tabpanel" aria-labelledby="cvInfo-tab">
            <form method="post" action="/trainee/update_cv_info" class="col-10 offset-1">
                @csrf
                <div class="form-group">
                    <label for="internship_status">Internship status</label>
                    <select name="internship_status" class="form-control" id="internship_status">
                        <option @if($traineeInfo != null) @if($traineeInfo->internship_status == 'Doing Internship') selected @endif @endif value="Doing Internship">Doing Internship</option>
                        <option @if($traineeInfo != null) @if($traineeInfo->internship_status == 'Fail') selected @endif @endif value="Fail">Fail</option>
                        <option @if($traineeInfo != null) @if($traineeInfo->internship_status == 'Stop') selected @endif @endif value="Stop">Stop</option>
                        <option @if($traineeInfo != null) @if($traineeInfo->internship_status == 'Continue') selected @endif @endif value="Continue">Continue</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="position">Position</label>
                    <input type="text" name="position" value="@if($traineeInfo != null){{$traineeInfo->position}}@endif" class="form-control" id="position" placeholder="position" required>
                    @if($errors != null)
                        <small class="text-sm-left text-danger">{{ $errors->first('position') }}</small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="contract_start">Start Contract</label>
                    <input type="date" name="contract_start" value="@if($traineeInfo != null){{$traineeInfo->contract_start}}@endif" class="form-control" id="contract_start" placeholder="Start Contract" required>
                    @if($errors != null)
                        <small class="text-sm-left text-danger">{{ $errors->first('contract_start') }}</small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="contract_end">End Contract</label>
                    <input type="date" name="contract_end" value="@if($traineeInfo != null){{$traineeInfo->contract_end}}@endif" class="form-control" id="contract_end" placeholder="End Contract" required>
                    @if($errors != null)
                        <small class="text-sm-left text-danger">{{ $errors->first('contract_end') }}</small>
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
                <div id="rowSkills">
                @foreach($skills as $skill)
                    <div class="row mb-1" id="rowSkill{{ $counter }}">
                        <div class="col-8">
                            <input type="text" name="skill{{ $counter }}" value="{{ $skill->skill }}" class="form-control" id="skill{{ $counter }}" placeholder="skill" required>
                        </div>
                        <div class="col-3">
                            <input type="number" min="1" max="10" name="skill_rate{{ $counter }}" value="{{ $skill->rate }}" class="form-control" id="skill_rate{{ $counter }}" placeholder="rate" required>
                        </div>
                        <div class="col-1">
                            <div class="btn btn-outline-danger" id="btnRemoveSkill{{ $counter }}" onclick="remove_row_input($(this).parent().parent().attr('id'), 'rowSkills')">
                                <i class="fas fa-minus-circle"></i>
                            </div>
                        </div>
                    </div>
                    <?php
                        $counter += 1;
                    ?>
                @endforeach
                </div>
                @else
                    <div class="row mb-1" id="rowSkill1">
                        <div class="col-8">
                            <input type="text" name="skill1" value="" class="form-control" id="skill1" placeholder="skill" required>
                        </div>
                        <div class="col-3">
                            <input type="number" min="1" max="10" name="skill_rate1" value="" class="form-control" id="skill_rate1" placeholder="rate" required>
                        </div>
                        <div class="col-1">
                            <div class="btn btn-outline-danger" id="btnRemoveSkill1" onclick="remove_row_input($(this).parent().parent().attr('id'), 'rowSkills')">
                                <i class="fas fa-minus-circle"></i>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row mb-2">
                    <div class="col-12">
                        <div class="btn btn-outline-primary w-100 text-center" id="buttonAddSkill" onclick="add_row_input_skills()">
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
                    <div id="rowWorkExperiences">
                    @foreach($workExperiences as $workExp)
                        <div class="row mb-1" id="rowWorkExperience{{ $counter }}">
                            <div class="col-2">
                                <input type="text" name="work_experience_date{{ $counter }}" value="{{ $workExp->date }}" class="form-control text-center" id="work_experience_date{{ $counter }}" placeholder="Date" required>
                            </div>
                            <div class="col-9">
                                <input type="text" name="work_experience_description{{ $counter }}" value="{{ $workExp->description }}" class="form-control" id="work_experience_description{{ $counter }}" placeholder="Description" required>
                            </div>
                            <div class="col-1">
                                <div class="btn btn-outline-danger" id="btnRemoveWorkExperience{{ $counter }}" onclick="remove_row_input($(this).parent().parent().attr('id'), 'rowWorkExperiences')">
                                    <i class="fas fa-minus-circle"></i>
                                </div>
                            </div>
                        </div>
                        <?php
                        $counter += 1;
                        ?>
                    @endforeach
                    </div>
                @else
                    <div class="row mb-1" id="rowWorkExperience1">
                        <div class="col-2">
                            <input type="text" name="work_experience_date1" value="" class="form-control text-center" id="work_experience_date1" placeholder="Date" required>
                        </div>
                        <div class="col-9">
                            <input type="text" name="work_experience_description1" value="" class="form-control" id="work_experience_description1" placeholder="Description" required>
                        </div>
                        <div class="col-1">
                            <div class="btn btn-outline-danger" id="btnRemoveWorkExperience1" onclick="remove_row_input($(this).parent().parent().attr('id'), 'rowWorkExperiences')">
                                <i class="fas fa-minus-circle"></i>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row mb-2">
                    <div class="col-12">
                        <div class="btn btn-outline-primary w-100 text-center" id="buttonAddWorkExperience" onclick="add_row_input_work_exps()">
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
                    <div id="rowEducations">
                    @foreach($educations as $edu)
                        <div class="row mb-1" id="rowEducation{{ $counter }}">
                            <div class="col-2">
                                <input type="text" name="education_date{{ $counter }}" value="{{ $edu->date }}" class="form-control text-center" id="education_date{{ $counter }}" placeholder="Date" required>
                            </div>
                            <div class="col-9">
                                <input type="text" name="education_description{{ $counter }}" value="{{ $edu->description }}" class="form-control" id="education_description{{ $counter }}" placeholder="Description" required>
                            </div>
                            <div class="col-1">
                                <div class="btn btn-outline-danger" id="btnRemoveEducation{{ $counter }}" onclick="remove_row_input($(this).parent().parent().attr('id'), 'rowEducations')">
                                    <i class="fas fa-minus-circle"></i>
                                </div>
                            </div>
                        </div>
                        <?php
                        $counter += 1;
                        ?>
                    @endforeach
                    </div>
                @else
                    <div class="row mb-1" id="rowEducation1">
                        <div class="col-2">
                            <input type="text" name="education_date1" value="" class="form-control text-center" id="education_date1" placeholder="Date" required>
                        </div>
                        <div class="col-9">
                            <input type="text" name="education_description1" value="" class="form-control" id="education_description1" placeholder="Description" required>
                        </div>
                        <div class="col-1">
                            <div class="btn btn-outline-danger" id="btnRemoveEducation1" onclick="remove_row_input($(this).parent().parent().attr('id'), 'rowEducations')">
                                <i class="fas fa-minus-circle"></i>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row mb-2">
                    <div class="col-12">
                        <div class="btn btn-outline-primary w-100 text-center" id="buttonAddEducation" onclick="add_row_input_edus()">
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
                    <div id="rowLanguages">
                    @foreach($languages as $lang)
                        <div class="row mb-1" id="rowLanguage{{ $counter }}">
                            <div class="col-2">
                                <input type="text" name="language{{ $counter }}" value="{{ $lang->language }}" class="form-control" id="language{{ $counter }}" placeholder="Language" required>
                            </div>
                            <div class="col-9">
                                <input type="text" name="language_description{{ $counter }}" value="{{ $lang->description }}" class="form-control" id="language_description{{ $counter }}" placeholder="Description" required>
                            </div>
                            <div class="col-1">
                                <div class="btn btn-outline-danger" id="btnRemoveLanguage{{ $counter }}" onclick="remove_row_input($(this).parent().parent().attr('id'), 'rowLanguages')">
                                    <i class="fas fa-minus-circle"></i>
                                </div>
                            </div>
                        </div>
                        <?php
                        $counter += 1;
                        ?>
                    @endforeach
                    </div>
                @else
                    <div class="row mb-1" id="rowLanguage1">
                        <div class="col-2">
                            <input type="text" name="language1" value="" class="form-control" id="language1" placeholder="Language" required>
                        </div>
                        <div class="col-9">
                            <input type="text" name="language_description1" value="" class="form-control" id="language_description1" placeholder="Description" required>
                        </div>
                        <div class="col-1">
                            <div class="btn btn-outline-danger" id="btnRemoveLanguage1" onclick="remove_row_input($(this).parent().parent().attr('id'), 'rowLanguages')">
                                <i class="fas fa-minus-circle"></i>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row mb-2">
                    <div class="col-12">
                        <div class="btn btn-outline-primary w-100 text-center" id="buttonAddLanguage" onclick="add_row_input_langs()">
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
                    <input type="text" name="address" value="@if($traineeInfo != null){{($traineeInfo->address)}}@endif" class="form-control" id="address" placeholder="Address" required>
                    @if($errors != null)
                        <small class="text-sm-left text-danger">{{ $errors->first('address') }}</small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="height">Height</label>
                    <input type="text" name="height" value="@if($traineeInfo != null){{($traineeInfo->height)}}@endif" class="form-control" id="height" placeholder="Height" required>
                    @if($errors != null)
                        <small class="text-sm-left text-danger">{{ $errors->first('height') }}</small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="dob">Date of birth</label>
                    <input type="date" name="dob" value="@if($traineeInfo != null){{($traineeInfo->dob)}}@endif" class="form-control" id="dob" placeholder="Date of birth" required>
                    @if($errors != null)
                        <small class="text-sm-left text-danger">{{ $errors->first('dob') }}</small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="place_of_birth">Place of birth</label>
                    <input type="text" name="place_of_birth" value="@if($traineeInfo != null){{($traineeInfo->place_of_birth)}}@endif" class="form-control" id="place_of_birth" placeholder="Place of birth" required>
                    @if($errors != null)
                        <small class="text-sm-left text-danger">{{ $errors->first('place_of_birth') }}</small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="nationality">Nationality</label>
                    <input type="text" name="nationality" value="@if($traineeInfo != null){{($traineeInfo->nationality)}}@endif" class="form-control" id="nationality" placeholder="Nationality" required>
                    @if($errors != null)
                        <small class="text-sm-left text-danger">{{ $errors->first('nationality') }}</small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="marital_status">Marital status</label>
                    <select name="marital_status" class="form-control" id="marital_status">
                        <option @if($traineeInfo != null) @if($traineeInfo->marital_status == 'Married') selected @endif @endif value="Married">Married</option>
                        <option @if($traineeInfo != null) @if($traineeInfo->marital_status == 'Single') selected @endif @endif value="Single">Single</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="hobbies">Hobbies</label>
                    <input type="text" name="hobbies" value="@if($traineeInfo != null){{($traineeInfo->hobbies)}}@endif" class="form-control" id="hobbies" placeholder="Hobbies" required>
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
                    <input type="text" name="reference_name" value="@if($traineeInfo != null){{($traineeInfo->reference_name)}}@endif" class="form-control" id="reference_name" placeholder="Name" required>
                    @if($errors != null)
                        <small class="text-sm-left text-danger">{{ $errors->first('reference_name') }}</small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="reference_position">Position</label>
                    <input type="text" name="reference_position" value="@if($traineeInfo != null){{($traineeInfo->reference_position)}}@endif" class="form-control" id="reference_position" placeholder="Position" required>
                    @if($errors != null)
                        <small class="text-sm-left text-danger">{{ $errors->first('reference_position') }}</small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="reference_phone">Phone</label>
                    <input type="text" name="reference_phone" value="@if($traineeInfo != null){{($traineeInfo->reference_phone)}}@endif" class="form-control" id="reference_phone" placeholder="Phone" required>
                    @if($errors != null)
                        <small class="text-sm-left text-danger">{{ $errors->first('reference_phone') }}</small>
                    @endif
                </div>

                <div class="form-group">
                    <label for="reference_email">Email</label>
                    <input type="text" name="reference_email" value="@if($traineeInfo != null){{($traineeInfo->reference_email)}}@endif" class="form-control" id="reference_email" placeholder="Email" required>
                    @if($errors != null)
                        <small class="text-sm-left text-danger">{{ $errors->first('reference_email') }}</small>
                    @endif
                </div>


                <input type="hidden" id="skills" name="skills" value="">

                <input type="hidden" id="work_exps" name="work_exps" value="">

                <input type="hidden" id="edus" name="edus" value="">

                <input type="hidden" id="langs" name="langs" value="">

                @if($traineeInfo != null)
                <input type="hidden" id="id" name="id" value="{{ $traineeInfo->id }}"/>
                @else
                    <input type="hidden" id="id" name="id" value="-1"/>
                @endif

                <input type="hidden" id="user_id" name="user_id" value="{{ $trainee->id }}"/>


                <input type="submit" name="btn_save" value="Save Change" class="btn btn-info">
            </form>
        </div>
{{--        @endif--}}
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

        function add_row_input_skills(){
            index = ($('#rowSkills').children()).length + 1;

            $('#rowSkills').append('<div class="row mb-1" id="rowSkill' + index + '">\n' +
                '                <div class="col-8">\n' +
                '                <input type="text" name="skill' + index + '" value="" class="form-control" id="skill' + index + '" placeholder="skill" required>\n' +
                '                </div>\n' +
                '                <div class="col-3">\n' +
                '                <input type="number" min="1" max="10" name="skill_rate' + index + '" value="" class="form-control" id="skill_rate' + index + '" placeholder="rate" required>\n' +
                '                </div>\n' +
                '                <div class="col-1">\n' +
                '                <div class="btn btn-outline-danger" id="btnRemoveSkill' + index + '" onclick="remove_row_input($(this).parent().parent().attr(\'id\'), \'rowSkills\')">\n' +
                '                <i class="fas fa-minus-circle"></i>\n' +
                '                </div>\n' +
                '                </div>\n' +
                '                </div>');

            update_hidden_skills();
        }

        function add_row_input_work_exps() {
            index = ($('#rowWorkExperiences').children()).length + 1;
            $('#rowWorkExperiences').append('<div class="row mb-1" id="rowWorkExperience' + index + '">\n' +
                '                            <div class="col-2">\n' +
                '                                <input type="text" name="work_experience_date' + index + '" value="" class="form-control text-center" id="work_experience_date' + index + '" placeholder="Date" required>\n' +
                '                            </div>\n' +
                '                            <div class="col-9">\n' +
                '                                <input type="text" name="work_experience_description' + index + '" value="" class="form-control" id="work_experience_description' + index + '" placeholder="Description" required>\n' +
                '                            </div>\n' +
                '                            <div class="col-1">\n' +
                '                                <div class="btn btn-outline-danger" id="btnRemoveWorkExperience' + index + '" onclick="remove_row_input($(this).parent().parent().attr(\'id\'), \'rowWorkExperiences\')">\n' +
                '                                    <i class="fas fa-minus-circle"></i>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                        </div>');

            update_hidden_work_exps();
        }

        function add_row_input_edus() {
            index = ($('#rowEducations').children()).length + 1;
            $('#rowEducations').append('<div class="row mb-1" id="rowEducation' + index + '">\n' +
                '                            <div class="col-2">\n' +
                '                                <input type="text" name="education_date' + index + '" value="" class="form-control text-center" id="education_date' + index + '" placeholder="Date" required>\n' +
                '                            </div>\n' +
                '                            <div class="col-9">\n' +
                '                                <input type="text" name="education_description' + index + '" value="" class="form-control" id="education_description' + index + '" placeholder="Description" required>\n' +
                '                            </div>\n' +
                '                            <div class="col-1">\n' +
                '                                <div class="btn btn-outline-danger" id="btnRemoveEducation' + index + '" onclick="remove_row_input($(this).parent().parent().attr(\'id\'), \'rowEducations\')">\n' +
                '                                    <i class="fas fa-minus-circle"></i>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                        </div>');

            update_hidden_edus();
        }

        function add_row_input_langs() {
            index = ($('#rowLanguages').children()).length + 1;
            $('#rowLanguages').append('<div class="row mb-1" id="rowLanguage' + index + '">\n' +
                '                            <div class="col-2">\n' +
                '                                <input type="text" name="language' + index + '" value="" class="form-control" id="language' + index + '" placeholder="Language" required>\n' +
                '                            </div>\n' +
                '                            <div class="col-9">\n' +
                '                                <input type="text" name="language_description' + index + '" value="" class="form-control" id="language_description' + index + '" placeholder="Description" required>\n' +
                '                            </div>\n' +
                '                            <div class="col-1">\n' +
                '                                <div class="btn btn-outline-danger" id="btnRemoveLanguage' + index + '" onclick="remove_row_input($(this).parent().parent().attr(\'id\'), \'rowLanguages\')">\n' +
                '                                    <i class="fas fa-minus-circle"></i>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                        </div>');

            update_hidden_langs();
        }

        function remove_row_input(row_id, row_parent_id) {
            $(document).find('#' + row_id).remove();

            // asign new id to children row
            children_id = row_parent_id.substring(0, row_parent_id.length-1);

            children = $('#' + row_parent_id).children();

            if(children.length > 0){
                for(i = 0; i < children.length; i++){
                    children[i].setAttribute('id', children_id + (i+1));
                }
            }


            if(row_parent_id === 'rowSkills'){
                update_hidden_skills();
            }else if(row_parent_id === 'rowWorkExperiences'){
                update_hidden_work_exps();
            }else if(row_parent_id === 'rowEducations'){
                update_hidden_edus();
            }else if(row_parent_id === 'rowLanguages'){
                update_hidden_langs();
            }
        }

        function update_hidden_skills(){
            $('input[name="skills"]').val(($('#rowSkills').children()).length);
            console.log($('input[name="skills"]').val());

            // skills = $('input[name="skills"]');
            // hidden_input_skills = $('input[name="skills"]');

            // skill_ids = "";
            //
            // for(i = 0; i < skills.length; i++){
            //     if(skill_ids === ''){
            //         skill_ids += skills[i].getAttribute('id');
            //     }else{
            //         skill_ids += ',' + skills[i].getAttribute('id');
            //     }
            // }
            // hidden_input_skills.val(skill_ids);
            // console.log(hidden_input_skills.val())
        }

        function update_hidden_work_exps() {
            $('input[name="work_exps"]').val(($('#rowWorkExperiences').children()).length);
            console.log($('input[name="work_exps"]').val());


            // work_exps = $('#rowWorkExperiences').children();
            // hidden_input_work_exps = $('input[name="work_exps"]');
            //
            // work_exp_ids = "";
            //
            // for(i = 0; i < work_exps.length; i++){
            //     if(work_exp_ids === ""){
            //         work_exp_ids += work_exps[i].getAttribute('id');
            //     }else{
            //         work_exp_ids += "," + work_exps[i].getAttribute('id');
            //     }
            // }
            // hidden_input_work_exps.val(work_exp_ids)
            //
            // console.log(hidden_input_work_exps.val())
        }

        function update_hidden_edus() {
            $('input[name="edus"]').val(($('#rowEducations').children()).length);
            console.log($('input[name="edus"]').val());

            // edus = $('#rowEducations').children();
            // hidden_input_edus = $('input[name="edus"]');
            //
            // edu_ids = "";
            //
            // for(i = 0; i < edus.length; i++){
            //     if(edu_ids === ""){
            //         edu_ids += edus[i].getAttribute('id');
            //     }else{
            //         edu_ids += "," + edus[i].getAttribute('id');
            //     }
            // }
            // hidden_input_edus.val(edu_ids)
            //
            // console.log(hidden_input_edus.val())
        }

        function update_hidden_langs() {
            $('input[name="langs"]').val(($('#rowLanguages').children()).length);
            console.log($('input[name="langs"]').val());

            // langs = $('#rowLanguages').children();
            // hidden_input_langs = $('input[name="langs"]');
            //
            // lang_ids = "";
            //
            // for(i = 0; i < langs.length; i++){
            //     if(lang_ids === ""){
            //         lang_ids = langs[i].getAttribute('id');
            //     }else{
            //         lang_ids += "," + langs[i].getAttribute('id');
            //     }
            // }
            // hidden_input_langs.val(lang_ids)
            //
            // console.log(hidden_input_langs.val())
        }

        $(document).ready(function () {
            update_hidden_skills();
            update_hidden_work_exps();
            update_hidden_edus();
            update_hidden_langs();
        });
    </script>
@endsection



