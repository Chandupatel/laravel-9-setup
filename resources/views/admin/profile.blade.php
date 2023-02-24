@extends('layouts.admin')
@section('content')
    <div class="position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg profile-setting-img">
            <img src="{{ asset('admin/images/profile-bg.jpg') }}" class="profile-wid-img" alt="">
        </div>
    </div>
    <div class="row">
        <div class="col-xxl-3">
            <div class="card mt-n5">
                <div class="card-body p-4">
                    <div class="text-center">
                        <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                            <img src="{{ Auth::user()->profile_image }}"
                                class="rounded-circle avatar-xl img-thumbnail user-profile-image" alt="user-profile-image">
                            <form action="" method="post" id="profileImageForm">
                                <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                    <input id="profile-img-file-input" name="profile_image" type="file"
                                        class="profile-img-file-input" accept="image/png, image/gif, image/jpeg">
                                    <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                        <span class="avatar-title rounded-circle bg-light text-body">
                                            <i class="ri-camera-fill"></i>
                                        </span>
                                    </label>
                                </div>
                            </form>
                        </div>
                        <h5 class="fs-16 mb-1">{{ Auth::user()->name }}</h5>
                        <p class="text-muted mb-0">Super Admin</p>
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
        <div class="col-xxl-9">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                <i class="fas fa-home"></i> Personal Details
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                <i class="far fa-user"></i> Change Password
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                            <form action="javascript:void(0);" id="profileForm">
                                <div class="row">
                                    <div class="col-lg-6">
                                        {{ Form::label('name', 'Name') }}
                                        {!! Form::text('name', Auth::user()->name, [
                                            'class' => 'form-control',
                                            'id' => 'name',
                                            'placeholder' => 'Enter your Name',
                                            'required',
                                        ]) !!}
                                        <span class="text-danger error-span pt-2" id="error_name"></span>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        {{ Form::label('emailInput', 'Email Address') }}
                                        {!! Form::text('email', Auth::user()->email, [
                                            'class' => 'form-control',
                                            'id' => 'emailInput',
                                            'placeholder' => 'Enter Email Address',
                                            'required',
                                        ]) !!}
                                        <span class="text-danger error-span pt-2" id="error_email"></span>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12 mt-2">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="button" class="btn btn-primary"
                                                onclick="updateProfile()">Updates</button>
                                            <a href="{{ route('admin.dashboard') }}" class="btn btn-soft-success">Cancel</a>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane" id="changePassword" role="tabpanel">
                            <form action="javascript:void(0);" id="changePasswordForm">
                                <div class="row g-2">
                                    <div class="col-lg-4">
                                        {{ Form::label('oldpasswordInput', 'Old Password*') }}
                                        {!! Form::password('old_password', [
                                            'class' => 'form-control',
                                            'id' => 'oldpasswordInput',
                                            'placeholder' => 'Enter current password',
                                            'required',
                                        ]) !!}
                                        <span class="text-danger error-span pt-2" id="error_old_password"></span>
                                    </div>
                                    <div class="col-lg-4">
                                        {{ Form::label('newpasswordInput', 'New Password*') }}
                                        {!! Form::password('new_password', [
                                            'class' => 'form-control',
                                            'id' => 'newpasswordInput',
                                            'placeholder' => 'Enter new password',
                                            'required',
                                        ]) !!}
                                        <span class="text-danger error-span pt-2" id="error_new_password"></span>
                                    </div>

                                    <div class="col-lg-4">
                                        {{ Form::label('confirmpasswordInput', 'New Password*') }}
                                        {!! Form::password('confirm_password', [
                                            'class' => 'form-control',
                                            'id' => 'confirmpasswordInput',
                                            'placeholder' => 'Confirm password',
                                            'required',
                                        ]) !!}
                                        <span class="text-danger error-span pt-2" id="error_confirm_password"></span>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-success" onclick="changePassword()">Change
                                                Password</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <!--end tab-pane-->
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).on('change', '#profile-img-file-input', function(event) {
            callPostAjax("{{ route('admin.upload-profile-image') }}", "#profileImageForm", 1);
        });

        function updateProfile() {
            callPostAjax("{{ route('admin.profile') }}", "#profileForm", 1);
        }

        function changePassword() {
            callPostAjax("{{ route('admin.update-password') }}", "#changePasswordForm", 0);
        }
    </script>
@endsection
