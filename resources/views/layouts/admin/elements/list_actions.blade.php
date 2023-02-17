@if (!empty($actions['action_checkbox']))
    <input class="form-check-input" type="checkbox" id="checkAll" value="option">
@endif

@if (!empty($actions['edit']))
    <a href="{{ $actions['edit'] }}" class="btn btn-outline-primary waves-effect waves-light btn-sm">
        <i class="ri-edit-box-line"></i>
    </a>
@endif

@if (!empty($actions['delete']))
    <button type="button" class="btn btn-outline-danger waves-effect waves-light btn-sm row-delete-button"
        delete-url="{{ $actions['delete'] }}">
        <i class="ri-delete-bin-line"></i>
    </button>
@endif
