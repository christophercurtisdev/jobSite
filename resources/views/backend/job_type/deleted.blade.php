@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('backend_job_types.labels.management'))

@section('breadcrumb-links')
    @include('backend.job_type.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('backend_job_types.labels.management') }} <small class="text-muted">{{ __('backend_job_types.labels.deleted') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.job_type.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('backend_job_types.table.name')</th>
                            <th>@lang('backend_job_types.table.created')</th>
                            <th>@lang('backend_job_types.table.deleted')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($jobTypes as $jobType)
                            <tr>
                                <td class="align-middle"><a href="/admin/job_types/{{ $jobType->id }}">{{ $jobType->name }}</a></td>
                                <td class="align-middle">{!! $jobType->created_at !!}</td>
                                <td class="align-middle">{{ $jobType->deleted_at->diffForHumans() }}</td>
                                <td class="align-middle">{!! $jobType->trashed_buttons !!}</td>
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
                    {!! $jobTypes->count() !!} {{ trans_choice('backend_job_types.table.total', $jobTypes->count()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $jobTypes->links() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
