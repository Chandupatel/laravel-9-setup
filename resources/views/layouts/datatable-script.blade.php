<script src="{{ asset('admin/libs/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/libs/datatables/dataTables.bootstrap5.min.js') }}"></script>

<script type="text/javascript">
    var dataTableConfig = @json($dataTableConfig);
    var dataTable = $('.yajra-datatable').DataTable({
        processing: false,
        serverSide: true,
        searching: false,
        lengthMenu: [25, 50, 75, 100],
        language: {
            "emptyTable": '<div class="noresult"><div class="text-center"><lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon><h5 class="mt-2">Sorry! No Result Found</h5></div>'
        },
        ajax: {
            url: dataTableConfig.url,
            type: 'GET',
            data: function(d) {
                $(dataTableConfig.search_form_id).find('.form-control').each(function() {
                    d[$(this).attr('name')] = $(this).val();
                })
            },
            beforeSend: function() {
                $("#preloader").show();
            },
            complete: function(response) {
                $('#preloader').hide();
            }
        },
        columns: dataTableConfig.columns
    });
    $(dataTableConfig.search_form_id).on('submit', function(e) {
        e.preventDefault();
        dataTable.draw();
    });

    function clearFilters(search_form_id) {
        $(search_form_id).trigger("reset");
        dataTable.draw();
    }
</script>
