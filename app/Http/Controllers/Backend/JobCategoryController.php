<?php

namespace App\Http\Controllers\Backend;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\JobCategory;
use App\Repositories\Backend\JobCategoryRepository;
use App\Http\Requests\Backend\JobCategory\ManageJobCategoryRequest;
use App\Http\Requests\Backend\JobCategory\StoreJobCategoryRequest;
use App\Http\Requests\Backend\JobCategory\UpdateJobCategoryRequest;

use App\Events\Backend\JobCategory\JobCategoryCreated;
use App\Events\Backend\JobCategory\JobCategoryUpdated;
use App\Events\Backend\JobCategory\JobCategoryDeleted;

class JobCategoryController extends Controller
{
    /**
     * @var JobCategoryRepository
     */
    protected $job_categoryRepository;

    /**
     * JobCategoryController constructor.
     *
     * @param JobCategoryRepository $job_categoryRepository
     */
    public function __construct(JobCategoryRepository $job_categoryRepository)
    {
        $this->job_categoryRepository = $job_categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ManageJobCategoryRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageJobCategoryRequest $request)
    {
        return view('backend.job_category.index')
            ->withjobCategories($this->job_categoryRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ManageJobCategoryRequest    $request
     *
     * @return mixed
     */
    public function create(ManageJobCategoryRequest $request)
    {
        return view('backend.job_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreJobCategoryRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreJobCategoryRequest $request)
    {
        $this->job_categoryRepository->create($request->only(
            'name'
        ));

        // Fire create event (JobCategoryCreated)
        event(new JobCategoryCreated($request));

        return redirect()->route('admin.job_categories.index')
            ->withFlashSuccess(__('backend_job_categories.alerts.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param ManageJobCategoryRequest  $request
     * @param JobCategory               $jobCategory
     *
     * @return mixed
     */
    public function show(ManageJobCategoryRequest $request, JobCategory $jobCategory)
    {
        return view('backend.job_category.show')->withJobCategory($jobCategory);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ManageJobCategoryRequest $request
     * @param JobCategory              $jobCategory
     *
     * @return mixed
     */
    public function edit(ManageJobCategoryRequest $request, JobCategory $jobCategory)
    {
        return view('backend.job_category.edit')->withJobCategory($jobCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateJobCategoryRequest  $request
     * @param JobCategory               $jobCategory
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateJobCategoryRequest $request, JobCategory $jobCategory)
    {
        $this->job_categoryRepository->update($jobCategory, $request->only(
            'name'
        ));

        // Fire update event (JobCategoryUpdated)
        event(new JobCategoryUpdated($request));

        return redirect()->route('admin.job_categories.index')
            ->withFlashSuccess(__('backend_job_categories.alerts.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManageJobCategoryRequest $request
     * @param JobCategory              $jobCategory
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageJobCategoryRequest $request, JobCategory $jobCategory)
    {
        $this->job_categoryRepository->deleteById($jobCategory->id);

        // Fire delete event (JobCategoryDeleted)
        event(new JobCategoryDeleted($request));

        return redirect()->route('admin.job_categories.deleted')
            ->withFlashSuccess(__('backend_job_categories.alerts.deleted'));
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param ManageJobCategoryRequest $request
     * @param JobCategory              $deletedJobCategory
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManageJobCategoryRequest $request, JobCategory $deletedJobCategory)
    {
        $this->job_categoryRepository->forceDelete($deletedJobCategory);

        return redirect()->route('admin.job_categories.deleted')
            ->withFlashSuccess(__('backend_job_categories.alerts.deleted_permanently'));
    }

    /**
     * @param ManageJobCategoryRequest $request
     * @param JobCategory              $deletedJobCategory
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManageJobCategoryRequest $request, JobCategory $deletedJobCategory)
    {
        $this->job_categoryRepository->restore($deletedJobCategory);

        return redirect()->route('admin.job_categories.index')
            ->withFlashSuccess(__('backend_job_categories.alerts.restored'));
    }

    /**
     * Display a listing of deleted items of the resource.
     *
     * @param ManageJobCategoryRequest $request
     *
     * @return mixed
     */
    public function deleted(ManageJobCategoryRequest $request)
    {
        return view('backend.job_category.deleted')
            ->withjobCategories($this->job_categoryRepository->getDeletedPaginated(25, 'id', 'asc'));
    }
}
