@extends('auth.layout')

@section('stylesheet')
    <style>
        .avatar{
            width: 5rem;
            height: 5rem;
            background-size: cover;
            background-repeat: no-repeat;
            position: relative;
        }
        .avatar img{
            width: 5rem;
            height: 5rem;
            position: absolute;
            top: 0;
            left: 0;

        }
        .avatar1{
            width: 5rem;
            height: 2rem;
            background-color: black;
            opacity: 0;
            position: absolute;
            bottom: 0;
            left: 0;
        }
        .avatar1:hover{
            opacity: 0.8;
        }
        .avatar1 input{
            width: 5rem;
            height: 2rem;
            position: absolute;
            bottom: 0;
            opacity: 0;
        }
        .img-container img {
            max-width: 100%;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/cropper.css') }}">
@endsection

@section('content')
    {{--    modal for cropping image--}}
    <div class="modal fade" id="modalCropImage" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Crop the image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <img id="image" src="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="crop">Crop</button>
                </div>
            </div>
        </div>
    </div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Create New Account') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
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
                                    <img id="photo"  src="{{asset('img/man_profile_icon.png')}}" alt="">
                                    <div class="avatar1">
                                        <p class="text-center text-light">Choose</p>
                                        <input type="file" id="photoInput" name="photo">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="cropedImage" value=""/>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
    <script src="{{ asset('js/cropper.js') }}"></script>
    <script>
        // for cropting image
        window.addEventListener('DOMContentLoaded', function () {
            var avatar = document.getElementById('photo');
            var image = document.getElementById('image');
            var input = document.getElementById('photoInput');
            var $modal = $('#modalCropImage');
            var cropper;

            input.addEventListener('change', function (e) {
                var files = e.target.files;
                var done = function (url) {
                    input.value = '';
                    image.src = url;
                    $modal.modal('show');
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

            $modal.on('shown.bs.modal', function () {
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 3,
                });
            }).on('hidden.bs.modal', function () {
                cropper.destroy();
                cropper = null;
            });

            document.getElementById('crop').addEventListener('click', function () {
                $modal.modal('hide');

                if (cropper) {
                    canvas = cropper.getCroppedCanvas({
                        width: 800,
                        height: 800,
                    });
                    avatar.src = canvas.toDataURL();
                    $('input[name="cropedImage"]').val(avatar.src);
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
