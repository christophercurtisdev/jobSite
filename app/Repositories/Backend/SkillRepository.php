<?php

namespace App\Repositories\Backend;

use App\Exceptions\GeneralException;
use App\Models\Skill;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class SkillRepository.
 */
class SkillRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Skill::class;
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
     * @return Skill
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : Skill
    {
        return DB::transaction(function () use ($data) {
            $skill = parent::create([
                'name' => $data['name'],
            ]);

            if ($skill) {
                return $skill;
            }

            throw new GeneralException(__('backend_skills.exceptions.create_error'));
        });
    }

    /**
     * @param Skill  $skill
     * @param array     $data
     *
     * @return Skill
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Skill $skill, array $data) : Skill
    {
        return DB::transaction(function () use ($skill, $data) {
            if ($skill->update([
                'name' => $data['name'],
            ])) {

                return $skill;
            }

            throw new GeneralException(__('backend_skills.exceptions.update_error'));
        });
    }

    /**
     * @param Skill $skill
     *
     * @return Skill
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(Skill $skill) : Skill
    {
        if (is_null($skill->deleted_at)) {
            throw new GeneralException(__('backend_skills.exceptions.delete_first'));
        }

        return DB::transaction(function () use ($skill) {
            if ($skill->forceDelete()) {
                return $skill;
            }

            throw new GeneralException(__('backend_skills.exceptions.delete_error'));
        });
    }

    /**
     * Restore the specified soft deleted resource.
     *
     * @param Skill $skill
     *
     * @return Skill
     * @throws GeneralException
     */
    public function restore(Skill $skill) : Skill
    {
        if (is_null($skill->deleted_at)) {
            throw new GeneralException(__('backend_skills.exceptions.cant_restore'));
        }

        if ($skill->restore()) {
            return $skill;
        }

        throw new GeneralException(__('backend_skills.exceptions.restore_error'));
    }
}
