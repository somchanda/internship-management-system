@extends('trainee.layout')
@section('content')
    <br>
    <br>
    <br>
    <p>Trainee Name: <strong>{{ Auth::user()->last_name .' '.Auth::user()->first_name }}</strong></p>
    <table class="display dataTable no-footer" id="table">
        <thead>
            <tr>
                <th>Skills</th>
                <th>Logical thinking</th>
                <th>Attitudes</th>
                <th>Period</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
        @foreach($evaluations as $evaluation)
            <tr>
                <td>{{$evaluation->skills}}</td>
                <td>{{$evaluation->logical_thinking}}</td>
                <td>{{$evaluation->attitudes}}</td>
                <td>{{$evaluation->period}}</td>
                <td>@if($evaluation->created_at != null) {{date('d/M/Y', strtotime($evaluation->created_at))}} @endif</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#table').dataTable();
        });
    </script>
@endsection
