<div class="page-breadcrumb">
    <div class="row">
            <div class="col-md-5 align-self-center">
                <h3 class="page-title">
                    {{ $details->name }}
                </h3>
                <small>Group Details</small>
                <div class="d-flex align-items-center"></div>
            </div>
            <div class="col-md-7 justify-content-end align-self-center d-md-flex">
            <a class="btn btn-warning pop-up me-2" data-template="{{route('group.import',$details->id)}}"><i class="fa fa-upload me-2" aria-hidden="true"></i> Import Member</a>
                <a class="btn btn-secondary pop-up me-2" data-template="{{route('group.addMember',$details->id)}}"><i class="fa fa-save me-2" aria-hidden="true"></i> Add Member</a>
                <a class="btn btn-primary pop-up" data-template="{{route('group.create',$details->id)}}"><i class="fa fa-pencil me-2" aria-hidden="true"></i> Edit</a>
            </div>
     </div>
 </div>