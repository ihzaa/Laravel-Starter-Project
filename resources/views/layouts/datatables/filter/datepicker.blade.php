<div class="input-group">
    <input name="{{ $name }}" class="form-control datatable-filter datatable-filter-date-picker"
        placeholder="{{ isset($placeholder) ? $placeholder : 'cari...' }}" autocomplete="off"
        data-date-format="{{ isset($date_format) ? $date_format : 'dd-mm-yyyy' }}">
</div>
@once
    @push('styles')
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
            integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endpush
@endonce
@once
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
            integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $(document).ready(() => {
                let timer;
                $('.datatable-filter-date-picker').on('change', function() {
                    let tableId = "#{{ isset($table_id) ? $table_id : '' }}";
                    if (tableId == '#') {
                        tableId = "#main-table"
                    }
                    $(tableId).DataTable().draw();
                });
                $('.datatable-filter-date-picker').datepicker({
                    autoclose: true,
                    todayHighlight: true
                });
            })
        </script>
    @endpush
@endonce
