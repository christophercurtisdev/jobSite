<li class="nav-item">
    <a class="nav-link {{ active_class(Active::checkUriPattern('admin/job_categories*')) }}" href="{{ route('admin.job_categories.index') }}">
        <i class="nav-icon icon-folder"></i> @lang('backend_job_categories.sidebar.title')
    </a>
</li>