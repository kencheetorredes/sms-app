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
    @include('sms.compose.breadcrumb')
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card ">
                <div class="card-body p-1">
                    <form action="">
                        <div>
                            <label for="name" class="form-label">Message Type</label>
                            <select name="" id="name" class="form-control select2 ">
                                <option value=""></option>
                                @foreach (config('setting.message_types') as $key => $message_types)
                                <option value="{{$key}}">{{$message_types}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                            <label class="form-label mt-2">Contact</label>
                            <select name="contact_id" class="form-control select2"  multiple>
                                <option value=""></option>
                                @foreach ($contacts as $key => $contact)
                                <option value="{{$contact->id}}">{{$contact->name}}</option>
                                @endforeach
                            </select>
                            
                        <div>
                            <label  class="form-label">Group</label>
                            <select name="group_id" class="form-control select2"  multiple>
                                <option value=""></option>
                                @foreach ($groups as $key => $group)
                                <option value="{{$group->id}}">{{$group->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label  class="form-label">Template</label>
                            <select name="" id="" class="form-control select2">
                                <option value=""></option>
                                @foreach ($templates as $key => $template)
                                <option value="{{$template->id}}">{{$template->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Message</label>
                            <textarea name="" id="" rows="10" class="form-control"></textarea>
                        </div>

                        <button class="btn btn-primary float-end">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
   </div>
@endsection