<?php

namespace App\Repositories\Backend;

use App\Exceptions\GeneralException;
use App\Models\JobCompensationType;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class JobCompensationTypeRepository.
 */
class JobCompensationTypeRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return JobCompensationType::class;
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
     * @return JobCompensationType
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : JobCompensationType
    {
        return DB::transaction(function () use ($data) {
            $job_compensation_type = parent::create([
                'title' => $data['title'],
            ]);

            if ($job_compensation_type) {
                return $job_compensation_type;
            }

            throw new GeneralException(__('backend_job_compensation_types.exceptions.create_error'));
        });
    }

    /**
     * @param JobCompensationType  $job_compensation_type
     * @param array     $data
     *
     * @return JobCompensationType
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(JobCompensationType $job_compensation_type, array $data) : JobCompensationType
    {
        return DB::transaction(function () use ($job_compensation_type, $data) {
            if ($job_compensation_type->update([
                'title' => $data['title'],
            ])) {

                return $job_compensation_type;
            }

            throw new GeneralException(__('backend_job_compensation_types.exceptions.update_error'));
        });
    }

    /**
     * @param JobCompensationType $job_compensation_type
     *
     * @return JobCompensationType
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(JobCompensationType $job_compensation_type) : JobCompensationType
    {
        if (is_null($job_compensation_type->deleted_at)) {
            throw new GeneralException(__('backend_job_compensation_types.exceptions.delete_first'));
        }

        return DB::transaction(function () use ($job_compensation_type) {
            if ($job_compensation_type->forceDelete()) {
                return $job_compensation_type;
            }

            throw new GeneralException(__('backend_job_compensation_types.exceptions.delete_error'));
        });
    }

    /**
     * Restore the specified soft deleted resource.
     *
     * @param JobCompensationType $job_compensation_type
     *
     * @return JobCompensationType
     * @throws GeneralException
     */
    public function restore(JobCompensationType $job_compensation_type) : JobCompensationType
    {
        if (is_null($job_compensation_type->deleted_at)) {
            throw new GeneralException(__('backend_job_compensation_types.exceptions.cant_restore'));
        }

        if ($job_compensation_type->restore()) {
            return $job_compensation_type;
        }

        throw new GeneralException(__('backend_job_compensation_types.exceptions.restore_error'));
    }
}
