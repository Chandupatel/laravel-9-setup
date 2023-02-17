<script src="{{ asset('libs/toastr/toastr.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('libs/toastr/toastr.css') }}" />
<link rel="stylesheet" href="{{ asset('admin/libs/sweetalert2/sweetalert2.min.css') }}" />
<script src="{{ asset('admin/libs/sweetalert2/sweetalert2.min.js') }}"></script>

<style>
    .swal2-popup {
        display: none;
        position: relative;
        box-sizing: border-box;
        grid-template-columns: minmax(0, 100%);
        width: 20em;
        max-width: 100%;
        padding: 0 0 1.25em;
        border: none;
        border-radius: 5px;
        background: #fff;
        color: #545454;
        font-family: inherit;
        font-size: 1rem;
    }
</style>

@if (session('success'))
    <script>
        toastr.success('Success', '{{ session('success') }}', {
            timeOut: 5000
        });
    </script>
@endif
@if (session('error'))
    <script>
        toastr.error("Error", "{{ session('error') }}", {
            timeOut: 5000
        });
    </script>
@endif

@if (session('info'))
    <script>
        toastr.info('{{ session('info') }}', {
            timeOut: 5000
        });
    </script>
@endif

@if (session('warning'))
    <script>
        toastr.warning('{{ session('warning') }}', {
            timeOut: 5000
        });
    </script>
@endif
