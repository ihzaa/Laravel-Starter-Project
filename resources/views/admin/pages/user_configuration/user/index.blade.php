@extends('admin.template.master')

@section('page_title', 'User')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    List User
                    <div class="card-tools">
                        <a class="btn btn-primary" href="{{ route('admin.user_config.user.createGet') }}"><i
                                class="fa fa-plus" aria-hidden="true"></i> Tambah</a>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="main-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>
                                    <select id="status" class="form-control">
                                        <option value="aktif">Aktif</option>
                                        <option value="delete">Dihapus</option>
                                    </select>
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('layouts.data_tables.basic_data_tables')

@push('scripts')
    <script>
        $(function() {
            let table = $('#main-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! url()->full() !!}',
                columns: [{
                        data: 'id',
                        name: 'id',
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        sortable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        className: "text-center"
                    }
                ]
            });

            $("#status").change(function() {
                let url = "";
                if ($(this).val() != "aktif") {
                    url = "{{ route('admin.user_config.user.index', ['status' => '__status']) }}"
                } else {
                    url = "{{ route('admin.user_config.user.index') }}"
                }
                table.ajax.url(url.replace('__status', $(this).val())).load();
            })
        });
    </script>
@endpush
