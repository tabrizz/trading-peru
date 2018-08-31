@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Baja {{ $seller->last_name }} {{ $seller->first_name }}</div>

                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-2 ml-auto">
                                <label for="previous_money">Saldo en Dinero</label>
                                <input id="previous_money" type="text" class="form-control" value="{{ $book->previous_money }}" disabled>
                            </div>
                        </div>
                        <h5>Cargas</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <td scope="col">Hoja de Carga</td>
                                        <td scope="col">Descripción</td>
                                        <td scope="col">Fecha de Carga</td>
                                        <td scope="col">Total</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($truck_loads as $truck_load)
                                    <tr>
                                        <td>{{ $truck_load->id }}</td>
                                        <td>{{ $truck_load->description }}</td>
                                        <td>{{ $truck_load->load_date }}</td>
                                        <td>{{ $truck_load->total_price }}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br>
                        <h5>Liquidaciones</h5>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Saldo en Productos</th>
                                <th scope="col">Saldo en Dinero</th>
                                <th scope="col">Vendido</th>
                                <th scope="col">Devuelto en Productos</th>
                                <th scope="col">Créditos</th>
                                <th scope="col">Cobros</th>
                                <th scope="col">Descuentos</th>
                                <th scope="col">Gastos</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clearings as $clearing)
                            <tr>
                                <td>{{ $clearing->previous_products_balance }}</td>
                                <td>{{ $clearing->previous_credits_balance }}</td>
                                <td>{{ $clearing->income }}</td>
                                <td>{{ $clearing->left_in_products }}</td>
                                <td>{{ $clearing->credit }}</td>
                                <td>{{ $clearing->payment }}</td>
                                <td>{{ $clearing->discount }}</td>
                                <td>{{ $clearing->expense }}</td>
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
