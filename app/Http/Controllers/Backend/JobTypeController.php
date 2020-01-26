<?php

namespace App\Http\Controllers\Backend;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\JobType;
use App\Repositories\Backend\JobTypeRepository;
use App\Http\Requests\Backend\JobType\ManageJobTypeRequest;
use App\Http\Requests\Backend\JobType\StoreJobTypeRequest;
use App\Http\Requests\Backend\JobType\UpdateJobTypeRequest;

use App\Events\Backend\JobType\JobTypeCreated;
use App\Events\Backend\JobType\JobTypeUpdated;
use App\Events\Backend\JobType\JobTypeDeleted;

class JobTypeController extends Controller
{
    /**
     * @var JobTypeRepository
     */
    protected $job_typeRepository;

    /**
     * JobTypeController constructor.
     *
     * @param JobTypeRepository $job_typeRepository
     */
    public function __construct(JobTypeRepository $job_typeRepository)
    {
        $this->job_typeRepository = $job_typeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ManageJobTypeRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageJobTypeRequest $request)
    {
        return view('backend.job_type.index')
            ->withjobTypes($this->job_typeRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ManageJobTypeRequest    $request
     *
     * @return mixed
     */
    public function create(ManageJobTypeRequest $request)
    {
        return view('backend.job_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreJobTypeRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreJobTypeRequest $request)
    {
        $this->job_typeRepository->create($request->only(
            'name'
        ));

        // Fire create event (JobTypeCreated)
        event(new JobTypeCreated($request));

        return redirect()->route('admin.job_types.index')
            ->withFlashSuccess(__('backend_job_types.alerts.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param ManageJobTypeRequest  $request
     * @param JobType               $jobType
     *
     * @return mixed
     */
    public function show(ManageJobTypeRequest $request, JobType $jobType)
    {
        return view('backend.job_type.show')->withJobType($jobType);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ManageJobTypeRequest $request
     * @param JobType              $jobType
     *
     * @return mixed
     */
    public function edit(ManageJobTypeRequest $request, JobType $jobType)
    {
        return view('backend.job_type.edit')->withJobType($jobType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateJobTypeRequest  $request
     * @param JobType               $jobType
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateJobTypeRequest $request, JobType $jobType)
    {
        $this->job_typeRepository->update($jobType, $request->only(
            'name'
        ));

        // Fire update event (JobTypeUpdated)
        event(new JobTypeUpdated($request));

        return redirect()->route('admin.job_types.index')
            ->withFlashSuccess(__('backend_job_types.alerts.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManageJobTypeRequest $request
     * @param JobType              $jobType
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageJobTypeRequest $request, JobType $jobType)
    {
        $this->job_typeRepository->deleteById($jobType->id);

        // Fire delete event (JobTypeDeleted)
        event(new JobTypeDeleted($request));

        return redirect()->route('admin.job_types.deleted')
            ->withFlashSuccess(__('backend_job_types.alerts.deleted'));
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param ManageJobTypeRequest $request
     * @param JobType              $deletedJobType
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManageJobTypeRequest $request, JobType $deletedJobType)
    {
        $this->job_typeRepository->forceDelete($deletedJobType);

        return redirect()->route('admin.job_types.deleted')
            ->withFlashSuccess(__('backend_job_types.alerts.deleted_permanently'));
    }

    /**
     * @param ManageJobTypeRequest $request
     * @param JobType              $deletedJobType
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManageJobTypeRequest $request, JobType $deletedJobType)
    {
        $this->job_typeRepository->restore($deletedJobType);

        return redirect()->route('admin.job_types.index')
            ->withFlashSuccess(__('backend_job_types.alerts.restored'));
    }

    /**
     * Display a listing of deleted items of the resource.
     *
     * @param ManageJobTypeRequest $request
     *
     * @return mixed
     */
    public function deleted(ManageJobTypeRequest $request)
    {
        return view('backend.job_type.deleted')
            ->withjobTypes($this->job_typeRepository->getDeletedPaginated(25, 'id', 'asc'));
    }
}
