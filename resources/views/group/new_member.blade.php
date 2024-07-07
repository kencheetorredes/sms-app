<div class="modal-header ">
   <h5 class="modal-title" id="staticBackdropLabel">Add New Members</h5>
   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<form  method="post" action="{{route('group.memberProcess')}}" id="bktForm" >
            <div class="row"> 
            <div class="col-md-12">
                <div class="form-group">
                    <label for="exampleInputEmail1">Contacts</label>
                    <select name="contacts[]" id="" class="form-control select2_modals" multiple>
                    
                        @foreach ($contacts as $contact)
                        <option value="{{$contact->id}}">{{$contact->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div> 
            @if ($details)
                <input type="hidden" name="id" value="{{$details->id}}">
                <input type="hidden" name="action" value="add">
            @endif

        </div>
    </form>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="button" data-form="bktForm" class="btn btn-primary cuBtn">Add</button>
</div>

<script>
    $(".select2_modals").select2({dropdownParent: $('#staticBackdrop')});
</script>