@extends('layout')

@section('css')
<link href="{{ url('common/bootstrap-table.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid  main-bkt-div">
    @include('group.view.breadcrumb')
    <div class="row">
    <div class="col-lg-12">
        <div class="card">
        <div class="card-head">Members</div>
            <div class="card-body table-responsive ">
                <table class="table" data-tagettype="no-action" id="list_table" data-sort-name="name" data-sort-order="asc" data-explode="status_,action" data-search="true"  data-target="" data-row="id" data-toolbar="#toolbar"
                    data-toggle="table" data-url="{{route('contacts.lists')}}?group_id={{$details->id}}"  data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200,500,1000]"  >
                    <thead  class="alert alert-light solid alert-square solid bordered">
                        <tr>
                            <th data-field="name">Name</th>
                            <th data-field="country_mobile_code">Country Code</th>
                            <th data-field="mobile">Mobile</th>
                            <th  data-field="status_">Status</th>
                            <th  data-field="action"></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@section('js')
<script src="{{url('assets/js/sms/group.js')}}"></script> 
<script src="{{ url('common/js/import.js') }}"></script>
@endsection
@endsection