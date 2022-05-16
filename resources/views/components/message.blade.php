@props(['status'])

@if (session()->has($status))
    <style>
        .swal-modal {
            position: absolute;
            right: 20px;
            top: 10px;
        }

    </style>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        swal({
            icon: 'success',
            title: '{{ session($status) }}',
            button: false,
            timer: 1000
        })
    </script>
@endif
