<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('backend_jobs.menus.main')</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.jobs.index') }}">@lang('backend_jobs.menus.all')</a>
                <a class="dropdown-item" href="{{ route('admin.jobs.create') }}">@lang('backend_jobs.menus.create')</a>
                {{-- <a class="dropdown-item" href="{{ route('admin.jobs.deactivated') }}">@lang('backed_jobs.menus.deactivated')</a> --}}
                <a class="dropdown-item" href="{{ route('admin.jobs.deleted') }}">@lang('backend_jobs.menus.deleted')</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
