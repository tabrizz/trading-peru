@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Inventario del Venderdor</div>
                    <div class="card-body">
                        @if($seller_product_bag->isEmpty())
                            <h5>Inventario Vacío</h5>
                        @else
                            <div class="form-group row">
                                <label for="first_name" class="col-md-3 col-form-label text-md-right">Vendedor</label>

                                <div class="col-md-3">
                                    <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ $seller_product_bag[0]->first_name }}" disabled>
                                </div>
                                <div class="col-md-3">
                                    <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ $seller_product_bag[0]->last_name }}" disabled>
                                </div>
                                <div class="col-md-3">
                                    <input id="dni" type="text" class="form-control{{ $errors->has('dni') ? ' is-invalid' : '' }}" name="dni" value="{{ $seller_product_bag[0]->dni }}" disabled>
                                </div>
                            </div>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Precio Unitario</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($seller_product_bag as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>{{ $product->amount }}</td>
                                        <td>{{ $product->price }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
