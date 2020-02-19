@extends('trainer.layout')

@section('content')
    @if(session('delete'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('delete') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
@foreach($users as $user)
    <form method="post" action="/user/update" style="width: 800px;margin: 0 auto;">
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
        <input type="submit" name="btn_save" value="Save Change" class="btn btn-info">
    </form>
@endforeach
@endsection
@section('javascript')
    <script>

    </script>
@endsection



