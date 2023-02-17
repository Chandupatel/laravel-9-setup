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
                            <a href="{{ route('admin.settings.create') }}" class="btn btn-danger">
                                <i class="ri-add-line align-bottom me-1"></i> Create Setting
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-soft-light border border-dashed border-start-0 border-end-0">
                    <form id="searchForm">
                        <div class="row g-3">
                            <div class="col-xxl-3 col-sm-3">
                                <select class="form-control bg-light border-light" name="group" id="group">
                                    <option value="">All Groups</option>
                                    <option value="company-details">Company Details</option>
                                    <option value="social-media">Social Media</option>
                                    <option value="smtp-details">SMTP Details</option>
                                </select>
                            </div>
                            <div class="col-xxl-3 col-sm-3">
                                <input type="text" class="form-control search bg-light border-light" placeholder="Lable "
                                    name="lable">
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-sm-3">
                                <input type="text" class="form-control bg-light border-light" name="value"
                                    placeholder="Value">
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-sm-3">
                                <select class="form-control bg-light border-light" name="status">
                                    <option value="">All Status</option>
                                    <option value="Active">Active</option>
                                    <option value="In-Active">In-Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-xxl-12 col-sm-12 text-end">
                                <button type="submit" class="btn btn-primary ">
                                    <i class="ri-filter-line me-1 align-bottom"></i> Filters
                                </button>

                                <button type="button" class="btn btn-dark"
                                    onclick="clearFilters('{{ $dataTableConfig['search_form_id'] }}')">
                                    <i class="ri-format-clear me-1 align-bottom"></i> Clear Filters
                                </button>
                            </div>
                        </div>
                        <!--end row-->
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-card">
                        <table class="table align-middle table-nowrap yajra-datatable">
                            <thead class="text-muted datatable_head">
                                <tr>
                                    <th scope="col" style="width: 50px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                        </div>
                                    </th>
                                    <th class="text-uppercase">#</th>
                                    <th class="text-uppercase">
                                        group
                                    </th>
                                    <th class="text-uppercase">label</th>
                                    <th class="text-uppercase">value</th>
                                    <th class="text-uppercase">input type</th>
                                    <th class="text-uppercase">Status</th>
                                    <th class="text-uppercase">Date</th>
                                    <th class="text-uppercase">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!--end col-->
    </div>
@endsection
@section('scripts')
    @include('layouts.datatable-script')
@endsection
