@extends('trainee.layout')
@section('content')
    <br>
    <br>
    <br>
    <table class="table table-striped table-bordered" id="table">
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
                <td>@if($evaluation->created_at != null) {{$evaluation->created_at->format('d/M/Y') }} @endif</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    logical thinking 35%
    skill 35%
    attitudes 35%

@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#table').dataTable();
        });
    </script>
@endsection
