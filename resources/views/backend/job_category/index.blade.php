@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('backend_job_categories.labels.management'))

@section('breadcrumb-links')
    @include('backend.job_category.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('backend_job_categories.labels.management') }} <small class="text-muted">{{ __('backend_job_categories.labels.active') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.job_category.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('backend_job_categories.table.name')</th>
                            <th>@lang('backend_job_categories.table.created')</th>
                            <th>@lang('backend_job_categories.table.last_updated')</th>
                            <th>@lang('backend_job_categories.table.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($jobCategories as $jobCategory)
                            <tr>
                                <td class="align-middle"><a href="/admin/job_categories/{{ $jobCategory->id }}">{{ $jobCategory->name }}</a></td>
                                <td class="align-middle">{!! $jobCategory->created_at !!}</td>
                                <td class="align-middle">{{ $jobCategory->updated_at->diffForHumans() }}</td>
                                <td class="align-middle">{!! $jobCategory->action_buttons !!}</td>
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
                    {!! $jobCategories->count() !!} {{ trans_choice('backend_job_categories.table.total', $jobCategories->count()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $jobCategories->links() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
