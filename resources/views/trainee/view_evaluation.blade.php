@extends('trainee.layout')
@section('content')
    <br>
    <br>
    <br>
    <p>Trainee Name: <strong>{{ Auth::user()->last_name .' '.Auth::user()->first_name }}</strong></p>
    <table class="display dataTable" id="table">
        <thead>
            <tr>
                <th>Skills</th>
                <th>Logical thinking</th>
                <th>Attitudes</th>
                <th>Period</th>
                <th>Total</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
        @php
            $total = 0;
            $count =0;

        @endphp
        @foreach($evaluations as $evaluation)
            <?php
            $count++;
                $l = '';
                $s = '';
                $a = '';
                //calculate logical thinking as score
                if($evaluation->logical_thinking == 'A'){
                    $l =35;
                }else if ($evaluation->logical_thinking =='B'){
                    $l = 20;
                }else{
                    $l = 10;
                }
                //calculate skills as score
                if($evaluation->skills == 'A'){
                    $s =35;
                }else if ($evaluation->skills =='B'){
                    $s = 20;
                }else{
                    $s = 10;
                }
                //calculate attitudes as score
                if($evaluation->attitudes == 'A'){
                    $a =30;
                }else if ($evaluation->attitudes =='B'){
                    $a = 17;
                }else{
                    $a = 7;
                }
            $subTotal = floatval($l) + floatval($s) + floatval($a);
            $total += floatval($subTotal);
            ?>
            <tr>
                <td>{{$evaluation->skills}}</td>
                <td>{{$evaluation->logical_thinking}}</td>
                <td>{{$evaluation->attitudes}}</td>
                <td>{{$evaluation->period}}</td>
                <td>
                    {{ $subTotal  }}
                </td>
                <td>@if($evaluation->created_at != null) {{date('d/M/Y', strtotime($evaluation->created_at))}} @endif</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @if($count == 3)
        <h3 class="text-info">Average : {{ $result= round($total/3,2) }}</h3><br>
        <h3 class="text-info">Result : @if($result >=50 ) <strong class="text-success">PASS</strong> @else <strong class="text-danger">FAIL</strong> @endif</h3>
    @else
        <h3 class="text-danger">Haven't finished evaluation yet!</h3>
    @endif
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#table').dataTable();
        });
    </script>
@endsection
