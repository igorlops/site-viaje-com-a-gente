@extends('layouts.admin')

@section('page_title', 'Editar Destino')

@section('admin_content')
    @include('admin.destinations._form', ['destination' => $destination, 'edit' => true])
@endsection