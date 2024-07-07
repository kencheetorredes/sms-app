<div class="modal-header ">
   <h5 class="modal-title" id="staticBackdropLabel">Import Contacts</h5>
   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<form  method="post" action="{{route('contacts.otherProcess')}}" id="bktForm" >
            <div class="row"> 
            <div class="col-md-12">
                <div class="form-group">
                    <label for="exampleInputEmail1">Add file</label>
                    <input type="file" class="form-control" name="files">
                    <small>Please use csv only. download csv template 
                        <a href="{{route('setting.csv-template','contacts')}}" class="text-danger">here</a>
                    </small>
                </div>
            </div> 
            <input type="hidden" name="action" value="upload">
        </div>
    </form>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="button" data-form="bktForm" class="btn btn-primary importBtnBkt">Upload</button>
</div>

<script>
    $(".select2_modals").select2({dropdownParent: $('#staticBackdrop')});
</script>