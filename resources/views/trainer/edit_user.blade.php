@extends('trainer.layout')

@section('section_title')
    Edit <b>{{ $user->first_name.' '.$user->last_name }}</b>'s Infomation
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

    <form method="post" action="/user/update_user" style="width: 800px;margin: 0 auto;">
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $user->id }}">
        <div class="form-group">
            <label for="fist_name">First name</label>
            <input type="text" name="first_name" value="{{($user->first_name)}}" class="form-control" id="fist_name" placeholder="First name">
            @if($errors != null)
                <small class="text-sm-left text-danger">{{ $errors->first('first_name') }}</small>
            @endif
        </div>
        <div class="form-group">
            <label for="last_name">Last name</label>
            <input type="text" name="last_name" value="{{($user->last_name)}}" class="form-control" id="last_name" placeholder="Last name">
            @if($errors != null)
                <small class="text-sm-left text-danger">{{ $errors->first('last_name') }}</small>
            @endif
        </div>
        <div class="form-group">
            <label for="sex">Sex</label>
            <select  name="sex" class="form-control" id="sex">
                <option @if($user->sex == 'Male') selected @endif value="Male">Male</option>
                <option @if($user->sex == 'Female') selected @endif value="Female">Female</option>
            </select>
            @if($errors != null)
                <small class="text-sm-left text-danger">{{ $errors->first('sex') }}</small>
            @endif
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" value="{{($user->phone)}}" class="form-control" id="phone" placeholder="Phone">
            @if($errors != null)
                <small class="text-sm-left text-danger">{{ $errors->first('phone') }}</small>
            @endif
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" value="{{($user->email)}}" class="form-control" id="email" placeholder="Email">
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



