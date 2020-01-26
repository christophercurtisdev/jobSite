@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('backend_organisations.labels.management'))

@section('breadcrumb-links')
    @include('backend.organisation.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('backend_organisations.labels.management') }} <small class="text-muted">{{ __('backend_organisations.labels.deleted') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.organisation.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('backend_organisations.table.name')</th>
                            <th>@lang('backend_organisations.table.created')</th>
                            <th>@lang('backend_organisations.table.deleted')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($organisations as $organisation)
                            <tr>
                                <td class="align-middle"><a href="/admin/organisations/{{ $organisation->id }}">{{ $organisation->name }}</a></td>
                                <td class="align-middle">{!! $organisation->created_at !!}</td>
                                <td class="align-middle">{{ $organisation->deleted_at->diffForHumans() }}</td>
                                <td class="align-middle">{!! $organisation->trashed_buttons !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $organisations->count() !!} {{ trans_choice('backend_organisations.table.total', $organisations->count()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $organisations->links() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
