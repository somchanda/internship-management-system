@extends('trainer.layout')

@section('section_title', 'Accounts List')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
{{--    Nav tap--}}
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="admin-tab" data-toggle="tab" href="#admin" role="tab" aria-controls="admin" aria-selected="true">Admin</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#trainer" role="tab" aria-controls="trainer" aria-selected="false">Trainer</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="trainee-tab" data-toggle="tab" href="#trainee" role="tab" aria-controls="trainee" aria-selected="false">Trainee</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
{{--        Admin table--}}
        <div class="tab-pane fade show active" id="admin" role="tabpanel" aria-labelledby="admin-tab">
            <h1>Admin</h1>
            <table class="table" id="table_admin">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">First Name</th>
                    <th class="text-center">Last Name</th>
                    <th class="text-center">Phone</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Sex</th>
                    <th class="text-center">Profile</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($admins as $admin)
                    <tr>
                        <td>{{$admin->id}}</td>
                        <td>{{$admin->first_name}}</td>
                        <td>{{$admin->last_name}}</td>
                        <td>{{$admin->phone}}</td>
                        <td>{{$admin->email}}</td>
                        <td>{{$admin->sex}}</td>
                        <td>
                            <a href="user/user_detail/{{ $admin->id }}">
                                <button class="view-modal btn btn-primary">
                                    <i class="fas fa-address-card"></i>
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="/user/edit_user/{{ $admin->id }}" style="float: left;margin-right: 2px">
                                <button type="submit" class="edit-modal btn btn-info" >
                                    <i class="fas fa-user-edit"></i>
                                </button>
                            </a>
                            @if($admin->id != 1)
                                <form onsubmit="return confirm('Are you sure to delete?')" action="/user/delete_user" method="post" style="float: left">
                                    @csrf
                                    <input type="hidden" name="txt_id" id="txt_id" value="{{ $admin->id }}">
                                    <button type="submit" class="delete-modal btn btn-danger">
                                        <i class="fas fa-user-minus"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

{{--        Trainer table--}}
        <div class="tab-pane fade" id="trainer" role="tabpanel" aria-labelledby="trainer-tab">
            <h1>Trainer</h1>
            <table class="table table-bordered" id="table_trainer">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">First Name</th>
                    <th class="text-center">Last Name</th>
                    <th class="text-center">Phone</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Sex</th>
                    <th class="text-center">Profile</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($trainers as $trainer)
                    <tr>
                        <td>{{$trainer->id}}</td>
                        <td>{{$trainer->first_name}}</td>
                        <td>{{$trainer->last_name}}</td>
                        <td>{{$trainer->phone}}</td>
                        <td>{{$trainer->email}}</td>
                        <td>{{$trainer->sex}}</td>
                        <td>
                            <a href="user/user_detail/{{ $trainer->id }}">
                                <button class="view-modal btn btn-primary">
                                    <i class="fas fa-address-card"></i>
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="/user/edit_user/{{ $trainer->id }}" style="float: left;margin-right: 2px">
                                <button type="submit" class="edit-modal btn btn-info" >
                                    <i class="fas fa-user-edit"></i>
                                </button>
                            </a>
                            <form onsubmit="return confirm('Are you sure to delete?')" action="/user/delete_user" method="post" style="float: left">
                                @csrf
                                <input type="hidden" name="txt_id" id="txt_id" value="{{ $trainer->id }}">
                                <button type="submit" class="delete-modal btn btn-danger">
                                    <i class="fas fa-user-minus"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="trainee" role="tabpanel" aria-labelledby="trainee-tab">
            <h1>Trainee</h1>
            <table class="table" id="table_trainee">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">First Name</th>
                    <th class="text-center">Last Name</th>
                    <th class="text-center">Phone</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Sex</th>
                    <th class="text-center">Profile</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($trainees as $trainee)
                    <tr>
                        <td>{{$trainee->id}}</td>
                        <td>{{$trainee->first_name}}</td>
                        <td>{{$trainee->last_name}}</td>
                        <td>{{$trainee->phone}}</td>
                        <td>{{$trainee->email}}</td>
                        <td>{{$trainee->sex}}</td>
                        <td>
                            <a href="user/trainee_detail/{{ $trainee->id }}">
                                <button class="view-modal btn btn-primary">
                                    <i class="fas fa-address-card"></i>
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="/user/edit_trainee/{{ $trainee->id }}" style="float: left;margin-right: 2px">
                                <button type="submit" class="edit-modal btn btn-info" >
                                    <i class="fas fa-user-edit"></i>
                                </button>
                            </a>
                            <form onsubmit="return confirm('Are you sure to delete?')" action="/user/delete_trainee" method="post" style="float: left">
                                @csrf
                                <input type="hidden" name="txt_id" id="txt_id" value="{{ $trainee->id }}">
                                <button type="submit" class="delete-modal btn btn-danger">
                                    <i class="fas fa-user-minus"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
@section('javascript')
    <script>
        $(document).ready( function () {
            $('#table_admin').DataTable();
            $('#table_trainee').DataTable();
            $('#table_trainer').DataTable();
            $('.edit-modal').click(function () {
                {{--$.ajax({--}}
                {{--    url:"{{ url('userController/save') }}",--}}
                {{--    method:'post',--}}
                {{--    data:{name:1},--}}
                {{--    success:function (data) {--}}
                {{--        alert(data);--}}
                {{--    }--}}
                {{--}); --}}
            });
        });
    </script>
@endsection



