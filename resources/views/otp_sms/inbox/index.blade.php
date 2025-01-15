@extends('layout')
@section('content')
    @include('otp_sms.inbox.contact')
    @include('otp_sms.inbox.no-sms')
@endsection
@section('js')
<script src="{{url('assets/js/sms/inbox.js')}}"></script> 
@endsection