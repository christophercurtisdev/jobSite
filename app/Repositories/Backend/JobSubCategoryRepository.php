<?php

namespace App\Repositories\Backend;

use App\Exceptions\GeneralException;
use App\Models\JobSubCategory;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class JobSubCategoryRepository.
 */
class JobSubCategoryRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return JobSubCategory::class;
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
     * @return JobSubCategory
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : JobSubCategory
    {
        return DB::transaction(function () use ($data) {
            $job_sub_category = parent::create([
                'name' => $data['name'],
            ]);

            if ($job_sub_category) {
                return $job_sub_category;
            }

            throw new GeneralException(__('backend_job_sub_categories.exceptions.create_error'));
        });
    }

    /**
     * @param JobSubCategory  $job_sub_category
     * @param array     $data
     *
     * @return JobSubCategory
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(JobSubCategory $job_sub_category, array $data) : JobSubCategory
    {
        return DB::transaction(function () use ($job_sub_category, $data) {
            if ($job_sub_category->update([
                'name' => $data['name'],
            ])) {

                return $job_sub_category;
            }

            throw new GeneralException(__('backend_job_sub_categories.exceptions.update_error'));
        });
    }

    /**
     * @param JobSubCategory $job_sub_category
     *
     * @return JobSubCategory
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(JobSubCategory $job_sub_category) : JobSubCategory
    {
        if (is_null($job_sub_category->deleted_at)) {
            throw new GeneralException(__('backend_job_sub_categories.exceptions.delete_first'));
        }

        return DB::transaction(function () use ($job_sub_category) {
            if ($job_sub_category->forceDelete()) {
                return $job_sub_category;
            }

            throw new GeneralException(__('backend_job_sub_categories.exceptions.delete_error'));
        });
    }

    /**
     * Restore the specified soft deleted resource.
     *
     * @param JobSubCategory $job_sub_category
     *
     * @return JobSubCategory
     * @throws GeneralException
     */
    public function restore(JobSubCategory $job_sub_category) : JobSubCategory
    {
        if (is_null($job_sub_category->deleted_at)) {
            throw new GeneralException(__('backend_job_sub_categories.exceptions.cant_restore'));
        }

        if ($job_sub_category->restore()) {
            return $job_sub_category;
        }

        throw new GeneralException(__('backend_job_sub_categories.exceptions.restore_error'));
    }
}
