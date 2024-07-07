<div class="modal-header ">
   <h5 class="modal-title" id="staticBackdropLabel">{{ $details ? 'Update' : 'New' }} Template</h5>
   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form  method="post" action="{{route($details ? 'sms_template.update' : 'sms_template.store')}}" id="bktForm" >
        <div class="row"> 
            <div class="col-md-12">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" name="name" value="{{$details ? $details->name : ''}}" >
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Content</label>
                    <textarea name="content" class="form-control" rows="10">{{$details ? $details->content : ''}}</textarea>
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
        <button type="button" data-form="bktForm" class="btn btn-primary cuBtn">{{ $details ? 'Update' : 'Save' }} </button>
      </div>
