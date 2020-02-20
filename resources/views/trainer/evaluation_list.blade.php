@extends('trainer.layout')

@section('section_title', 'Manage Evaluations')

@section('stylesheet')
@endsection



@section('content')
    <div class="container-fluid">
        <div class="btn btn-success w-100 mb-2">Create a New Evaluation</div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab" aria-controls="first" aria-selected="true">First Evaluation</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="midterm-tab" data-toggle="tab" href="#midterm" role="tab" aria-controls="midterm" aria-selected="false">Midterm Evaluation</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="final-tab" data-toggle="tab" href="#final" role="tab" aria-controls="final" aria-selected="false">Final Evaluation</a>
            </li>
        </ul>
        <div class="tab-content mt-2" id="myTabContent">
            <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                <table id="evaluationListTableFirst" class="display">
                    <thead>
                    <tr>
                        <th>Trainee Name</th>
                        <th>Logical Thinking</th>
                        <th>Skills</th>
                        <th>Attitudes</th>
                        <th>Period</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($evaluation_datas['first_evaluation'] as $evaluation)
                        <tr>
                            <td>{{ $evaluation['name'] }}</td>
                            <td>{{ $evaluation['logical_thinking'] }}</td>
                            <td>{{ $evaluation['skills'] }}</td>
                            <td>{{ $evaluation['attitudes'] }}</td>
                            <td>{{ $evaluation['period'] }}</td>
                            <td>
                                <div class="btn btn-warning">Edit</div>
                                <div class="btn btn-danger">Delete</div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="midterm" role="tabpanel" aria-labelledby="midtern-tab">
                <table id="evaluationListTableMidterm" class="display">
                    <thead>
                    <tr>
                        <th>Trainee Name</th>
                        <th>Logical Thinking</th>
                        <th>Skills</th>
                        <th>Attitudes</th>
                        <th>Period</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($evaluation_datas['midterm_evaluation'] as $evaluation)
                        <tr>
                            <td>{{ $evaluation['name'] }}</td>
                            <td>{{ $evaluation['logical_thinking'] }}</td>
                            <td>{{ $evaluation['skills'] }}</td>
                            <td>{{ $evaluation['attitudes'] }}</td>
                            <td>{{ $evaluation['period'] }}</td>
                            <td>
                                <div class="btn btn-warning">Edit</div>
                                <div class="btn btn-danger">Delete</div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="final" role="tabpanel" aria-labelledby="final-tab">
                <table id="evaluationListTableFinal" class="display">
                    <thead>
                    <tr>
                        <th>Trainee Name</th>
                        <th>Logical Thinking</th>
                        <th>Skills</th>
                        <th>Attitudes</th>
                        <th>Period</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($evaluation_datas['final_evaluation'] as $evaluation)
                        <tr>
                            <td>{{ $evaluation['name'] }}</td>
                            <td>{{ $evaluation['logical_thinking'] }}</td>
                            <td>{{ $evaluation['skills'] }}</td>
                            <td>{{ $evaluation['attitudes'] }}</td>
                            <td>{{ $evaluation['period'] }}</td>
                            <td>
                                <div class="btn btn-warning">Edit</div>
                                <div class="btn btn-danger">Delete</div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>



    </div>
@endsection



@section('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#evaluationListTableFirst').DataTable();
            $('#evaluationListTableMidterm').DataTable();
            $('#evaluationListTableFinal').DataTable();
        });
    </script>
@endsection
