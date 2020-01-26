<li class="nav-item">
    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/jobs*')) }}" href="{{ route('admin.jobs.index') }}">
        <i class="nav-icon icon-folder"></i> @lang('backend_jobs.sidebar.title')
    </a>
</li>