@extends('admin.template.master')

@section('page_title', 'Dashboard')

@section('content')
    <x-forms.form-delete>
        <button class="btn btn-sm btn-danger" type="submit">X</button>
    </x-forms.form-delete>

@endsection
