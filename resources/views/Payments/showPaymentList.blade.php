@extends('layout.layout')


@section('header')
    @include('header.header')
@endsection

@section('body')
    @include('Payments.pages.showPaymentList')
@endsection


@section('extra_files') 
    <script src="{{ asset('js/paymentDataTable.js') }}"></script> 
@endsection
