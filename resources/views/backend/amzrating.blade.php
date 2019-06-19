@extends('backend.layouts.app')
@section('title', app_name() . ' | ' . __('labels.backend.tables.management'))

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('strings.backend.rating.title')
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive" id="vue-app">
                        <app vue-table-uri="{{Request::path()}}" vue-table-template="amzraring"></app>
                    </div>
                </div><!--col-->
            </div><!--row-->
            <div class="row">
                <div class="col-7">
                    <div class="float-left">
                        {{--{!! $data->total() !!} {{ trans_choice('labels.backend.access.users.table.total', $item->total()) }}--}}
                    </div>
                </div><!--col-->


            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection
