@extends('layout')

@section('css')
<link href="{{ url('common/bootstrap-table.css') }}" rel="stylesheet">
<style>
    .main-wrapper{
        min-height:100vh;
        height:auto
    }
</style>
@endsection

@section('content')
    <div class="container-fluid  main-bkt-div">
    @include('setting.logs.breadcrumb')
    <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body table-responsive ">
                <table class="table" id="list_table" data-ispopup="true" data-sort-name="created_at" data-sort-order="asc" data-explode="action" data-search="true"  data-target="{{route('setting.logs.show')}}" data-row="id" data-toolbar="#toolbar"
                    data-toggle="table" data-url="{{route('setting.logs.lists')}}"  data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200,500,1000]"  >
                    <thead  class="alert alert-light solid alert-square solid bordered">
                        <tr>
                            <th data-field="date">Date</th>
                            <th data-field="client_name">Client</th>
                            <th data-field="number">Number</th>
                            <th data-field="mobile_">Twillio Number</th>
                            
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection