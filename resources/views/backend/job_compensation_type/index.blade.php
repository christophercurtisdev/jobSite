@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('backend_job_compensation_types.labels.management'))

@section('breadcrumb-links')
    @include('backend.job_compensation_type.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('backend_job_compensation_types.labels.management') }} <small class="text-muted">{{ __('backend_job_compensation_types.labels.active') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.job_compensation_type.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('backend_job_compensation_types.table.title')</th>
                            <th>@lang('backend_job_compensation_types.table.created')</th>
                            <th>@lang('backend_job_compensation_types.table.last_updated')</th>
                            <th>@lang('backend_job_compensation_types.table.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($jobCompensationTypes as $jobCompensationType)
                            <tr>
                                <td class="align-middle"><a href="/admin/job_compensation_types/{{ $jobCompensationType->id }}">{{ $jobCompensationType->title }}</a></td>
                                <td class="align-middle">{!! $jobCompensationType->created_at !!}</td>
                                <td class="align-middle">{{ $jobCompensationType->updated_at->diffForHumans() }}</td>
                                <td class="align-middle">{!! $jobCompensationType->action_buttons !!}</td>
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
                    {!! $jobCompensationTypes->count() !!} {{ trans_choice('backend_job_compensation_types.table.total', $jobCompensationTypes->count()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $jobCompensationTypes->links() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
