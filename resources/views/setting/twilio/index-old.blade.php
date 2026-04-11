@extends('layout')

@section('css')
<link href="{{ url('common/bootstrap-table.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid  main-bkt-div">
    @include('setting.twilio.breadcrumb')
    <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body table-responsive ">
                <table class="table" id="list_table" data-sort-name="mobile" data-ispopup="true" data-sort-order="asc" data-explode="" data-search="true"  data-target="{{route('setting.twillio.create')}}" data-row="id" data-toolbar="#toolbar"
                    data-toggle="table" data-url="{{route('setting.twillio.lists')}}"  data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200,500,1000]"  >
                    <thead  class="alert alert-light solid alert-square solid bordered">
                        <tr>
                            <th data-field="label">Label</th>
                            <th data-field="mobile">Number</th>
                            <th data-sortable="true" data-field="status_">Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection