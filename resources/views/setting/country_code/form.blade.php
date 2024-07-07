<div class="modal-header ">
   <h5 class="modal-title" id="staticBackdropLabel">{{ $details ? 'Update' : 'New' }} Country Code</h5>
   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form  method="post" action="{{route($details ? 'setting.country_code.update'  : 'setting.country_code.store')}}" id="bktForm" >
        <div class="row"> 
            <div class="col-md-12">
                <div class="form-group">
                    <label for="exampleInputEmail1">Country</label>
                    <input type="text" class="form-control" name="country" value="{{$details ? $details->country : ''}}" >
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Country Short Name</label>
                    <input type="text" class="form-control" name="country_short_name" value="{{$details ? $details->country_short_name : ''}}" >
                </div>

                

                <div class="form-group">
                    <label for="exampleInputEmail1">Mobile Code</label>
                    <input type="text" class="form-control" name="code" value="{{$details ? $details->code : ''}}" >
                </div>
                @if ($details)
                <input type="hidden" name="id" value="{{$details->id}}">
            @endif
            </div> 
        </div>
    </form>
</div>

<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" data-form="bktForm"  class="btn btn-primary cuBtn">{{ $details ? 'Update' : 'Save' }}</button>
      </div>
