@extends('layouts.app')

@section('content')
    <show-purchase-order-component purchase_order="{{ $purchase_order  }}"></show-purchase-order-component>
@endsection
