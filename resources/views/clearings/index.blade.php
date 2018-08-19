@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">Listado de Liquidaciones - {{ $seller->first_name }} {{ $seller->last_name }}</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-2 ml-auto">
                                <a href="{{ route('clearings.create', $seller->id) }}" type="button" class="btn btn-success btn-sm btn-block">Crear</a>
                            </div>
                        </div>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Fecha</th>
                                <th scope="col">Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clearings as $clearing)
                                <tr>
                                    <td>{{ $clearing->created_at }}</td>
                                    <td>
                                        <a href="{{ route('clearings.show', $clearing->id) }}" class="btn btn-info btn-sm" type="button">Mostrar</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $clearings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
