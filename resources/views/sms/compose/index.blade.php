@extends('layout')

@section('content')
    <div class="container-fluid  main-bkt-div">
    @include('sms.compose.breadcrumb')
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card ">
                <div class="card-body p-1">
                    <form action="">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Message Type</label>
                            <select name="" id="" class="form-control">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label  class="form-label">Contact</label>
                            <input type="email" class="form-control" >
                        </div>
                        <div class="mb-3">
                            <label  class="form-label">Group</label>
                            <input type="email" class="form-control" >
                        </div>

                        <div class="mb-3">
                            <label  class="form-label">Template</label>
                            <input type="email" class="form-control" >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea name="" id="" class="form-control"></textarea>
                        </div>

                        <button class="btn btn-primary float-end">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
   </div>
@endsection