<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('backend_organisations.menus.main')</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.organisations.index') }}">@lang('backend_organisations.menus.all')</a>
                <a class="dropdown-item" href="{{ route('admin.organisations.create') }}">@lang('backend_organisations.menus.create')</a>
                {{-- <a class="dropdown-item" href="{{ route('admin.organisations.deactivated') }}">@lang('backed_organisations.menus.deactivated')</a> --}}
                <a class="dropdown-item" href="{{ route('admin.organisations.deleted') }}">@lang('backend_organisations.menus.deleted')</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
