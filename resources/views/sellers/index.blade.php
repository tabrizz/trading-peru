@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(\Session::has('success'))
                    <div class="alert alert-success">
                        {{\Session::get('success')}}
                    </div>
                @endif
                    @if(\Session::has('updated'))
                        <div class="alert alert-primary">
                            {{\Session::get('updated')}}
                        </div>
                    @endif
                <div class="card">
                    <div class="card-header">Listado de Vendedores</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-2 ml-auto">
                                <a href="{{ route('sellers.create') }}" type="button" class="btn btn-success btn-sm btn-block">Crear</a>
                            </div>
                        </div>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">DNI</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Celular</th>
                                <th scope="col">Dirección</th>
                                <th scope="col">Dinero</th>
                                <th scope="col">Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sellers as $seller)
                            <tr>
                                <td>{{ $seller->dni }}</td>
                                <td>{{ $seller->first_name }}</td>
                                <td>{{ $seller->last_name }}</td>
                                <td>{{ $seller->phone_number }}</td>
                                <td>{{ $seller->address }}</td>
                                <td>{{ $seller->money }}</td>
                                <td>
                                    <a href="{{ route('sellers.edit', $seller->id) }}" class="btn btn-info btn-sm" type="button">Editar</a>
                                    <a href="{{ route('sellers.inventory', $seller->id) }}" class="btn btn-warning btn-sm" type="button">Inventario</a>
                                    <a href="{{ route('clearings.index', $seller->id) }}" class="btn btn-light btn-sm" type="button">Liquidación</a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
