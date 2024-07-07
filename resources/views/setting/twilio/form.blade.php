<div class="modal-header ">
   <h5 class="modal-title" id="staticBackdropLabel">Contact</h5>
   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form  method="post" action="{{route($details ? 'contacts.update'  : 'contacts.store')}}" id="bktForm" >
        <div class="row"> 
            <div class="col-md-12">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" name="name" >
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Mobile Number</label>
                    <div class="row">
                        <div class="col-md-3">
                            <select  class="form-control" name="country_mobile_code">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="mobile" >
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Group</label>
                    <select  class="form-control" name="is_required">
                            <option value=""></option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Status</label>
                    <select  class="form-control" name="status">
                            <option value=""></option>
                    </select>
                </div>

                

            </div> 
        </div>
    </form>
</div>

<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" data-form="bktForm"  class="btn btn-primary cuBtn">Save changes</button>
      </div>
