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
    @include('setting.country_code.breadcrumb')
    <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body table-responsive ">
                <table class="table" id="list_table" data-ispopup="true" data-sort-name="country" data-sort-order="asc" data-explode="action" data-search="true"  data-target="{{route('setting.country_code.create')}}" data-row="id" data-toolbar="#toolbar"
                    data-toggle="table" data-url="{{route('setting.country_code.lists')}}"  data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200,500,1000]"  >
                    <thead  class="alert alert-light solid alert-square solid bordered">
                        <tr>
                            <th data-field="country">Country</th>
                            <th data-field="country_short_name">Code</th>
                            <th data-field="code">Mobile Code</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection