@extends('layouts.admin-auth')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card mt-4">
                <div class="card-body p-4">
                    <div class="text-center mt-2">
                        <h5 class="text-primary">{{ trans('auth.admin.reset_password.page_title') }}</h5>
                        <p class="text-muted">
                            {{ trans('auth.admin.reset_password.page_description', ['app_name' => env('APP_NAME')]) }}</p>
                    </div>
                    <div class="p-2 mt-4">
                        <form action="{{ route('admin.submit-reset-password') }}" method="post">
                            @csrf
                            <input type="hidden"name="token" value="{{ $token }}">
                            <div class="mb-3">
                                <label class="form-label"
                                    for="password-input">{{ trans('auth.admin.reset_password.form.confirm_password_label') }}</label>
                                <div class="position-relative auth-pass-inputgroup mb-3 ">
                                    <input type="password"
                                        class="form-control pe-5 password-input @error('password') is-invalid @enderror"
                                        placeholder="{{ trans('auth.admin.reset_password.form.confirm_password_placeholder') }}"
                                        id="password-input" name="password" required>
                                    <button
                                        class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                        type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i>
                                    </button>
                                </div>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label"
                                    for="password-input">{{ trans('auth.admin.reset_password.form.confirm_password_label') }}</label>
                                <div class="position-relative auth-pass-inputgroup mb-3">
                                    <input type="password"
                                        class="form-control pe-5 password-input @error('password') is-invalid @enderror"
                                        placeholder="{{ trans('auth.admin.reset_password.form.confirm_password_placeholder') }}"
                                        id="password_confirmation" name="password_confirmation" required>
                                    <button
                                        class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                        type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                </div>

                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-4">
                                <button class="btn btn-success w-100"
                                    type="submit">{{ trans('auth.admin.forgot_password.form.submit_button_text') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end card body -->
            </div>
        </div>
    </div>
@endsection
