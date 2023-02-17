@extends('layouts.admin-auth')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card mt-4">
                <div class="card-body p-4">
                    <div class="text-center mt-2">
                        <h5 class="text-primary">{{ trans('auth.admin.forgot_password.page_title') }}</h5>
                        <p class="text-muted">
                            {{ trans('auth.admin.forgot_password.page_description', ['app_name' => env('APP_NAME')]) }}</p>

                        <lord-icon src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop" colors="primary:#0ab39c"
                            class="avatar-xl">
                        </lord-icon>
                    </div>

                    <div class="alert alert-borderless alert-warning text-center mb-2 mx-2" role="alert">
                        {{ trans('auth.admin.forgot_password.instructions_alert') }}
                    </div>
                    <div class="p-2">
                        <form action="{{ route('admin.forgot-password') }}" method="post">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label">{{ trans('auth.admin.forgot_password.form.email_label') }}</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email"
                                    placeholder="{{ trans('auth.admin.forgot_password.form.email_placeholder') }}"
                                    name="email" required>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="text-center mt-4">
                                <button class="btn btn-success w-100"
                                    type="submit">{{ trans('auth.admin.forgot_password.form.submit_button_text') }}</button>
                            </div>
                        </form><!-- end form -->
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
            <div class="mt-4 text-center">
                <p class="mb-0">{{ trans('auth.admin.forgot_password.remember_my_password_text') }}
                    <a href="{{ route('admin.login') }}" class="fw-semibold text-primary text-decoration-underline">
                        {{ trans('auth.admin.forgot_password.remember_my_password_link_text') }}
                    </a>
                </p>
            </div>
        </div>
    </div>
@endsection
