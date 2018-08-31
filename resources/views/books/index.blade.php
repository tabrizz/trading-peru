@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Bajas {{ $seller->last_name }} {{ $seller->first_name }}</div>

                    <div class="card-body">
                        <div class="row">
                            <table class="table table-hover table_morecondensed">
                                <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Saldo en Dinero</th>
                                    <th>Fecha</th>
                                    <th>Opciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($books as $book)
                                <tr>
                                    <td>{{ $book->id }}</td>
                                    <td>{{ $book->previous_money }}</td>
                                    <td>{{ \Carbon\Carbon::parse($book->updated_at)->format('d-m-Y') }}</td>
                                    <td>
                                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-info btn-sm" type="button">Ver</a>
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
    </div>
@endsection
