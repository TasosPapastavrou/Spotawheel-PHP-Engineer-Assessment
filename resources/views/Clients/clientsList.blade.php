@extends('layout.layout')

@section('header')
    @include('header.header')
@endsection

@section('body')
    @include('Clients.pages.clientList')
@endsection


@section('extra_files') 
    <script src="{{ asset('js/clientDatatable.js') }}"></script>
@endsection

