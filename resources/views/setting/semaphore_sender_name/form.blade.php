<div class="modal-header ">
   <h5 class="modal-title" id="staticBackdropLabel">Register Semaphore Sender Name</h5>
   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="alert alert-info">Note : Make it sure this is registered to Semaphore</div>
    <form  method="post" action="{{route($details ? 'setting.semaphore_sender_name.update'  : 'setting.semaphore_sender_name.store')}}" id="bktForm" >
        <div class="row"> 
            <div class="col-md-12">
                <div class="form-group">
                    <label for="exampleInputEmail1">Sender Name</label>
                    <input type="text" class="form-control" name="sender_name" value="{{$details ? $details->sender_name : ''}}">
                </div>
                @if($details)
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
