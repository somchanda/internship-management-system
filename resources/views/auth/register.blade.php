@extends('trainer.layout')

@section('stylesheet')
    <style>
        #card-header {
            background-color: rgba(142, 193, 28, 0.44);
        }

        #card-body {
            background-color: rgba(134, 183, 0, 0.21);
        }
    </style>
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

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center" id="card-header">{{ __('Create New Account') }}</div>

                    <div class="card-body" id="card-body">
                        <form method="POST" action="/trainer/create_account">
                            @csrf

                            <div class="form-group row">
                                <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name">

                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sex" class="col-md-4 col-form-label text-md-right">{{ __('Sex') }}</label>

                                <div class="col-md-6">
                                    <select id="sex" name="sex" class="custom-select">
                                        <option value="Male" selected>Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('User Type') }}</label>

                                <div class="col-md-6">
                                    <select id="type" name="type" class="custom-select">
                                        <option value="Admin">Admin</option>
                                        <option value="Trainer">Trainer</option>
                                        <option value="Trainee" selected>Trainee</option>
                                    </select>
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Profile Picture') }}</label>

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

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('javascript')
    <script>
        // for cropting image
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
            }).on('hidden.bs.modal', function () {
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

        $('#sex').change(function () {
            sex = $('select[name="sex"]').val();
            if(sex === "Female"){
                $('#photo').attr('src', '{{ asset('img/woman_profile_icon.png') }}');
            }else{
                $('#photo').attr('src', '{{ asset('img/man_profile_icon.png') }}');
            }
        });

        $(document).ready(function () {
            sex = $('select[name="sex"]').val();
            if(sex === "Female"){
                $('#photo').attr('src', '{{ asset('img/woman_profile_icon.png') }}');
            }else{
                $('#photo').attr('src', '{{ asset('img/man_profile_icon.png') }}');
            }
        });
    </script>
@endsection
