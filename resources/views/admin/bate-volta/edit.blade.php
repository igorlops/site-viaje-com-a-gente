@extends('layouts.admin')

@section('page_title', 'Editar Passeio – ' . $destination->title)

@section('admin_content')
    @include('admin.bate-volta.form', ['destination' => $destination, 'edit' => true])
@endsection
