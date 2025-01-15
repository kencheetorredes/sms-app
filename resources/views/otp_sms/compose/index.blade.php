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
    @include('sms_otp.compose.breadcrumb')
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card ">
                <div class="card-body p-1">
                    <form action="{{route('message.send')}}" method="post" id="btk-form">
                        @if(count(CommonLib::usertNumbers()) > 0)
                        <div class="mb-2">
                            <label for="name" class="form-label">From</label>
                            <select name="from_no"  class="form-control select2 changeType">
                                <option value=""></option>
                                @foreach (CommonLib::usertNumbers() as $key => $usertNumber)
                                <option value="{{$usertNumber->twillio_nunber}}">{{$usertNumber->number->mobile}}</option>
                                @endforeach
                            </select>
                        </div>
                        @else
                        <input type="hidden" name="from_no" value="{{CommonLib::currentTwillioNo(1)}}">
                        @endif
                        <div class="mb-2">
                            <label for="name" class="form-label">Message Type</label>
                            <select name="type"  class="form-control select2 changeType">
                                <option value=""></option>
                                @foreach (config('setting.message_types') as $key => $message_types)
                                <option data-target="{{$message_types['target']}}" value="{{$key}}">{{$message_types['label']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="contact_type d-none mb-2" id="contact_div">
                            <label class="form-label mt-2">Contact</label>
                            <button class="btn btn-sm btn-primary float-end mb-2 pop-up" data-template="{{route('contacts.create')}}?dom=1">+</button>
                            <select name="contacts[]" id="contact_id" class="form-control select2"  multiple="multiple">
                                @foreach ($contacts as $key => $contact)
                                <option value="{{$contact->id}}">{{$contact->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="contact_type d-none mb-2" id="group_div">
                            <label  class="form-label">Group</label>
                            <select name="groups[]" class="form-control select2"  multiple>
                                @foreach ($groups as $key => $group)
                                <option value="{{$group->id}}">{{$group->name}}</option>
                                @endforeach
                            </select>
                            <br><br>
                            <label  class="form-label">Schedule</label>
                            <input type="datetime-local" min="{{ date('Y-m-d',strtotime('-1 days')) }}" name="scheduled" class="form-control ">
                          
                        </div>

                        <div class="form-group mb-2">
                            <label  class="form-label">Template</label>
                            <select  class="form-control select2 getTemplate" data-url="{{route('contacts.otherProcess')}}" data-target="#messages">
                                <option value=""></option>
                                @foreach ($templates as $key => $template)
                                <option value="{{$template->id}}">{{$template->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label class="form-label">Message</label>
                            <textarea name="message" id="messages" rows="10" class="form-control"></textarea>
                        </div>

                        <button class="btn btn-primary float-end cuBtn"  data-form="btk-form">Send</button>
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