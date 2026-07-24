@extends('layouts.admin')

@section('page_title', 'Criar Novo Passeio – Bate e Volta')

@section('admin_content')
    @include('admin.bate-volta.form', ['destination' => null, 'edit' => false])
@endsection
