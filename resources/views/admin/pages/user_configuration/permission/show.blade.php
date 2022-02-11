@extends('layouts.master')

@section('page_title', 'Perizinan')

@section('breadcrumb')
    @php
    $breadcrumbs = ['Pengaturan User', ['Perizinan', route('admin.user_config.permission.index')], 'Lihat'];
    @endphp
    @include('layouts.parts.breadcrumb',['breadcrumbs'=>$breadcrumbs])
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.1.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="{{ route('admin.user_config.permission.update', [$data['role']->id]) }}" method="POST">
                    <div class="card-header">
                        Perizinan <strong>{{ $data['role']->name }}</strong>
                        <div class="card-tools">

                        </div>
                        <!-- /.card-tools -->
                    </div>
                    @csrf
                    <div class="card-body">
                        <div class="form-group mb-2">
                            <label for="name">Nama Peran <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" placeholder="Nama Peran" name="name"
                                value="{{ $data['role']->name }}">
                        </div>
                        <hr>
                        <?php $permissions = $data['role']
                            ->getAllPermissions()
                            ->pluck('name')
                            ->toArray(); ?>

                        <table class="table table-bordered table-hover">
                            <tbody>

                                <tr class="bg-gray-50">
                                    <th colspan="4" class="text-right">
                                        Select/Unselect Section
                                        <div class="checkbox c-checkbox" style="display: inline-block; margin: 0 5px;">
                                            <label>
                                                <input type="checkbox" class="toggle-section" data-section="specials" />

                                            </label>
                                        </div>
                                    </th>
                                </tr>

                                <tr class="bg-gray-50">
                                    <th>#</th>
                                    <th>Permission</th>
                                    <th>Deskripsi</th>
                                    <th class="text-center">Enable</th>
                                </tr>

                                <?php $index = 0; ?>
                                @foreach (\App\Utils\PermissionHelper::SPECIAL_PERMISSIONS as $perm => $description)

                                    <tr data-section="specials">
                                        <td>{{ ++$index }}</td>
                                        <td>{{ ucwords(str_replace('_', ' ', $perm)) }}</td>
                                        <td>{{ $description }}</td>
                                        <?php $hasPerm = in_array($perm, $permissions); ?>
                                        <td class="text-center">
                                            <div class="checkbox c-checkbox">
                                                <label>
                                                    <input name="permissions[]" type="checkbox" value="{{ $perm }}"
                                                        {{ $hasPerm ? 'checked=""' : '' }} />

                                                </label>
                                            </div>
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>
                        </table>
                        <hr>
                        <table class="table table-bordered table-hover">
                            <tbody>

                                @foreach (App\Utils\PermissionHelper::PERMISSIONS as $section => $perms)

                                    <tr class="bg-gray-50">
                                        <th colspan="2">{{ strtoupper(str_replace('_', ' ', $section)) }}</th>
                                        <th colspan="3" class="text-right">Select/Unselect Section</th>
                                        <th class="text-center">
                                            <div class="checkbox c-checkbox" style="display: inline-block; margin: 0 5px;">
                                                <label>
                                                    <input type="checkbox" class="toggle-section"
                                                        data-section="{{ $section }}" />

                                                </label>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr class="bg-gray-50">
                                        <th colspan="2"></th>
                                        @foreach (App\Utils\PermissionHelper::ACTIONS as $act)
                                            <th class="text-center">
                                                <div class="checkbox c-checkbox"
                                                    style="display: inline-block; margin: 0 5px;">
                                                    <label>
                                                        <input type="checkbox" class="toggle-column"
                                                            data-column="{{ $act }}"
                                                            data-section="{{ $section }}" />

                                                    </label>
                                                </div>
                                            </th>
                                        @endforeach
                                    </tr>

                                    <tr class="bg-gray-50">
                                        <th>#</th>
                                        <th>Modul</th>
                                        <th class="text-center">View</th>
                                        <th class="text-center">Create</th>
                                        <th class="text-center">Edit</th>
                                        <th class="text-center">Delete</th>
                                    </tr>

                                    @foreach ($perms as $index => $perm)

                                        <tr data-section="{{ $section }}">
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ ucwords(str_replace('_', ' ', $perm)) }}</td>
                                            @foreach (App\Utils\PermissionHelper::ACTIONS as $act)
                                                <?php $hasPerm = in_array($perm . ' ' . $act, $permissions); ?>
                                                <td class="text-center">
                                                    <div class="checkbox c-checkbox">
                                                        <label>
                                                            <input name="permissions[]" type="checkbox"
                                                                value="{{ $perm }} {{ $act }}"
                                                                class="{{ $act }}"
                                                                {{ $hasPerm ? 'checked=""' : '' }} />

                                                        </label>
                                                    </div>
                                                </td>
                                            @endforeach
                                        </tr>

                                    @endforeach

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex">
                        @can('update permissions')
                            <button class="btn btn-primary ml-auto mr-2" type="submit"><i class="fa fa-check"
                                    aria-hidden="true"></i>
                                Simpan</button>
                        @endcan

                        @can('delete permissions')
                            <a class="btn btn-danger mr-auto" onclick="return confirm('Yakin menghapus?')"
                                href="{{ route('admin.user_config.permission.delete', ['id' => $data['role']->id]) }}"><i
                                    class="fa fa-trash" aria-hidden="true"></i>
                                Hapus</a>
                        @endcan
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('AdminLTE-3.1.0/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('AdminLTE-3.1.0') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
@endpush

@push('scripts')
    <script>
        $(function() {

            $(".full").change(function() {
                var $this = $(this);
                var tr = $this.closest('tr');
                tr.find('input[type="checkbox"].full').prop('checked', true);
                tr.find('input[type="checkbox"].advanced').prop('checked', true);
                tr.find('input[type="checkbox"].basic').prop('checked', true);
            });

            $(".advanced").change(function() {
                var $this = $(this);
                var tr = $this.closest('tr');
                tr.find('input[type="checkbox"].full').prop('checked', false);
                tr.find('input[type="checkbox"].advanced').prop('checked', true);
                tr.find('input[type="checkbox"].basic').prop('checked', true);
            });

            $(".basic").change(function() {
                var $this = $(this);
                var tr = $this.closest('tr');
                var next = tr.find('input[type="checkbox"].advanced');

                if (next.prop('checked')) {
                    tr.find('input[type="checkbox"].full').prop('checked', false);
                    tr.find('input[type="checkbox"].advanced').prop('checked', false);
                    tr.find('input[type="checkbox"].basic').prop('checked', true);
                }
            });

            $(".toggle-section").change(function() {
                var $this = $(this);
                var section = $this.attr('data-section');
                var tr = $('tr[data-section="' + section + '"]');
                if (this.checked) {
                    tr.find('input[type="checkbox"]').prop('checked', true);
                } else {
                    tr.find('input[type="checkbox"]').prop('checked', false);
                }
            });

            $(".toggle-column").change(function() {
                var $this = $(this);
                var section = $this.attr('data-section');
                var column = $this.attr('data-column');
                var tr = $('tr[data-section="' + section + '"]');
                if (this.checked) {
                    tr.find('input[type="checkbox"].' + column).prop('checked', true);
                } else {
                    tr.find('input[type="checkbox"].' + column).prop('checked', false);
                }
            });

            $(".toggle-all").change(function() {
                var body = $('body');
                if (this.checked) {
                    body.find('input[type="checkbox"]').prop('checked', true);
                } else {
                    body.find('input[type="checkbox"]').prop('checked', false);
                }
            });
        });
    </script>
@endpush
