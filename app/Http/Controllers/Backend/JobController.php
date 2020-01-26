<?php

namespace App\Http\Controllers\Backend;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Job;
use App\Repositories\Backend\JobRepository;
use App\Http\Requests\Backend\Job\ManageJobRequest;
use App\Http\Requests\Backend\Job\StoreJobRequest;
use App\Http\Requests\Backend\Job\UpdateJobRequest;

use App\Events\Backend\Job\JobCreated;
use App\Events\Backend\Job\JobUpdated;
use App\Events\Backend\Job\JobDeleted;

class JobController extends Controller
{
    /**
     * @var JobRepository
     */
    protected $jobRepository;

    /**
     * JobController constructor.
     *
     * @param JobRepository $jobRepository
     */
    public function __construct(JobRepository $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ManageJobRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageJobRequest $request)
    {
        return view('backend.job.index')
            ->withjobs($this->jobRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ManageJobRequest    $request
     *
     * @return mixed
     */
    public function create(ManageJobRequest $request)
    {
        return view('backend.job.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreJobRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreJobRequest $request)
    {
        $this->jobRepository->create($request->only(
            'name'
        ));

        // Fire create event (JobCreated)
        event(new JobCreated($request));

        return redirect()->route('admin.jobs.index')
            ->withFlashSuccess(__('backend_jobs.alerts.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param ManageJobRequest  $request
     * @param Job               $job
     *
     * @return mixed
     */
    public function show(ManageJobRequest $request, Job $job)
    {
        return view('backend.job.show')->withJob($job);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ManageJobRequest $request
     * @param Job              $job
     *
     * @return mixed
     */
    public function edit(ManageJobRequest $request, Job $job)
    {
        return view('backend.job.edit')->withJob($job);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateJobRequest  $request
     * @param Job               $job
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateJobRequest $request, Job $job)
    {
        $this->jobRepository->update($job, $request->only(
            'name'
        ));

        // Fire update event (JobUpdated)
        event(new JobUpdated($request));

        return redirect()->route('admin.jobs.index')
            ->withFlashSuccess(__('backend_jobs.alerts.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManageJobRequest $request
     * @param Job              $job
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageJobRequest $request, Job $job)
    {
        $this->jobRepository->deleteById($job->id);

        // Fire delete event (JobDeleted)
        event(new JobDeleted($request));

        return redirect()->route('admin.jobs.deleted')
            ->withFlashSuccess(__('backend_jobs.alerts.deleted'));
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param ManageJobRequest $request
     * @param Job              $deletedJob
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManageJobRequest $request, Job $deletedJob)
    {
        $this->jobRepository->forceDelete($deletedJob);

        return redirect()->route('admin.jobs.deleted')
            ->withFlashSuccess(__('backend_jobs.alerts.deleted_permanently'));
    }

    /**
     * @param ManageJobRequest $request
     * @param Job              $deletedJob
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManageJobRequest $request, Job $deletedJob)
    {
        $this->jobRepository->restore($deletedJob);

        return redirect()->route('admin.jobs.index')
            ->withFlashSuccess(__('backend_jobs.alerts.restored'));
    }

    /**
     * Display a listing of deleted items of the resource.
     *
     * @param ManageJobRequest $request
     *
     * @return mixed
     */
    public function deleted(ManageJobRequest $request)
    {
        return view('backend.job.deleted')
            ->withjobs($this->jobRepository->getDeletedPaginated(25, 'id', 'asc'));
    }
}
