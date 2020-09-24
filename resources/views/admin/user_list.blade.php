@extends('admin.layouts.app')

@section('title')
    User List
@endsection

@section('content')
    <div class="row p-2">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body ">
                    <div class="text-center border-bottom">
                    <h3 class="">User Management</h3>
                        @include('admin.layouts.alerts')
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped border">
                            <thead>
                            <tr>
                                <th>
                                    S.no
                                </th>
                                <th>
                                    User Name
                                </th>
                                <th>
                                    User Email
                                </th>
                                <th>
                                    User Phone
                                </th>
                                <th>
                                    User Image
                                </th>

                                <th>
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(sizeof($user_list) > 0)
                                @foreach( $user_list as $key => $user)
                            <tr id="row_{{$key}}">
                                <td class="py-1">
                                   {{ $key+1 }}
                                </td>
                                <td>
                                    {{ ucfirst($user->user_name )}}
                                </td>
                                <td>
                                    {{ $user->user_email }}
                                </td>
                                <td>
                                    {{ $user->user_phone }}
                                </td>
                                <td >
                                    @if($user->user_image === null) <img src="{{asset('public/admin/images/faces/face1.jpg')}}" alt="image"/>
                                    @else <img src="{{ $user->user_image }}" alt="image"/> @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-rounded btn-inverse-primary btn-sm" onclick="RunPwdFunction({{$user->user_id}})" data-toggle="tooltip" title="Update Password"><i class="mdi mdi-account-key menu-icon"></i>
                                    </button>
                                </td>
                            </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>
                                        No, User found
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="updatePwdModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('update_user_password') }}" method="post" >
                    @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row m-3">
                        <label for="exampleInputPassword2" class="col-sm-4 col-form-label">New Password</label>
                        <div class="col-sm-8">
                            <input type="hidden" id="user_id" name="user_id" >
                            <input type="text" class="form-control" id="exampleInputPassword2" name="new_password" placeholder="Enter new password">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-rounded btn-outline-primary">Change</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        function RunPwdFunction(user_id){
            $('#user_id').val(user_id)
            $('#updatePwdModal').modal('show')
        }
    </script>
@endsection

