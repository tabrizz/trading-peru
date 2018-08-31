@extends('layouts.app')

@section('content')
    <index-clearing-component
            seller="{{ $seller }}"
            clearings="{{ $clearings }}"
            truck_loads="{{ $truck_loads }}"
            products_balance="{{ $products_balance }}"
            money_balance="{{ $money_balance }}"
            book_id="{{ $book_id }}"
    ></index-clearing-component>
@endsection
