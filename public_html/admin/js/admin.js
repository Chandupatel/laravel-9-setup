$(".select2").select2();

function checkRequiredValidation(form_id) {
    var is_invalid_input = 0;
    $('.error-span').text('');
    $('.form-control').removeClass('is-invalid');
    $(form_id).find('.form-control').each(function () {
        var required_attr = $(this).attr('required');
        if (typeof required_attr !== typeof undefined && required_attr !== false) {
            if (!$(this).val()) {
                is_invalid_input = 1
                var input_name = $(this).attr('name');
                input_name = input_name.replace("_", " ");
                // input_name = input_name.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                //     return letter.toUpperCase();
                // });
                $(this).addClass('is-invalid');
                $('#error_' + $(this).attr('name')).text('The ' + input_name + ' field is required.');
            }
        }
    })
    if (is_invalid_input == 1) {
        return false;
    } else {
        return true;
    }
}

function callPostAjax(url, form_id, reload_page, succrss_redirect = 0, succrss_redirect_url = '') {
    if (checkRequiredValidation(form_id)) {
        $(".form-control").removeClass("is-invalid");
        $('.error-span').text('');
        $.ajax({
            url: url,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            method: 'post',
            data: new FormData($(form_id)[0]),
            beforeSend: function () {
                $("#preloader").show();
            },
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#preloader').hide();
                if (response.status == true) {
                    $(form_id).trigger("reset");
                    if (succrss_redirect == 1) {
                        window.location.href = succrss_redirect_url;
                    } else if (reload_page == 1) {
                        toastr.success('Success', response.message, {
                            timeOut: 5000
                        });
                        window.location.reload();
                    } else {
                        toastr.success('Success', response.message, {
                            timeOut: 5000
                        });
                    }
                } else if (response.status == 'validator_error') {
                    $.each(response.errors, function (index, html) {
                        $(form_id).find('input[name="' + index + '"]').addClass(
                            'is-invalid');
                        $('#error_' + index).text(html);
                    });
                } else {
                    toastr.error('Error', response.message, {
                        timeOut: 5000
                    });
                }
            }
        });
    }
}

$(document).on('click', '.row-delete-button', function (event) {
    var delete_url = $(this).attr('delete-url');
    event.preventDefault();
    Swal.fire({
        icon: 'warning',
        title: "Are You Sure You Want To Delete This",
        showCancelButton: true,
        confirmButtonColor: '#ff0a36',
        confirmButtonText: `Yes, delete it!`,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: delete_url,
                type: "delete",
                cache: false,
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (data) {
                    if (data.status == true) {
                        toastr.success('Success', data.message, {
                            timeOut: 5000
                        });
                        window.location.reload();
                    } else {
                        toastr.error('Error', data.messageS, {
                            timeOut: 5000
                        });
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    toastr.error('Error', errorThrown, {
                        timeOut: 5000
                    });
                }
            });
        }
    });
});