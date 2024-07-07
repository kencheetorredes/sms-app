<div class="modal-header ">
   <h5 class="modal-title" id="staticBackdropLabel">{{$details ? 'Update' : 'New' }} Contact</h5>
   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form  method="post" action="{{route($details ? 'contacts.update'  : 'contacts.store')}}" id="bktForm" >
        <div class="row"> 
            <div class="col-md-12">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $details ? $details->name : ''}}">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Mobile Number</label>
                    <div class="row">
                        <div class="col-md-3">
                            <select  class="form-control" name="country_code_id">
                                @foreach ($codes as $code)
                                <option @if($details) @if($details->country_code_id == $code->id) selected @endif @endif  value="{{$code->id}}">{{$code->country_short_name.'('.$code->code.')'}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="mobile"  value="{{ $details ? $details->mobile : ''}}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Group</label>
                    <select  class="form-control" name="group_id">
                        <option value=""></option>
                        @foreach ($groups as $group)
                            <option @if($details) @if($details->group_id == $group->id) selected @endif @endif value="{{$group->id}}">{{$group->name}}</option>
                        @endforeach
                    </select>
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
        <button type="button" data-form="bktForm"  class="btn btn-primary cuBtn">{{$details ? 'Update' : 'Save' }}</button>
      </div>
