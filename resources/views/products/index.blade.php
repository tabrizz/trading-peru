@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(\Session::has('success'))
                    <div class="alert alert-success">
                        {{\Session::get('success')}}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">Listado de Productos</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-2 ml-auto">
                                <a href="{{ route('products.create') }}" type="button" class="btn btn-success btn-sm btn-block">Crear</a>
                            </div>
                        </div>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
