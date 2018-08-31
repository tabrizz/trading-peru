@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Liquidación Fecha {{ \Carbon\Carbon::parse($clearing->created_at)->format('d-m-Y') }}
                        {{ $seller->last_name }} {{ $seller->first_name }}
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <table class="table table-hover table_morecondensed">
                                <thead class="thead-dark">
                                <tr>
                                    <th>Saldo en Productos</th>
                                    <th>Saldo en Dinero</th>
                                    <th>Vendido</th>
                                    <th>Devuelto en Productos</th>
                                    <th>Créditos</th>
                                    <th>Cobros</th>
                                    <th>Descuentos</th>
                                    <th>Gastos</th>
                                </tr>
                                </thead>
                                <tbody>
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
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <h5>Créditos</h5>
                        <div class="row">
                            <table class="table table-hover table_morecondensed">
                                <thead class="thead-dark">
                                @foreach($credits as $credit)
                                <tr>
                                    <th>Descripción</th>
                                    <th>Monto</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $credit->description }}</td>
                                    <td>{{ $credit->price }}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <h5>Cobros</h5>
                        <div class="row">
                            <table class="table table-hover table_morecondensed">
                                <thead class="thead-dark">
                                @foreach($payments as $payment)
                                    <tr>
                                        <th>Descripción</th>
                                        <th>Monto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $payment->description }}</td>
                                    <td>{{ $payment->price }}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <h5>Descuentos</h5>
                        <div class="row">
                            <table class="table table-hover table_morecondensed">
                                <thead class="thead-dark">
                                @foreach($discounts as $discount)
                                    <tr>
                                        <th>Descripción</th>
                                        <th>Monto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $discount->description }}</td>
                                    <td>{{ $discount->price }}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <h5>Gastos</h5>
                        <div class="row">
                            <table class="table table-hover table_morecondensed">
                                <thead class="thead-dark">
                                @foreach($expenses as $expense)
                                    <tr>
                                        <th>Descripción</th>
                                        <th>Monto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $expense->description }}</td>
                                    <td>{{ $expense->price }}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
