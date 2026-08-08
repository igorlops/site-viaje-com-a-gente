@extends('layouts.admin')

@section('page_title', 'Criar Novo Pacote')

@section('admin_content')
    @include('admin.destinations._form', ['destination' => null, 'edit' => false, 'tripType' => 'pacotes'])
@endsection
