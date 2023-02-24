<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
     */

    'failed' => 'These credentials do not match our records.',
    'password' => 'The provided password is incorrect.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
    'admin' => [
        'login' => [
            'page_title' => 'Welcome Back !',
            'page_description' => 'Sign in to continue to :app_name.',
            'forgot_password_link_text' => 'Forgot password?',
            'form' => [
                'email_label' => 'Email',
                'email_placeholder' => 'Enter email',
                'password_label' => 'Password',
                'password_placeholder' => 'Enter Password',
                'submit_button_text' => 'Sign In',
            ],
        ],
        'forgot_password' => [
            'page_title' => 'Forgot Password?',
            'page_description' => 'Reset password with :app_name.',
            'instructions_alert' => 'Enter your email and instructions will be sent to you!',
            'form' => [
                'email_label' => 'Email',
                'email_placeholder' => 'Enter email',
                'submit_button_text' => 'Send Reset Link',
            ],
            'remember_my_password_text' => 'Wait, I remember my password...',
            'remember_my_password_link_text' => 'Click here',
        ],
        'reset_password' => [
            'page_title' => 'Reset password',
            'page_description' => 'Reset password with :app_name.',
            'form' => [
                'password_label' => 'Password',
                'password_placeholder' => 'Enter Password',
                'confirm_password_label' => 'Confirm Password',
                'confirm_password_placeholder' => 'Enter Confirm Password',
                'submit_button_text' => 'Reset password',
            ],
        ],
    ],
];
