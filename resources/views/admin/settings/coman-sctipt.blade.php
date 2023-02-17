<script src="{{ asset('admin/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
<script type="text/javascript">
    $('#input_type').on('select2:select', function(e) {
        var input_type = e.params.data.element.value;
        if (input_type) {
            if (input_type == 'select' || input_type == 'radio') {
                $("#input_options").prop('required', true);
                $('#input_options_section').show();
                $("#input_value").prop('required', false);
                $('#input_value_section').hide();
            } else {
                $("#input_options").prop('required', false);
                $('#input_options_section').hide();

                $("#input_value").prop('required', true);
                $('#input_value_section').show();
            }
        } else {
            $("#input_options").prop('required', false);
            $('#input_options_section').hide();

            $("#input_value").prop('required', true);
            $('#input_value_section').show();
        }
    });
    $(document).on('change', '#key', function() {
        if ($(this).val()) {
            var key_valye = $(this).val().replace(" ", "_");
            $(this).val(key_valye.toUpperCase());
        }
    })

    function submitPostForm(form_id, form_action_url) {
        callPostAjax(form_action_url, form_id, 0, 1, "{{ route('admin.settings.index') }}");
    }
</script>
