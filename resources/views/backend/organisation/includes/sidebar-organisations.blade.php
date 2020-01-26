<li class="nav-item">
    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/organisations*')) }}" href="{{ route('admin.organisations.index') }}">
        <i class="nav-icon icon-folder"></i> @lang('backend_organisations.sidebar.title')
    </a>
</li>