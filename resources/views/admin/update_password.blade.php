@extends('admin.layouts.app')

@section('title')
    Change password
@endsection

@section('content')
    <div class="container-scroller d-flex">
{{--        <div class="container-fluid page-body-wrapper full-page-wrapper d-flex">--}}
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-6 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
{{--                            <div class="brand-logo">--}}
{{--                                <img src="{{asset('public/admin/images/logo.svg')}}" alt="logo">--}}
{{--                            </div>--}}
                            <h4>Wana! change password</h4>
                            @include('admin.layouts.alerts')
                            <h6 class="font-weight-light">Change login password</h6>
                            <form class="pt-3" action="{{ route('update_password') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="exampleInputCurrentPassword" name="current_password" placeholder="Current password">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="exampleInputNewPassword" name="new_password" placeholder="New Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="exampleInputConfirmPassword" name="confirm_password" placeholder="Confirm Password">
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" ><h4>Change</h4></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
{{--        </div>--}}
        <!-- page-body-wrapper ends -->
    </div>
@endsection
