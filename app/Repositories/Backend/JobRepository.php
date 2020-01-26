<?php

namespace App\Repositories\Backend;

use App\Exceptions\GeneralException;
use App\Models\Job;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class JobRepository.
 */
class JobRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Job::class;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getDeletedPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->onlyTrashed()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param array $data
     *
     * @return Job
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : Job
    {
        return DB::transaction(function () use ($data) {
            $job = parent::create([
                'name' => $data['name'],
            ]);

            if ($job) {
                return $job;
            }

            throw new GeneralException(__('backend_jobs.exceptions.create_error'));
        });
    }

    /**
     * @param Job  $job
     * @param array     $data
     *
     * @return Job
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Job $job, array $data) : Job
    {
        return DB::transaction(function () use ($job, $data) {
            if ($job->update([
                'name' => $data['name'],
            ])) {

                return $job;
            }

            throw new GeneralException(__('backend_jobs.exceptions.update_error'));
        });
    }

    /**
     * @param Job $job
     *
     * @return Job
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(Job $job) : Job
    {
        if (is_null($job->deleted_at)) {
            throw new GeneralException(__('backend_jobs.exceptions.delete_first'));
        }

        return DB::transaction(function () use ($job) {
            if ($job->forceDelete()) {
                return $job;
            }

            throw new GeneralException(__('backend_jobs.exceptions.delete_error'));
        });
    }

    /**
     * Restore the specified soft deleted resource.
     *
     * @param Job $job
     *
     * @return Job
     * @throws GeneralException
     */
    public function restore(Job $job) : Job
    {
        if (is_null($job->deleted_at)) {
            throw new GeneralException(__('backend_jobs.exceptions.cant_restore'));
        }

        if ($job->restore()) {
            return $job;
        }

        throw new GeneralException(__('backend_jobs.exceptions.restore_error'));
    }
}
