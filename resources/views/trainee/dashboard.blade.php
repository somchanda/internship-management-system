@extends('trainee.layout')
@section('content')
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container" >
            <h1 class="display-3">Welcome <strong>{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</strong></h1>
            <p><a class="btn btn-primary btn-lg" href="/trainee/profile" role="button">View Profile&raquo;</a></p>
        </div>
    </div>



@endsection
