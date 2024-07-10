@extends('layout')
@section('content')
    @include('sms.inbox.contact')
    @include('sms.inbox.no-sms')
@endsection
@section('js')
<script src="{{url('assets/js/sms/inbox.js')}}"></script> 
@endsection