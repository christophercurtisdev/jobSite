<li class="nav-item">
    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/job_types*')) }}" href="{{ route('admin.job_types.index') }}">
        <i class="nav-icon icon-folder"></i> @lang('backend_job_types.sidebar.title')
    </a>
</li>