@extends('layout')
@section('content')
    @include('setting.landing.list')
    @include('setting.landing.no-selected')
@endsection
@section('js')
<script src="{{url('assets/js/sms/inbox.js')}}"></script> 
@endsection