@extends('layouts.admin')

@section('page_title', 'Criar Novo Destino')

@section('admin_content')
    @include('admin.destinations._form',['destination' => null, 'edit' => false])
@endsection
