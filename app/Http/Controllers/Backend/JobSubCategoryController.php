<?php

namespace App\Http\Controllers\Backend;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\JobSubCategory;
use App\Repositories\Backend\JobSubCategoryRepository;
use App\Http\Requests\Backend\JobSubCategory\ManageJobSubCategoryRequest;
use App\Http\Requests\Backend\JobSubCategory\StoreJobSubCategoryRequest;
use App\Http\Requests\Backend\JobSubCategory\UpdateJobSubCategoryRequest;

use App\Events\Backend\JobSubCategory\JobSubCategoryCreated;
use App\Events\Backend\JobSubCategory\JobSubCategoryUpdated;
use App\Events\Backend\JobSubCategory\JobSubCategoryDeleted;

class JobSubCategoryController extends Controller
{
    /**
     * @var JobSubCategoryRepository
     */
    protected $job_sub_categoryRepository;

    /**
     * JobSubCategoryController constructor.
     *
     * @param JobSubCategoryRepository $job_sub_categoryRepository
     */
    public function __construct(JobSubCategoryRepository $job_sub_categoryRepository)
    {
        $this->job_sub_categoryRepository = $job_sub_categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ManageJobSubCategoryRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageJobSubCategoryRequest $request)
    {
        return view('backend.job_sub_category.index')
            ->withjobSubCategories($this->job_sub_categoryRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ManageJobSubCategoryRequest    $request
     *
     * @return mixed
     */
    public function create(ManageJobSubCategoryRequest $request)
    {
        return view('backend.job_sub_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreJobSubCategoryRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreJobSubCategoryRequest $request)
    {
        $this->job_sub_categoryRepository->create($request->only(
            'name'
        ));

        // Fire create event (JobSubCategoryCreated)
        event(new JobSubCategoryCreated($request));

        return redirect()->route('admin.job_sub_categories.index')
            ->withFlashSuccess(__('backend_job_sub_categories.alerts.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param ManageJobSubCategoryRequest  $request
     * @param JobSubCategory               $jobSubCategory
     *
     * @return mixed
     */
    public function show(ManageJobSubCategoryRequest $request, JobSubCategory $jobSubCategory)
    {
        return view('backend.job_sub_category.show')->withJobSubCategory($jobSubCategory);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ManageJobSubCategoryRequest $request
     * @param JobSubCategory              $jobSubCategory
     *
     * @return mixed
     */
    public function edit(ManageJobSubCategoryRequest $request, JobSubCategory $jobSubCategory)
    {
        return view('backend.job_sub_category.edit')->withJobSubCategory($jobSubCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateJobSubCategoryRequest  $request
     * @param JobSubCategory               $jobSubCategory
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateJobSubCategoryRequest $request, JobSubCategory $jobSubCategory)
    {
        $this->job_sub_categoryRepository->update($jobSubCategory, $request->only(
            'name'
        ));

        // Fire update event (JobSubCategoryUpdated)
        event(new JobSubCategoryUpdated($request));

        return redirect()->route('admin.job_sub_categories.index')
            ->withFlashSuccess(__('backend_job_sub_categories.alerts.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManageJobSubCategoryRequest $request
     * @param JobSubCategory              $jobSubCategory
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageJobSubCategoryRequest $request, JobSubCategory $jobSubCategory)
    {
        $this->job_sub_categoryRepository->deleteById($jobSubCategory->id);

        // Fire delete event (JobSubCategoryDeleted)
        event(new JobSubCategoryDeleted($request));

        return redirect()->route('admin.job_sub_categories.deleted')
            ->withFlashSuccess(__('backend_job_sub_categories.alerts.deleted'));
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param ManageJobSubCategoryRequest $request
     * @param JobSubCategory              $deletedJobSubCategory
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManageJobSubCategoryRequest $request, JobSubCategory $deletedJobSubCategory)
    {
        $this->job_sub_categoryRepository->forceDelete($deletedJobSubCategory);

        return redirect()->route('admin.job_sub_categories.deleted')
            ->withFlashSuccess(__('backend_job_sub_categories.alerts.deleted_permanently'));
    }

    /**
     * @param ManageJobSubCategoryRequest $request
     * @param JobSubCategory              $deletedJobSubCategory
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManageJobSubCategoryRequest $request, JobSubCategory $deletedJobSubCategory)
    {
        $this->job_sub_categoryRepository->restore($deletedJobSubCategory);

        return redirect()->route('admin.job_sub_categories.index')
            ->withFlashSuccess(__('backend_job_sub_categories.alerts.restored'));
    }

    /**
     * Display a listing of deleted items of the resource.
     *
     * @param ManageJobSubCategoryRequest $request
     *
     * @return mixed
     */
    public function deleted(ManageJobSubCategoryRequest $request)
    {
        return view('backend.job_sub_category.deleted')
            ->withjobSubCategories($this->job_sub_categoryRepository->getDeletedPaginated(25, 'id', 'asc'));
    }
}
