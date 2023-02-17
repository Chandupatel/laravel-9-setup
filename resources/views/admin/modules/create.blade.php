@extends('layouts.admin')
@section('pagecss')
@endsection
@section('content')
    @include('layouts.admin.breadcums')

    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="invoiceList">
                <div class="card-header border border-dashed border-start-0 border-end-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">
                            <a href="{{ route('admin.modules.index') }}" class="btn btn-primary">
                                <i class="ri-arrow-left-line "></i>
                            </a>
                        </h5>
                    </div>
                </div>
                <div class="card-body">
                    <form action="javascript:void(0);" id="CreateForm">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="parent_module" class="form-label">Parent Module</label>
                                    <select class="form-control  select2" name="parent_module" id="parent_module">
                                        <option value=""> Select Module</option>
                                        @if ($modules && count($modules))
                                            @foreach ($modules as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="text-danger error-span pt-2" id="error_parent_module"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter Name"
                                        name="name" value="" required>
                                    <span class="text-danger error-span pt-2" id="error_label"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="icon" class="form-label">Icon
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="icon" placeholder="Enter Icon"
                                        name="icon" value="" required>
                                    <span class="text-danger error-span pt-2" id="error_icon"></span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="active_cases" class="form-label">Active Cases
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control" id="active_cases" name="active_cases" rows="3" required></textarea>
                                    <span class="text-danger error-span pt-2" id="error_active_cases"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="url" class="form-label">Url
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="url" placeholder="Enter Url"
                                        name="url" value="" required>
                                    <span class="text-danger error-span pt-2" id="error_url"></span>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="url" class="form-label">Url Slug </label>
                                    <input type="text" class="form-control" id="url_slug" placeholder="Enter Url Slug"
                                        name="url_slug" value="">
                                    <span class="text-danger error-span pt-2" id="error_url_slug"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="is_multi_level" class="form-label">is Multi Level
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control  select2" name="is_multi_level" id="is_multi_level"
                                        required>
                                        <option value="">Select Multi Level Status</option>
                                        <option value="1">YES</option>
                                        <option value="0" selected>NO</option>
                                    </select>
                                    <span class="text-danger error-span pt-2" id="error_is_multi_level"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control  select2" name="status" id="status" required>
                                        <option value="">Select Status</option>
                                        <option value="1" selected>Active</option>
                                        <option value="0">In-Active</option>
                                    </select>
                                    <span class="text-danger error-span pt-2" id="error_status"></span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-primary"
                                        onclick="submitPostForm('#CreateForm','{{ route('admin.modules.store') }}')">Save</button>
                                    <a href="{{ route('admin.dashboard') }}" class="btn btn-soft-success">Cancel</a>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div>

        </div>
        <!--end col-->
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function submitPostForm(form_id, form_action_url) {
            callPostAjax(form_action_url, form_id, 0, 1, "{{ route('admin.modules.index') }}");
        }
    </script>
@endsection
