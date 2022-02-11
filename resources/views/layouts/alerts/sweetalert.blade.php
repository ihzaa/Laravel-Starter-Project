@if (session()->get('alert'))
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            'icon': "{{ session()->get('alert-icon') }}",
            'title': "{{ session()->get('alert-title') }}",
            'text': "{{ session()->get('alert-text') }}",
        })
    </script>
@endif
