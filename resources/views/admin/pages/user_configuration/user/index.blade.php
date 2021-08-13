@extends('admin.template.master')

@section('page_title', 'User')


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                List User
                <div class="card-tools">
                    <button class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</button>
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
                            <th>Aksi</th>
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
        $('#main-table').DataTable({
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
                    data: 'action',
                    name: 'action',
                    className: "text-center"
                }
            ]
        });
    });
</script>
@endpush
