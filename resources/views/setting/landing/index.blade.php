@extends('layout')
@section('css')
<link href="{{ url('common/bootstrap-table.css') }}" rel="stylesheet">
<style>
    .bootstrap-table {
        width: 100%  !important;
    }
</style>
@endsection
@section('content')
    @include('setting.landing.list')
    @include('setting.landing.no-selected')
@endsection
@section('js')
<script src="{{url('assets/js/sms/inbox.js')}}"></script> 
@endsection