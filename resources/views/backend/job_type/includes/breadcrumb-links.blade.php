<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('backend_job_types.menus.main')</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.job_types.index') }}">@lang('backend_job_types.menus.all')</a>
                <a class="dropdown-item" href="{{ route('admin.job_types.create') }}">@lang('backend_job_types.menus.create')</a>
                {{-- <a class="dropdown-item" href="{{ route('admin.job_types.deactivated') }}">@lang('backed_job_types.menus.deactivated')</a> --}}
                <a class="dropdown-item" href="{{ route('admin.job_types.deleted') }}">@lang('backend_job_types.menus.deleted')</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
