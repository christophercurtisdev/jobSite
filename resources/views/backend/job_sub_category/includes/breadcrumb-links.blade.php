<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('backend_job_sub_categories.menus.main')</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.job_sub_categories.index') }}">@lang('backend_job_sub_categories.menus.all')</a>
                <a class="dropdown-item" href="{{ route('admin.job_sub_categories.create') }}">@lang('backend_job_sub_categories.menus.create')</a>
                {{-- <a class="dropdown-item" href="{{ route('admin.job_sub_categories.deactivated') }}">@lang('backed_job_sub_categories.menus.deactivated')</a> --}}
                <a class="dropdown-item" href="{{ route('admin.job_sub_categories.deleted') }}">@lang('backend_job_sub_categories.menus.deleted')</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
