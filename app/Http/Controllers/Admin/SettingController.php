<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Setting::latest();
            if (!empty($request->group)) {
                $data = $data->where('group', 'LIKE', '%' . $request->group . '%');
            }
            if (!empty($request->lable)) {
                $data = $data->where('label', 'LIKE', '%' . $request->lable . '%');
            }
            if (!empty($request->value)) {
                $data = $data->where('value', 'LIKE', '%' . $request->value . '%');
            }

            if (!empty($request->status)) {
                $status = $request->status == 'Active' ? 1 : 0;
                $data = $data->where('status', $status);
            }
            $data = $data->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    return $row->status == 1 ? 'Active' : 'In-Active';
                })
                ->editColumn('date', function ($row) {
                    return date('d-m-Y', strtotime($row->created_at));
                })
                ->addColumn('action_checkbox', function ($row) {
                    $actions = [
                        'action_checkbox' => 1,
                    ];
                    return view('layouts.admin.elements.list_actions', compact('actions'));
                })
                ->addColumn('action', function ($row) {
                    $actions = [
                        'edit' => route('admin.settings.edit', $row->id),
                        'delete' => route('admin.settings.destroy', $row->id),
                    ];
                    return view('layouts.admin.elements.list_actions', compact('actions'));
                })
                ->rawColumns(['action_checkbox', 'action'])
                ->make(true);
        } else {
            $breadcums = trans('admin_breadcums.settings.index');
            $dataTableConfig = trans('admin_datatables_constants.settings');
            $dataTableConfig['url'] = route('admin.settings.index');
            return view('admin.settings.index', compact('breadcums', 'dataTableConfig'));
        }

    }

    public function settingsGroup($group)
    {

        $settings = Setting::where('group', $group)->get();
        if ($settings && count($settings) > 0) {
            $group_name = ucwords(str_replace('-', ' ', $group));
            $breadcums = config('admin_breadcums.settings.group');
            $breadcums['breadcums'][2]['name'] = $group_name;
            return view('admin.settings.group-form', compact('breadcums', 'settings', 'group_name'));
        } else {
            return redirect()->back()->with('error', 'Oops..something has went wrong. Please try again.');
        }
    }

    public function create(Request $request)
    {

        $breadcums = trans('admin_breadcums.settings.create');
        $groups = SETTING_GROUPS;
        $input_types = SETTING_INPUT_TYPES;
        return view('admin.settings.create', compact('breadcums', 'groups', 'input_types'));
    }

    public function store(Request $request)
    {

        $validation = [
            'group' => ['required', 'string', 'max:250'],
            'label' => ['required', 'string', 'max:250'],
            'key' => ['required', 'string', 'unique:settings', 'max:250'],
            'input_type' => ['required', 'string', 'max:250'],
            'status' => ['required', 'numeric'],
        ];

        if ($request->input_type == 'select' || $request->input_type == 'radio') {
            $validation['input_options'] = ['required', 'string'];
        } else {
            $validation['value'] = ['required', 'string', 'max:250'];
        }

        $validator = Validator::make($request->all(), $validation);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];
            return response()->json($result, 200);
        }

        try {

            $obj = new Setting;
            $obj->group = $request->group;
            $obj->label = $request->label;
            $obj->key = $request->key;
            $obj->value = $request->value;
            $obj->input_type = $request->input_type;
            if (!empty($request->input_options)) {
                $obj->input_options = $request->input_options;
            }
            $obj->status = $request->status;
            if ($obj->save()) {
                \Session::flash('success', trans("Setting Created successfully."));
                $result = ['message' => 'Setting Created successfully.', 'status' => true];
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

    public function edit($id)
    {
        $breadcums = trans('admin_breadcums.settings.edit');
        $obj = Setting::find($id);
        if ($obj) {
            $groups = SETTING_GROUPS;
            $input_types = SETTING_INPUT_TYPES;
            return view('admin.settings.edit', compact('breadcums', 'obj', 'groups', 'input_types'));
        } else {
            return redirect()->back()->with('error', 'Oops..something has went wrong. Please try again.');
        }

    }

    public function update(Request $request, $id)
    {
        $validation = [
            'group' => ['required', 'string', 'max:250'],
            'label' => ['required', 'string', 'max:250'],
            'input_type' => ['required', 'string', 'max:250'],
            'status' => ['required', 'numeric'],
        ];

        if ($request->input_type == 'select' || $request->input_type == 'radio') {
            $validation['input_options'] = ['required', 'string'];
        } else {
            $validation['value'] = ['required', 'string', 'max:250'];
        }

        $validator = Validator::make($request->all(), $validation);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];
            return response()->json($result, 200);
        }

        try {

            $obj = Setting::find($id);
            $obj->group = $request->group;
            $obj->label = $request->label;
            $obj->value = $request->value;
            $obj->input_type = $request->input_type;
            if (!empty($request->input_options)) {
                $obj->input_options = $request->input_options;
            }
            $obj->status = $request->status;
            if ($obj->save()) {
                \Session::flash('success', trans("Setting Updated successfully."));
                $result = ['message' => 'Setting Updated successfully.', 'status' => true];
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

    public function destroy($id)
    {
        try {
            $obj = Setting::find($id);
            if ($obj) {
                if ($obj->delete()) {
                    $result = ['message' => "Setting Deleted Successfully", 'data' => [], 'status' => true];
                    return response($result, 200);
                } else {
                    $result = ['message' => 'Oops..something has went wrong. Please try again.', 'data' => [], 'status' => false];
                    return response($result, 200);
                }
            } else {
                $result = ['message' => "Setting Data Not Found...", 'data' => [], 'status' => false];
                return response($result, 200);
            }
        } catch (\Throwable$e) {
            $result = ['message' => $e->getMessage(), 'status' => false];
            return response($result, 200);
        }
    }
}
