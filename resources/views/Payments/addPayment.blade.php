@extends('layout.layout')


@section('header')
    @include('header.header')
@endsection

@section('body')
    @include('Payments.pages.addPayment')
@endsection


@section('extra_files') 
    <script src="{{ asset('js/paymentSelect2.js') }}"></script> 
@endsection