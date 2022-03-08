<select class="th-datatable-select form-control" data-column="{{ $col }}">
    <option value="" selected>-- Semua --</option>
    @foreach ($options as $k => $v)
        <option value="{{ $k }}">{{ $v }}
        </option>
    @endforeach
</select>
@push('scripts')
    <script>
        $(document).ready(() => {
            $('.th-datatable-select').on('change', function() {
                let i = $(this).attr('data-column');
                let v = $(this).val();
                $("#{{ $table_id }}").DataTable().columns(i).search(v).draw();
            });
        })
    </script>
@endpush
