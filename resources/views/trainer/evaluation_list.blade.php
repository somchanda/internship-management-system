@extends('trainer.layout')
@section('section_title', 'Manage Evaluations')
@section('stylesheet')
@endsection
@section('content')
    <?php
        if(!session()->has('tab')){
            session(['tab'=>'final']);
        }
    ?>
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <a href="/trainer/create_evaluation">
            <div class="btn btn-success w-100 mb-2">Create a New Evaluation</div>
        </a>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link {{ session('tab')=='first'?'active':'' }}" id="first-tab" data-toggle="tab" href="#first" role="tab" aria-controls="first" aria-selected="true">First Evaluation</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ session('tab')=='midterm'?'active':'' }}" id="midterm-tab" data-toggle="tab" href="#midterm" role="tab" aria-controls="midterm" aria-selected="false">Midterm Evaluation</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ session('tab')=='final'?'active':'' }}" id="final-tab" data-toggle="tab" href="#final" role="tab" aria-controls="final" aria-selected="false">Final Evaluation</a>
            </li>
        </ul>
        <div class="tab-content mt-2" id="myTabContent">
            <div class="tab-pane fade {{session('tab')=='first'?'show active':''}}" id="first" role="tabpanel" aria-labelledby="first-tab">
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
                                <div class="btn btn-warning btn_edit" data-toggle="modal" data-target=".bd-example-modal-lg" id="{{ $evaluation['id'] }}">Edit</div>
                                <div class="btn btn-danger btn_delete" data-toggle="modal" data-target="#deleteModal" id="{{ $evaluation['id'] }}">Delete</div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade {{session('tab')=='midterm'?'show active':''}}" id="midterm" role="tabpanel" aria-labelledby="midtern-tab">
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
                                <div class="btn btn-warning btn_edit" data-toggle="modal" data-target=".bd-example-modal-lg" id="{{ $evaluation['id'] }}">Edit</div>
                                <div class="btn btn-danger btn_delete" data-toggle="modal" data-target="#deleteModal" id="{{ $evaluation['id'] }}">Delete</div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade {{session('tab')=='final'?'show active':''}}" id="final" role="tabpanel" aria-labelledby="final-tab">
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
                                <div class="btn btn-warning btn_edit" data-toggle="modal" data-target=".bd-example-modal-lg" id="{{ $evaluation['id'] }}">Edit</div>
                                <div class="btn btn-danger btn_delete" data-toggle="modal" data-target="#deleteModal" id="{{ $evaluation['id'] }}">Delete</div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
{{--Modal edit--}}
    <div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="padding: 30px;">
            <br>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header text-center">{{ __('Edit Evaluation') }}</div>
                            <div class="card-body">
                                <form method="POST" action="/trainer/evaluation/update">
                                    @csrf
                                    <input type="hidden" name="id" id="id">
                                    <div class="form-group row">
                                        <label for="period" class="col-md-4 col-form-label text-md-right">{{ __('Trainee') }}</label>
                                        <div class="col-md-6">
                                            <select id="trainee"  name="user_id" class="custom-select">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="period" class="col-md-4 col-form-label text-md-right">{{ __('Period') }}</label>
                                        <div class="col-md-6">
                                            <select id="period"  name="period" class="custom-select">
                                                <option value="First Evaluation" selected>First Evaluation</option>
                                                <option value="Midterm Evaluation">Midterm Evaluation</option>
                                                <option value="Final Evaluation" >Final Evaluation</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="logical_thinking" class="col-md-4 col-form-label text-md-right">{{ __('Logical thinking') }}</label>
                                        <div class="col-md-6">
                                            <select id="logical_thinking"  name="logical_thinking" class="custom-select">
                                                <option value="A" selected>A</option>
                                                <option value="B" selected>B</option>
                                                <option value="C" selected>C</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="skills" class="col-md-4 col-form-label text-md-right">{{ __('Skill') }}</label>
                                        <div class="col-md-6">
                                            <select id="skills"  name="skills" class="custom-select">
                                                <option value="A" selected>A</option>
                                                <option value="B" selected>B</option>
                                                <option value="C" selected>C</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="attitudes" class="col-md-4 col-form-label text-md-right">{{ __('Attitude') }}</label>
                                        <div class="col-md-6">
                                            <select id="attitudes"  name="attitudes" class="custom-select">
                                                <option value="A" selected>A</option>
                                                <option value="B" selected>B</option>
                                                <option value="C" selected>C</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                       <div class="col-md-6 text-right">
                                           <button type="submit" class="btn btn-primary">
                                               {{ __('Save change') }}
                                           </button>
                                       </div>
                                       <div class="col-md-6">
                                           <input type="button" class="btn btn-danger" id="btn_close" value="{{ __('Discard') }}">
                                       </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal delete -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-warning" id="exampleModalLabel">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="text-danger">Do you want delete this evaluation?</h5>
                </div>
                <div class="modal-footer">
                    <form action="/trainer/evaluation/delete" method="post">
                        @csrf
                        <input type="hidden" id="txt_id" name="txt_id">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">No</button>
                        <button type="submit" id="btn_yes" class="btn btn-danger">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function () {

            //call update session function when user click on tab
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                 // console.log(e.target.getAttribute('aria-controls'))
                update_session('tab', '' + e.target.getAttribute('aria-controls'))
            });
            //update session
            function update_session(session_name, session_value){
                console.log("session name : " + session_name)
                console.log("session value : " + session_value)
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/update_session',
                    type: 'post',
                    data: {
                        session_name:session_name,
                        session_value:session_value,
                    },
                    success:function (data) {
                        console.log(data)
                    },
                    error: function (data) {
                        console.log('error retrieving data')
                    }
                });
            }

            $('.btn_delete').click(function () {
               $('#deleteModal').find('#txt_id').val($(this).attr('id'));
            });

            //pop up edit
            $('.btn_edit').click(function () {
               var id = $(this).attr('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/trainer/evaluation/edit',
                    type: 'post',
                    data: {
                        id:id
                    },
                    success:function (data) {
                        $('#logical_thinking').val(data[0].logical_thinking);
                        $('#period').val(data[0].period);
                        $('#trainee').val(data[0].user_id);
                        $('#skills').val(data[0].skills);
                        $('#attitudes').val(data[0].attitudes);
                        $('#id').val(data[0].id);
                        console.log(data);
                    },
                    error: function (data) {
                        console.log('error retrieving data')
                        console.log(data);
                    }
                });
            });


            // close modal
            $('#btn_close').click(function () {
               $("#myModal").modal('hide');
            });

            //fill trainee select when user edit data
            fillTraineeSelect();
            function fillTraineeSelect(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/trainer/create_evaluation/fillTraineeSelectForUpdate',
                    type: 'get',
                    success:function (data) {
                        var option='';
                        for(var i =0;i<data.length;i++){
                            option+='<option value="'+data[i].id+'" >'+data[i].first_name+' '+data[i].last_name+'</option>';
                        }
                        $('#trainee').append(option);
                        console.log(data);
                    },
                    error: function (data) {
                        console.log('error retrieving data')
                        console.log(data);
                    }
                });
            }

            //Make the table to dataTable
            $('#evaluationListTableFirst').DataTable();
            $('#evaluationListTableMidterm').DataTable();
            $('#evaluationListTableFinal').DataTable();

        });
    </script>
@endsection
