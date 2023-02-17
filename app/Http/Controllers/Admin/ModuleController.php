<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class ModuleController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Module::latest();
            if (!empty($request->name)) {
                $data = $data->where('name', 'LIKE', '%' . $request->name . '%');
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
                ->addColumn('action_checkbox', function ($row) {
                    return '<input class="form-check-input" type="checkbox" id="checkAll"
                    value="option">';
                })
                ->addColumn('action', function ($row) {
                    $actions = [
                        'edit' => route('admin.modules.edit', $row->id),
                        'delete' => route('admin.modules.destroy', $row->id),
                    ];
                    return view('layouts.admin.elements.list_actions', compact('actions'));
                })
                ->rawColumns(['action_checkbox', 'action'])
                ->make(true);
        } else {
            $breadcums = config('admin_breadcums.modules.index');
            $dataTableConfig = config('admin_datatables_constants.modules');
            $dataTableConfig['url'] = route('admin.modules.index');
            return view('admin.modules.index', compact('breadcums', 'dataTableConfig'));
        }
    }

    public function create()
    {
        $breadcums = config('admin_breadcums.modules.create');
        $modules = Module::where('parent_id', 0)->get();
        return view('admin.modules.create', compact('breadcums', 'modules'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:modules', 'max:250'],
            'active_cases' => ['required', 'string'],
            'icon' => ['required', 'string', 'max:250'],
            'is_multi_level' => ['required', 'numeric'],
            'url' => ['required', 'string', 'max:250'],
            'status' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];
            return response()->json($result, 200);
        }
        try {

            $obj = new Module;
            if (!empty($request->parent_module)) {
                $obj->parent_id = $request->parent_module;
            }
            $obj->name = $request->name;
            $obj->active_cases = $request->active_cases;
            $obj->icon = $request->icon;
            $obj->is_multi_level = $request->is_multi_level;
            $obj->url = $request->url;
            if (!empty($request->url_slug)) {
                $obj->url_slug = $request->url_slug;
            }
            $obj->status = $request->status;
            if ($obj->save()) {
                \Session::flash('success', trans("Module Created successfully."));
                $result = ['message' => 'Module Created successfully.', 'status' => true];
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $breadcums = config('admin_breadcums.modules.edit');
        $obj = Module::find($id);
        if ($obj) {
            $modules = Module::where('parent_id', 0)->get();
            return view('admin.modules.edit', compact('breadcums', 'obj', 'modules'));
        } else {
            return redirect()->back()->with('error', 'Oops..something has went wrong. Please try again.');
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', Rule::unique('modules', 'name')->ignore($id), 'max:250'],
            'active_cases' => ['required', 'string'],
            'icon' => ['required', 'string', 'max:250'],
            'is_multi_level' => ['required', 'numeric'],
            'url' => ['required', 'string', 'max:250'],
            'status' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];
            return response()->json($result, 200);
        }

        try {

            $obj = Module::find($id);
            if (!empty($request->parent_module)) {
                $obj->parent_id = $request->parent_module;
            }
            $obj->name = $request->name;
            $obj->active_cases = $request->active_cases;
            $obj->icon = $request->icon;
            $obj->is_multi_level = $request->is_multi_level;
            $obj->url = $request->url;
            if (!empty($request->url_slug)) {
                $obj->url_slug = $request->url_slug;
            }
            $obj->status = $request->status;
            if ($obj->save()) {
                \Session::flash('success', trans("Module Updated successfully."));
                $result = ['message' => 'Module Updated successfully.', 'status' => true];
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
            $obj = Module::find($id);
            if ($obj) {
                if ($obj->delete()) {
                    $result = ['message' => "Module Deleted Successfully", 'data' => [], 'status' => true];
                    return response($result, 200);
                } else {
                    $result = ['message' => 'Oops..something has went wrong. Please try again.', 'data' => [], 'status' => false];
                    return response($result, 200);
                }
            } else {
                $result = ['message' => "Module Data Not Found...", 'data' => [], 'status' => false];
                return response($result, 200);
            }
        } catch (\Throwable$e) {
            $result = ['message' => $e->getMessage(), 'status' => false];
            return response($result, 200);
        }
    }
}
