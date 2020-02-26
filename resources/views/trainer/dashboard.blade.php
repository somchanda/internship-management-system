@extends('trainer.layout')

@section('section_title', 'Dashboard')

@section('stylesheet')
    <style>
        body {
            background: -webkit-linear-gradient(left, #3931af, #00c6ff);
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-5">
                <div class="p-1 h-100" style="background-color: #ececec;">
                    <canvas id="trainee_each_tech_chart" width="1600" height="900"></canvas>
                    <div class="row">
                        <div class="col" style="width: -moz-fit-content; width: fit-content; margin-top: 75px;">
                            @for($i = 0; $i < sizeof($trainee_each_tech_position); $i++)
                                <span class="badge" style="background-color: {{ $colors[$i] }}; color: #fff;">{{ $trainee_each_tech_position[$i] }}: {{ $trainee_each_tech_number[$i] }}</span>
                            @endfor
                            <span class="badge badge-secondary w-100" style="font-size: 15px;">Total: {{ $total_trainee }}</span>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-7">
                <div class="p-1 h-100" style="background-color: #ececec;">
                    <canvas id="trainee_each_performance_chart" width="1600" height="900"></canvas>
                </div>

            </div>
        </div>
        <div class="row mt-3">
            <div class="col-6">
                <div style="background-color: #ececec;">
                    <canvas id="trainee_per_month_chart" width="1600" height="900"></canvas>
                </div>
            </div><div class="col-6">
                <div style="background-color: #ececec;">
                    <canvas id="trainee_per_month_by_status_chart" width="1600" height="900"></canvas>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('javascript')
    <script type="text/javascript" src="{{ asset('js/Chart.bundle.js') }}"></script>
    <script type="text/javascript">
        trainee_each_tech_label = @json($trainee_each_tech_position);
        trainee_each_tech_color = @json($trainee_each_tech_color);
        trainee_each_tech_data = @json($trainee_each_tech_number);

        new Chart(document.getElementById("trainee_each_tech_chart"), {
            type: 'doughnut',
            data: {
                labels: trainee_each_tech_label,
                datasets: [
                    {
                        label: "",
                        backgroundColor: trainee_each_tech_color,
                        data: trainee_each_tech_data
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Number of trainees of each technology'
                }
            }
        });

        evaluation_months = @json($evaluation_months);
        evaluation_grade_a = @json($evaluation_grade_a);
        evaluation_grade_b = @json($evaluation_grade_b);
        evaluation_grade_c = @json($evaluation_grade_c);
        new Chart(document.getElementById("trainee_each_performance_chart"), {
            type: 'bar',
            data: {
                labels: evaluation_months,
                datasets: [
                    {
                        label: "grade A",
                        backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
                        data: evaluation_grade_a
                    },{
                        label: "grade B",
                        backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
                        data: evaluation_grade_b
                    },{
                        label: "grade C",
                        backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
                        data: evaluation_grade_c
                    }
                ]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Number of interns by evaluation score'
                }
            }
        });

        trainee_per_month_month = @json($trainee_per_month_month);
        trainee_per_month_number = @json($trainee_per_month_number);
        new Chart(document.getElementById("trainee_per_month_chart"), {
            type: 'line',
            data: {
                labels: trainee_per_month_month,
                datasets: [{
                    data: trainee_per_month_number,
                    label: "",
                    borderColor: "#3e95cd",
                    fill: false
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Number of trainee per months'
                }
            }
        });

        trainee_per_month_by_status_month = @json($trainee_per_month_by_status_month);
        trainee_per_month_by_status_fail = @json($trainee_per_month_by_status_fail);
        trainee_per_month_by_status_stop = @json($trainee_per_month_by_status_stop);
        trainee_per_month_by_status_continue = @json($trainee_per_month_by_status_continue);
        trainee_per_month_by_status_doing_internship = @json($trainee_per_month_by_status_doing_internship);
        new Chart(document.getElementById("trainee_per_month_by_status_chart"), {
            type: 'line',
            data: {
                labels: trainee_per_month_by_status_month,
                datasets: [{
                    data: trainee_per_month_by_status_doing_internship,
                    label: "Doing Internship",
                    borderColor: "#2c30cd",
                    fill: false
                },{
                    data: trainee_per_month_by_status_continue,
                    label: "Continue",
                    borderColor: "#00cd10",
                    fill: false
                },{
                    data: trainee_per_month_by_status_stop,
                    label: "Stop",
                    borderColor: "#cdb500",
                    fill: false
                },{
                    data: trainee_per_month_by_status_fail,
                    label: "Fail",
                    borderColor: "#cd000d",
                    fill: false
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Number of trainee per months by status'
                }
            }
        });



    </script>
@endsection
