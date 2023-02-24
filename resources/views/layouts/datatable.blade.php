<div class="card-body">
    <div class="table-card">
        <table class="table align-middle table-nowrap yajra-datatable">
            <thead class="text-muted datatable_head">
                <tr>
                    @if (!empty($dataTableConfig['columns']) && count($dataTableConfig['columns']))
                        @foreach ($dataTableConfig['columns'] as $column)
                            <th class="text-uppercase">
                                {!! $column['name'] !!}
                            </th>
                        @endforeach
                    @endif
                </tr>
            </thead>
            <tbody class="list form-check-all">

            </tbody>
        </table>
    </div>
</div>
