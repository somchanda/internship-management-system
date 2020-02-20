@extends('trainer.layout')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/user">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Users</li>
        </ol>
    </nav>
    @foreach($users as $user)
        <form method="post" action="/user/update" style="width: 1000px;margin: 0 auto;">
            @csrf
            <div class="row">
                <div class="col-sm-6">
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
                </div>
                <div class="col-sm-6">
                    <h4>More information</h4>
                    <div class="form-group">
                        <label for="internship_status">Internship status</label>
                        <select name="internship_status" class="form-control" id="internship_status">
                            <option @if($user->internship_status == 'Interning') selected @endif value="Interning">Interning</option>
                            <option @if($user->internship_status == 'Fail') selected @endif value="Fail">Fail</option>
                            <option @if($user->internship_status == 'Stop') selected @endif value="Stop">Stop</option>
                            <option @if($user->internship_status == 'Continue') selected @endif value="Continue">Continue</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="position">position</label>
                        <input type="text" name="position" value="{{$user->position}}" class="form-control" id="position" placeholder="position">
                        @if($errors != null)
                            <small class="text-sm-left text-danger">{{ $errors->first('position') }}</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="address">address</label>
                        <input type="text" name="address" value="{{($user->address)}}" class="form-control" id="address" placeholder="address">
                        @if($errors != null)
                            <small class="text-sm-left text-danger">{{ $errors->first('address') }}</small>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="martial_status">martial status</label>
                        <select name="martial_status" class="form-control" id="martial_status">
                            <option @if($user->martial_status == 'Married') selected @endif value="Married">Married</option>
                            <option @if($user->martial_status == 'Single') selected @endif value="Single">Single</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="height">Height(m)</label>
                        <input type="number" name="height" value="{{($user->height)}}" class="form-control" id="height" placeholder="height">
                        @if($errors != null)
                            <small class="text-sm-left text-danger">{{ $errors->first('address') }}</small>
                        @endif
                    </div>
                </div>
            </div>
            <input type="submit" name="btn_save" value="Save Change" class="btn btn-info">
        </form>
    @endforeach
@endsection
@section('javascript')
    <script>

    </script>
@endsection



