<?php

namespace App\Repositories\Backend;

use App\Exceptions\GeneralException;
use App\Models\JobType;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class JobTypeRepository.
 */
class JobTypeRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return JobType::class;
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
     * @return JobType
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : JobType
    {
        return DB::transaction(function () use ($data) {
            $job_type = parent::create([
                'name' => $data['name'],
            ]);

            if ($job_type) {
                return $job_type;
            }

            throw new GeneralException(__('backend_job_types.exceptions.create_error'));
        });
    }

    /**
     * @param JobType  $job_type
     * @param array     $data
     *
     * @return JobType
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(JobType $job_type, array $data) : JobType
    {
        return DB::transaction(function () use ($job_type, $data) {
            if ($job_type->update([
                'name' => $data['name'],
            ])) {

                return $job_type;
            }

            throw new GeneralException(__('backend_job_types.exceptions.update_error'));
        });
    }

    /**
     * @param JobType $job_type
     *
     * @return JobType
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(JobType $job_type) : JobType
    {
        if (is_null($job_type->deleted_at)) {
            throw new GeneralException(__('backend_job_types.exceptions.delete_first'));
        }

        return DB::transaction(function () use ($job_type) {
            if ($job_type->forceDelete()) {
                return $job_type;
            }

            throw new GeneralException(__('backend_job_types.exceptions.delete_error'));
        });
    }

    /**
     * Restore the specified soft deleted resource.
     *
     * @param JobType $job_type
     *
     * @return JobType
     * @throws GeneralException
     */
    public function restore(JobType $job_type) : JobType
    {
        if (is_null($job_type->deleted_at)) {
            throw new GeneralException(__('backend_job_types.exceptions.cant_restore'));
        }

        if ($job_type->restore()) {
            return $job_type;
        }

        throw new GeneralException(__('backend_job_types.exceptions.restore_error'));
    }
}
