@if ($errors->any())
    <script>
        Toast.error('{{ $errors->first() }}')
    </script>
@endif
@if (session()->get('alert'))
    <script>
        Toast.{{ session()->get('alert-icon') }}('{{ session()->get('alert-title') }}',
            '{{ session()->get('alert-text') }}')
    </script>
@endif
