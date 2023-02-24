<?php
return [
    'settings' => [
        'url' => '',
        'search_form_id' => '#searchForm',
        'columns' => [
            [
                'data' => 'action_checkbox',
                'name' => '<div class="form-check">
                    <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                    </div>',
                'orderable' => false,
                'searchable' => false,
            ],
            [
                'data' => 'DT_RowIndex',
                'name' => '#',
                'orderable' => true,
                'searchable' => false,
            ],
            [
                'data' => 'group',
                'name' => 'Group',
                'orderable' => true,
                'searchable' => true,
            ],
            [
                'data' => 'label',
                'name' => 'Label',
                'orderable' => true,
                'searchable' => true,
            ],
            [
                'data' => 'value',
                'name' => 'Value',
                'orderable' => true,
                'searchable' => true,
            ],
            [
                'data' => 'input_type',
                'name' => 'Input Type',
                'orderable' => true,
                'searchable' => true,
            ],
            [
                'data' => 'status',
                'name' => 'Status',
                'orderable' => true,
                'searchable' => true,
            ],
            [
                'data' => 'date',
                'name' => 'Date',
                'orderable' => true,
                'searchable' => true,
            ],
            [
                'data' => 'action',
                'name' => 'Action',
                'orderable' => false,
                'searchable' => false,
            ],
        ],
    ],
    'modules' => [
        'url' => '',
        'search_form_id' => '#searchForm',
        'columns' => [
            [
                'data' => 'action_checkbox',
                'name' => '<div class="form-check">
                <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                </div>',
                'orderable' => false,
                'searchable' => false,
            ],
            [
                'data' => 'DT_RowIndex',
                'name' => '#',
                'orderable' => true,
                'searchable' => false,
            ],
            [
                'data' => 'name',
                'name' => 'Name',
                'orderable' => true,
                'searchable' => true,
            ],
            [
                'data' => 'status',
                'name' => 'Status',
                'orderable' => true,
                'searchable' => true,
            ],
            [
                'data' => 'action',
                'name' => 'Action',
                'orderable' => false,
                'searchable' => false,
            ],
        ],
    ],
];
