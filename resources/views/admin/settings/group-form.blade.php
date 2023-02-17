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
                        <h4 class="card-title mb-0 flex-grow-1">
                            {{ $group_name }}
                        </h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="javascript:void(0);" id="CreateForm">
                        <div class="row">
                            @if ($settings && count($settings) > 0)
                                @foreach ($settings as $item)
                                    @if ($item->input_type == 'text')
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="{{ $item->key }}" class="form-label">{{ $item->label }}
                                                    <span class="text-danger">*</span> </label>
                                                <input type="text" class="form-control" id="{{ $item->key }}"
                                                    placeholder="Enter {{ $item->label }}" name="{{ $item->key }}"
                                                    value="{{ $item->value }}" required>
                                                <span class="text-danger error-span pt-2"
                                                    id="error_{{ $item->key }}"></span>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-primary"
                                        onclick="submitPostForm('#CreateForm','{{ route('admin.settings.store') }}')">Save</button>
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
@endsection
