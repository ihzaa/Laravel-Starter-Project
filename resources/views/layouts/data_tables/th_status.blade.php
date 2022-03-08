<select class="form-control" id="th-status">
    <option value="1" selected>Aktif ({{ $model::count() }})</option>
    <option value="0">Dihapus ({{ $model::onlyTrashed()->count() }})</option>
</select>
@push('scripts')
    <script>
        $(document).ready(() => {
            $("#th-status").change(function() {
                let url = "";
                if ($(this).val() == "1") {
                    url = "{!! url()->full() !!}?deleted=deleted"
                } else {
                    url = "{!! url()->full() !!}"
                }
                $("#{{ $table_id }}").DataTable().ajax.url(url).load().draw()
            }).trigger("change")
        })
    </script>
@endpush
