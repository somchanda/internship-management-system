@extends('trainee.layout')
@section('content')
    <br>
    <br>
    <div class="container emp-profile">
        <p>Trainee Name: <strong>{{ Auth::user()->last_name .' '.Auth::user()->first_name }}</strong></p>
        <table class="display table-bordered dataTable" id="table">
            <thead>
                <tr>
                    <th>Skills</th>
                    <th>Logical thinking</th>
                    <th>Attitudes</th>
                    <th>Period</th>
                    <th>Sub Total</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $totalScore = 0;
                $grade =0;
                $count=0;

            ?>
            @foreach($evaluations as $evaluation)
                <?php
                    $count++;
                    $logicalThinkingScore = $evaluation->logical_thinking;
                    if($logicalThinkingScore == 'A'){
                        $logicalThinkingScore = 100;
                    }else if($logicalThinkingScore == 'B'){
                        $logicalThinkingScore = 75;
                    }else{
                        $logicalThinkingScore = 50;
                    }
                    $logicalThinkingScore = ($logicalThinkingScore * 35) / 100;

                    $skillScore = $evaluation->skills;
                    if($skillScore == 'A'){
                        $skillScore = 100;
                    }else if($skillScore == 'B'){
                        $skillScore = 75;
                    }else{
                        $skillScore = 50;
                    }
                    $skillScore = ($skillScore * 35) / 100;

                    $attitudeScore = $evaluation->attitudes;
                    if($attitudeScore == 'A'){
                        $attitudeScore = 100;
                    }else if($attitudeScore == 'B'){
                        $attitudeScore = 75;
                    }else{
                        $attitudeScore = 50;
                    }
                    $attitudeScore = ($attitudeScore * 30) / 100;

                    $subTotalScore = $logicalThinkingScore + $skillScore + $attitudeScore;
                    $totalScore += $subTotalScore;
                    if($subTotalScore >= 75){
                        $subTotalScore = 'A';
                    }else if($subTotalScore >= 50 && $subTotalScore < 75){
                        $subTotalScore = 'B';
                    }else if($subTotalScore < 50){
                        $subTotalScore = 'C';
                    }
                ?>
                <tr>
                    <td>{{$evaluation->skills}}</td>
                    <td>{{$evaluation->logical_thinking}}</td>
                    <td>{{$evaluation->attitudes}}</td>
                    <td>{{$evaluation->period}}</td>
                    <td>
                        {{ $subTotalScore  }}
                    </td>
                    <td>{{ date('d/M/Y',strtotime($evaluation->date))}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <?php
            $totalScore = $totalScore/3;
            if($totalScore >= 75){
                $grade = 'A';
            }else if($totalScore >= 50 && $totalScore < 75){
                $grade = 'B';
            }else if($totalScore < 50){
                $grade = 'C';
            }
        ?>
    {{--    Result for evaluation--}}
        @if($count == 3)
            <h4 class="alert alert-info mt-3">Your Total Grade : <strong> {{ $grade }} </strong></h4>
        @else
            <h4 class="text-danger">Haven't finished evaluation yet!</h4>
        @endif
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#table').dataTable();
        });
    </script>
@endsection
