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
                                    {!! Form::label('parent_module', trans('admin.modules.form.parent_module_label')) !!}
                                    {!! Form::select('status', [null => trans('admin.modules.form.parent_module_placeholder')] + $modules, '', [
                                        'class' => 'form-control  select2',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_parent_module"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('name', trans('admin.modules.form.name_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('name', '', [
                                        'class' => 'form-control',
                                        'id' => 'name',
                                        'placeholder' => trans('admin.modules.form.name_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_name"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('icon', trans('admin.modules.form.icon_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('icon', '', [
                                        'class' => 'form-control',
                                        'id' => 'icon',
                                        'placeholder' => trans('admin.modules.form.icon_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_icon"></span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    {!! Form::label('active_cases', trans('admin.modules.form.active_cases_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::textarea('active_cases', '', [
                                        'class' => 'form-control',
                                        'id' => 'active_cases',
                                        'placeholder' => trans('admin.modules.form.active_cases_placeholder'),
                                        'rows' => '3',
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_active_cases"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('url', trans('admin.modules.form.url_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('url', '', [
                                        'class' => 'form-control',
                                        'id' => 'url',
                                        'placeholder' => trans('admin.modules.form.url_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_url"></span>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('url_slug', trans('admin.modules.form.url_slug_label')) !!}
                                    {!! Form::text('url_slug', '', [
                                        'class' => 'form-control',
                                        'id' => 'url_slug',
                                        'placeholder' => trans('admin.modules.form.url_placeholder'),
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_url_slug"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">

                                    {!! Form::label('parent_module', trans('admin.modules.form.is_multi_level_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::select(
                                        'is_multi_level',
                                        ['' => trans('admin.modules.form.is_multi_level_placeholder')] + [0 => 'NO', 1 => 'YES'],
                                        '',
                                        ['class' => 'form-control  select2', 'id' => 'is_multi_level', 'required'],
                                    ) !!}
                                    <span class="text-danger error-span pt-2" id="error_is_multi_level"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('status', trans('admin.modules.form.status_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::select('status', [null => trans('admin.modules.form.status_placeholder')] + FOEM_STATUS, '1', [
                                        'class' => 'form-control  select2',
                                    ]) !!}
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
