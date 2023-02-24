<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function dashboard(Request $request)
    {
        $breadcums = trans('admin_breadcums.dashboard');
        return view('admin.dashboard', compact('breadcums'));

    }

    public function uploadProfileImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_image' => ['required'],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $result = ['message' => '', 'errors' => $errors, 'status' => false];
            return response()->json($result, 200);
        }

        try {

            $file_path = 'profile_images' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR;
            $user = Admin::find(Auth::user()->id);
            if ($request->hasfile('profile_image')) {
                if (!empty($user->profile_image)) {
                    $this->RemoveFile($user->profile_image);
                }
                $user->profile_image = $this->uploadFile($request->file('profile_image'), $file_path);
            }
            if ($user->save()) {
                $result = ['message' => 'Profile Image Update successfully.', 'status' => true];
                return response()->json($result, 200);
            } else {
                $result = ['message' => 'Oops..something has went wrong. Please try again.', 'status' => false];
                return response()->json($result, 200);
            }
        } catch (\Throwable$e) {
            $result = ['message' => $e->getMessage(), 'status' => false];
            return response()->json($result, 200);
        }
    }

    public function profile(Request $request)
    {
        return view('admin.profile');
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:250', 'string'],
            'email' => ['required', 'max:250', 'string', 'email'],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];
            return response()->json($result, 200);
        }

        try {

            $user = Admin::find(Auth::user()->id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($user->save()) {
                $result = ['message' => 'Profile  Update successfully.', 'status' => true];
                return response()->json($result, 200);
            } else {
                $result = ['message' => 'Oops..something has went wrong. Please try again.', 'status' => false];
                return response()->json($result, 200);
            }
        } catch (\Throwable$e) {
            $result = ['message' => $e->getMessage(), 'status' => false];
            return response()->json($result, 200);
        }
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => ['required', 'max:20', 'string'],
            'new_password' => ['required', 'max:20', 'string'],
            'confirm_password' => ['required', 'max:20', 'string'],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];
            return response()->json($result, 200);
        }

        try {
            $user = Admin::findOrFail(Auth::user()->id);
            if (Hash::check($request->old_password, $user->password)) {
                if ($request->new_password == $request->confirm_password) {
                    $input['password'] = Hash::make($request->new_password);
                    if ($user->update($input)) {
                        $result = ['message' => 'Password Update successfully.', 'status' => true];
                        return response()->json($result, 200);
                    } else {
                        $result = ['message' => 'Oops..something has went wrong. Please try again.', 'status' => false];
                        return response()->json($result, 200);
                    }
                } else {
                    $result = ['message' => 'Confirm Password Doesnot Match.', 'status' => false];
                    return response()->json($result, 200);
                }
            } else {
                $result = ['message' => '', 'errors' => ['old_password' => ['Old Password Does not match.']], 'status' => 'validator_error'];
                return response()->json($result, 200);
            }

        } catch (\Throwable$e) {
            $result = ['message' => $e->getMessage(), 'status' => false];
            return response()->json($result, 200);
        }

    }
}
