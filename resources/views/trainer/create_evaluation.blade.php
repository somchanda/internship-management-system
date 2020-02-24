@extends('trainer.layout')

@section('section_title', 'Manage Evaluations')

@section('stylesheet')
    <style>
        .avatar{
            width: 5rem;
            height: 5rem;
            background-size: cover;
            background-repeat: no-repeat;
            position: relative;
        }
        .avatar img{
            width: 5rem;
            height: 5rem;
            position: absolute;
            top: 0;
            left: 0;

        }
        .avatar1{
            width: 5rem;
            height: 2rem;
            background-color: black;
            opacity: 0;
            position: absolute;
            bottom: 0;
            left: 0;
        }
        .avatar1:hover{
            opacity: 0.8;
        }
        .avatar1 input{
            width: 5rem;
            height: 2rem;
            position: absolute;
            bottom: 0;
            opacity: 0;
        }
        .img-container img {
            max-width: 100%;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/cropper.css') }}">
@endsection



@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-center">{{ __('Make Evaluation') }}</div>
                    <div class="card-body">
                        <form method="POST" action="/trainer/evaluation/save">
                            @csrf
                            <div class="form-group row" >
                                <label for="period" class="col-md-4 col-form-label text-md-right">{{ __('Trainee') }}</label>
                                <div class="col-md-6">
                                    <select id="trainee" name="user_id" class="custom-select @error('user_id') is-invalid @enderror">

                                    </select>
                                    @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="period" class="col-md-4 col-form-label text-md-right">{{ __('Period') }}</label>
                                <div class="col-md-6">
                                    <select id="period"  name="period" class="custom-select @error('period') is-invalid @enderror">
                                        <option  value="First Evaluation" id="first">First Evaluation</option>
                                        <option value="Midterm Evaluation" id="mid">Midterm Evaluation</option>
                                        <option value="Final Evaluation" id="final">Final Evaluation</option>
                                    </select>
                                    @error('period')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="logical_thinking" class="col-md-4 col-form-label text-md-right">{{ __('Logical thinking') }}</label>
                                <div class="col-md-6">
                                    <select id="logical_thinking"  name="logical_thinking" class="custom-select  @error('logical_thinking') is-invalid @enderror">
                                        <option value="A" >A</option>
                                        <option value="B">B</option>
                                        <option value="C" >C</option>
                                    </select>
                                    @error('logical_thinking')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="skills" class="col-md-4 col-form-label text-md-right">{{ __('Skill') }}</label>
                                <div class="col-md-6">
                                    <select id="skills"  name="skills" class="custom-select  @error('skills') is-invalid @enderror">
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                    </select>
                                    @error('skills')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="attitudes" class="col-md-4 col-form-label text-md-right">{{ __('Attitude') }}</label>
                                <div class="col-md-6">
                                    <select id="attitudes" name="attitudes" class="custom-select  @error('attitudes') is-invalid @enderror">
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                    </select>
                                    @error('attitudes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="btn_save" class="btn btn-primary">
                                        {{ __('Create') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            fillTraineeSelect();
            function fillTraineeSelect(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/trainer/create_evaluation/fillTraineeSelect',
                    type: 'get',
                    success:function (data) {
                        var option='';
                        for(var i =0;i<data.length;i++){

                            option+='<option value="'+data[i].id+'" >'+data[i].first_name+' '+data[i].last_name+'</option>';
                        }
                        $('#trainee').append(option);
                        trainee_id=$('#trainee').val();
                        fillPeriodSelect(trainee_id);
                        console.log(data);
                    },
                    error: function (data) {
                        console.log('error retrieving data');
                        console.log(data);
                    }
                });
            }
            function fillPeriodSelect(id){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/trainer/create_evaluation/fillPeriodSelect',
                    type: 'post',
                    data:{
                        id:id
                    },
                    success:function (data) {
                        if(data.length===3) {
                            $('#skills').attr('disabled', 'disabled');
                             $('#period').attr('disabled', 'disabled');
                            $('#logical_thinking').attr('disabled', 'disabled');
                            $('#attitudes').attr('disabled', 'disabled');
                            $('#btn_save').attr('disabled', 'disabled');
                            $('#period').val('');
                        }else{
                            $('#skills').removeAttr('disabled','disabled');
                            $('#period').removeAttr('disabled','disabled');
                            $('#logical_thinking').removeAttr('disabled','disabled');
                            $('#attitudes').removeAttr('disabled','disabled');
                            $('#btn_save').removeAttr('disabled','disabled');
                        }
                        $('#first').show();
                        $('#mid').show();
                        $('#final').show();
                        var oid = '';
                        for (var i = 0; i < data.length; i++) {
                            if (data[i].period.toString()==='First Evaluation') {
                                $('#first').hide();
                            }
                            if (data[i].period.toString()==='Midterm Evaluation') {
                                $('#mid').hide()
                            }
                            if(data[i].period.toString()==='Final Evaluation') {
                                $('#final').hide();
                            }


                        }

                        console.log(data);
                    },
                    error: function (data) {

                        console.log('error retrieving data');

                    }
                });
            }
            $(document).on('change','#trainee',function () {
               fillPeriodSelect($(this).val());
            });
        });
    </script>
@endsection

