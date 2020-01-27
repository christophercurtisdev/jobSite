<?php

namespace App\Http\Controllers\Backend;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\JobCompensationType;
use App\Repositories\Backend\JobCompensationTypeRepository;
use App\Http\Requests\Backend\JobCompensationType\ManageJobCompensationTypeRequest;
use App\Http\Requests\Backend\JobCompensationType\StoreJobCompensationTypeRequest;
use App\Http\Requests\Backend\JobCompensationType\UpdateJobCompensationTypeRequest;

use App\Events\Backend\JobCompensationType\JobCompensationTypeCreated;
use App\Events\Backend\JobCompensationType\JobCompensationTypeUpdated;
use App\Events\Backend\JobCompensationType\JobCompensationTypeDeleted;

class JobCompensationTypeController extends Controller
{
    /**
     * @var JobCompensationTypeRepository
     */
    protected $job_compensation_typeRepository;

    /**
     * JobCompensationTypeController constructor.
     *
     * @param JobCompensationTypeRepository $job_compensation_typeRepository
     */
    public function __construct(JobCompensationTypeRepository $job_compensation_typeRepository)
    {
        $this->job_compensation_typeRepository = $job_compensation_typeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ManageJobCompensationTypeRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageJobCompensationTypeRequest $request)
    {
        return view('backend.job_compensation_type.index')
            ->withjobCompensationTypes($this->job_compensation_typeRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ManageJobCompensationTypeRequest    $request
     *
     * @return mixed
     */
    public function create(ManageJobCompensationTypeRequest $request)
    {
        return view('backend.job_compensation_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreJobCompensationTypeRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreJobCompensationTypeRequest $request)
    {
        $this->job_compensation_typeRepository->create($request->only(
            'title'
        ));

        // Fire create event (JobCompensationTypeCreated)
        event(new JobCompensationTypeCreated($request));

        return redirect()->route('admin.job_compensation_types.index')
            ->withFlashSuccess(__('backend_job_compensation_types.alerts.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param ManageJobCompensationTypeRequest  $request
     * @param JobCompensationType               $jobCompensationType
     *
     * @return mixed
     */
    public function show(ManageJobCompensationTypeRequest $request, JobCompensationType $jobCompensationType)
    {
        return view('backend.job_compensation_type.show')->withJobCompensationType($jobCompensationType);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ManageJobCompensationTypeRequest $request
     * @param JobCompensationType              $jobCompensationType
     *
     * @return mixed
     */
    public function edit(ManageJobCompensationTypeRequest $request, JobCompensationType $jobCompensationType)
    {
        return view('backend.job_compensation_type.edit')->withJobCompensationType($jobCompensationType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateJobCompensationTypeRequest  $request
     * @param JobCompensationType               $jobCompensationType
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateJobCompensationTypeRequest $request, JobCompensationType $jobCompensationType)
    {
        $this->job_compensation_typeRepository->update($jobCompensationType, $request->only(
            'title'
        ));

        // Fire update event (JobCompensationTypeUpdated)
        event(new JobCompensationTypeUpdated($request));

        return redirect()->route('admin.job_compensation_types.index')
            ->withFlashSuccess(__('backend_job_compensation_types.alerts.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManageJobCompensationTypeRequest $request
     * @param JobCompensationType              $jobCompensationType
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageJobCompensationTypeRequest $request, JobCompensationType $jobCompensationType)
    {
        $this->job_compensation_typeRepository->deleteById($jobCompensationType->id);

        // Fire delete event (JobCompensationTypeDeleted)
        event(new JobCompensationTypeDeleted($request));

        return redirect()->route('admin.job_compensation_types.deleted')
            ->withFlashSuccess(__('backend_job_compensation_types.alerts.deleted'));
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param ManageJobCompensationTypeRequest $request
     * @param JobCompensationType              $deletedJobCompensationType
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManageJobCompensationTypeRequest $request, JobCompensationType $deletedJobCompensationType)
    {
        $this->job_compensation_typeRepository->forceDelete($deletedJobCompensationType);

        return redirect()->route('admin.job_compensation_types.deleted')
            ->withFlashSuccess(__('backend_job_compensation_types.alerts.deleted_permanently'));
    }

    /**
     * @param ManageJobCompensationTypeRequest $request
     * @param JobCompensationType              $deletedJobCompensationType
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManageJobCompensationTypeRequest $request, JobCompensationType $deletedJobCompensationType)
    {
        $this->job_compensation_typeRepository->restore($deletedJobCompensationType);

        return redirect()->route('admin.job_compensation_types.index')
            ->withFlashSuccess(__('backend_job_compensation_types.alerts.restored'));
    }

    /**
     * Display a listing of deleted items of the resource.
     *
     * @param ManageJobCompensationTypeRequest $request
     *
     * @return mixed
     */
    public function deleted(ManageJobCompensationTypeRequest $request)
    {
        return view('backend.job_compensation_type.deleted')
            ->withjobCompensationTypes($this->job_compensation_typeRepository->getDeletedPaginated(25, 'id', 'asc'));
    }
}
