@extends('layout')
@section('css')
<style>
    .select2-container {
    z-index: unset;
}
.main-wrapper{
        min-height:100vh;
        height:auto
}
</style>
@endsection
@section('content')
    <div class="container-fluid  main-bkt-div">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-5 align-self-center">
                <h3 class="page-title">My Profile</h3>
                    <div class="d-flex align-items-center">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <p><b>Name:</b> <span class="float-end">
                        {{ Auth::guard('web')->user()->name }}
                    </span><p>
                    <p><b>Email:</b> <span class="float-end">
                        {{ Auth::guard('web')->user()->email }}
                    </span><p>
                    <p><b>Role:</b> <span class="float-end">
                        {{ config('setting.roles.'.Auth::guard('web')->user()->role)['label'] }}
                    </span><p>
                    <p><b>Twillio Numbers:</b> <br>
                    @foreach (CommonLib::usertNumbers() as $key => $usertNumber)
                    {{$usertNumber->number->mobile}}<br>
                                @endforeach
                                <p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('auth.process_change_password')}}" id="btk-form" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Current Password</label>
                            <input type="password" class="form-control" name="current_password" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">New Password</label>
                            <input type="password" class="form-control" name="password" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Confirm New Password</label>
                            <input type="password" class="form-control" name="confirm_password" >
                        </div>
                        <button class="btn btn-primary float-end cuBtn"  data-form="btk-form">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
   </div>
@endsection
@section('js')
<script src="{{url('assets/js/sms/compose-sms.js')}}"></script> 
@endsection