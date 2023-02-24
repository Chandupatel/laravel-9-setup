@extends('layouts.admin')
@section('pagecss')
    <link href="{{ asset('admin/libs/datatables/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    @include('layouts.admin.breadcums')
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="invoiceList">
                <div class="card-header border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">
                            <button type="button" class="btn btn-primary">
                                <i class="ri-arrow-left-line "></i>
                            </button>
                        </h5>
                        <div class="flex-shrink-0">
                            <a href="{{ route('admin.modules.create') }}" class="btn btn-danger">
                                <i class="ri-add-line align-bottom me-1"></i>{{ trans('admin.modules.create_button_text') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-soft-light border border-dashed border-start-0 border-end-0">
                    <form id="searchForm">
                        <div class="row g-3">
                            <div class="col-xxl-3 col-sm-3">
                                {!! Form::text('name', '', [
                                    'class' => 'form-control search bg-light border-light',
                                    'placeholder' => 'Name',
                                ]) !!}
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-sm-3">
                                {!! Form::select('status', [null => trans('admin.common.search_select_option_all')] + SEARCH_STATUS, '', [
                                    'class' => 'form-control bg-light border-light',
                                ]) !!}
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-xxl-12 col-sm-12 text-end">
                                <button type="submit" class="btn btn-primary ">
                                    <i class="ri-filter-line me-1 align-bottom"></i>
                                    {{ trans('admin.common.search_button_filter_text') }}
                                </button>

                                <button type="button" class="btn btn-dark"
                                    onclick="clearFilters('{{ $dataTableConfig['search_form_id'] }}')">
                                    <i class="ri-format-clear me-1 align-bottom"></i>
                                    {{ trans('admin.common.search_clear_filter_text') }}
                                </button>
                            </div>
                        </div>
                        <!--end row-->
                    </form>
                </div>
                @include('layouts.datatable')
            </div>

        </div>
        <!--end col-->
    </div>
@endsection
@section('scripts')
    @include('layouts.datatable-script')
@endsection
