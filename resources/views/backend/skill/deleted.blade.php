@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('backend_skills.labels.management'))

@section('breadcrumb-links')
    @include('backend.skill.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('backend_skills.labels.management') }} <small class="text-muted">{{ __('backend_skills.labels.deleted') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.skill.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('backend_skills.table.name')</th>
                            <th>@lang('backend_skills.table.created')</th>
                            <th>@lang('backend_skills.table.deleted')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($skills as $skill)
                            <tr>
                                <td class="align-middle"><a href="/admin/skills/{{ $skill->id }}">{{ $skill->name }}</a></td>
                                <td class="align-middle">{!! $skill->created_at !!}</td>
                                <td class="align-middle">{{ $skill->deleted_at->diffForHumans() }}</td>
                                <td class="align-middle">{!! $skill->trashed_buttons !!}</td>
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
                    {!! $skills->count() !!} {{ trans_choice('backend_skills.table.total', $skills->count()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $skills->links() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
