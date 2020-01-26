<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('backend_skills.menus.main')</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.skills.index') }}">@lang('backend_skills.menus.all')</a>
                <a class="dropdown-item" href="{{ route('admin.skills.create') }}">@lang('backend_skills.menus.create')</a>
                {{-- <a class="dropdown-item" href="{{ route('admin.skills.deactivated') }}">@lang('backed_skills.menus.deactivated')</a> --}}
                <a class="dropdown-item" href="{{ route('admin.skills.deleted') }}">@lang('backend_skills.menus.deleted')</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
