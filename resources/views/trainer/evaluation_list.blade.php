@extends('trainer.layout')



@section('stylesheet')
    <link rel="stylesheet" href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
@endsection



@section('content')
    <div>Evaluation List</div>
@endsection



@section('javascript')
    <script src="cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            // $('#evaluationListTable').DataTable();
            console.log("list is ready")
        });
    </script>
@endsection
