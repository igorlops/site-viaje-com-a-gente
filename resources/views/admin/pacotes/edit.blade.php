@extends('layouts.admin')

@section('page_title', 'Editar Pacote: ' . $destination->title)

@section('admin_content')
    @include('admin.destinations._form', ['destination' => $destination, 'edit' => true, 'tripType' => 'pacotes'])
@endsection
