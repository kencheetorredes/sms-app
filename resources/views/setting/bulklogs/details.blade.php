<div class="modal-header ">
   <h5 class="modal-title" id="staticBackdropLabel">Error Details</h5>
   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
        <div class="row"> 
            <div class="col-md-12">
               <p><b>Date:</b><span class="float-end">  {{ date('F m,Y H:i A',strtotime($details->created_at)) }}</span><p>
               <p><b>Client:</b><span class="float-end">  {{$details->group->name}} </span><p>
               <p><b>Schedule:</b><span class="float-end"> {{$details->scheduled == null || $details->scheduled == '1970-01-01 00:00:00' ? 'Now' : date('F d,Y H:i A',strtotime($details->scheduled))}} </span><p>
               <p><b>Twillio Number:</b><span class="float-end"> {{$details->mobile->mobile}} </span><p>
               <p><b>Status:</b><span class="mb-1 float-end badge {{ config('setting.bulk_status.'.$details->status.'.class') }}">{{config('setting.bulk_status.'.$details->status.'.label')}}</span><p>
               <p><b>Message:</b><br>
               {{$details->message}}
               <p>
            </div> 
        </div>
</div>

<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
