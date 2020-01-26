<?php

namespace App\Repositories\Backend;

use App\Exceptions\GeneralException;
use App\Models\JobCategory;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class JobCategoryRepository.
 */
class JobCategoryRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return JobCategory::class;
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
     * @return JobCategory
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : JobCategory
    {
        return DB::transaction(function () use ($data) {
            $job_category = parent::create([
                'name' => $data['name'],
            ]);

            if ($job_category) {
                return $job_category;
            }

            throw new GeneralException(__('backend_job_categories.exceptions.create_error'));
        });
    }

    /**
     * @param JobCategory  $job_category
     * @param array     $data
     *
     * @return JobCategory
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(JobCategory $job_category, array $data) : JobCategory
    {
        return DB::transaction(function () use ($job_category, $data) {
            if ($job_category->update([
                'name' => $data['name'],
            ])) {

                return $job_category;
            }

            throw new GeneralException(__('backend_job_categories.exceptions.update_error'));
        });
    }

    /**
     * @param JobCategory $job_category
     *
     * @return JobCategory
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(JobCategory $job_category) : JobCategory
    {
        if (is_null($job_category->deleted_at)) {
            throw new GeneralException(__('backend_job_categories.exceptions.delete_first'));
        }

        return DB::transaction(function () use ($job_category) {
            if ($job_category->forceDelete()) {
                return $job_category;
            }

            throw new GeneralException(__('backend_job_categories.exceptions.delete_error'));
        });
    }

    /**
     * Restore the specified soft deleted resource.
     *
     * @param JobCategory $job_category
     *
     * @return JobCategory
     * @throws GeneralException
     */
    public function restore(JobCategory $job_category) : JobCategory
    {
        if (is_null($job_category->deleted_at)) {
            throw new GeneralException(__('backend_job_categories.exceptions.cant_restore'));
        }

        if ($job_category->restore()) {
            return $job_category;
        }

        throw new GeneralException(__('backend_job_categories.exceptions.restore_error'));
    }
}
