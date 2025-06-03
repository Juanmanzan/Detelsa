@extends('adminlte::page')

@section('title', 'Crear Productos')

@section('content_header')
    <h1>Crear Productos</h1>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admincolores.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@stop

@section('content')
    <div id="content-area">
        <form id="formCategoria">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre del producto</label>
                <input type="text" name="nombre" id="nombre" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Guardar</button>
        </form>

        <div id="response-message" class="mt-3"></div>
    </div>
@stop

