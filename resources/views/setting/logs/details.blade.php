<div class="modal-header ">
   <h5 class="modal-title" id="staticBackdropLabel">Error Details</h5>
   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
        <div class="row"> 
            <div class="col-md-12">
               <p><b>Date:</b> <span class="float-end">{{ date('F m,Y H:i A',strtotime($details->created_at)) }}</span><p>
               <p><b>Client:</b> <span class="float-end">{{$details->client->name}}</span><p>
               <p><b>Number:</b> <span class="float-end">{{$details->number}}</span><p>
               <p><b>Twillio Number:</b><span class="float-end">{{$details->mobile->mobile}}</span><p>
               <p><b>Message:</b><br>
               {{$details->message}}
               <p>
               <p><b>Error:</b><br>
               {{$details->error}}
               <p>
            </div> 
        </div>
</div>

<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
