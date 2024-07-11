@php
    
$mobiles = [];

if($details){
    foreach($details->mobiles as $mobile){
        $mobiles[] = $mobile->number->id;
    }
}

@endphp
<div class="modal-header ">
   <h5 class="modal-title" id="staticBackdropLabel">{{ $details ? 'Update' : 'New' }} User</h5>
   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form  method="post" action="{{route($details ? 'setting.users.update'  : 'setting.users.store')}}" id="bktForm" >
        <div class="row"> 
            <div class="col-md-12">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" name="name" value="{{$details ? $details->name : ''}}" >
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="text" class="form-control" name="email" value="{{$details ? $details->email : ''}}" >
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Twillio No</label>
                    <select name="mobiles[]" id="" class="form-control select2_modals"  multiple="multiple">
                        @foreach ($twillio_nos as $twillio_no)
                        <option @if(in_array($twillio_no->id, $mobiles)) selected @endif value="{{$twillio_no->id}}">{{$twillio_no->mobile}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Role</label>
                    <select name="role" id="" class="form-control" >
                        <option value=""></option>
                        @foreach (config('setting.roles') as $key => $role)
                        <option @if($details) @if($details->role == $key) selected @endif @endif value="{{$key}}">{{$role['label']}}</option>
                        @endforeach
                    </select>
                </div>
                @if ($details)
                <input type="hidden" name="id" value="{{$details->id}}">
                <div class="form-group">
                    <label for="exampleInputEmail1">Status</label>
                    <select  class="form-control" name="status">
                        @foreach (config('setting.status') as $key => $status)
                            <option @if($details->status == $key) selected @endif value="{{$key}}">{{$status['label']}}</option>
                        @endforeach
                    </select>
                </div>
                @endif
            </div> 
        </div>
    </form>
</div>

<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" data-form="bktForm"  class="btn btn-primary cuBtn">{{ $details ? 'Update' : 'Save' }}</button>
      </div>

<script>
    $(".select2_modals").select2({dropdownParent: $('#staticBackdrop')})

</script>