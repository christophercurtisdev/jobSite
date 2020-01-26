<?php

namespace App\Repositories\Backend;

use App\Exceptions\GeneralException;
use App\Models\Organisation;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Class OrganisationRepository.
 */
class OrganisationRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Organisation::class;
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
     * @return Organisation
     * @throws \Exception
     * @throws \Throwable
     */
    public function create(array $data) : Organisation
    {
        return DB::transaction(function () use ($data) {
            $organisation = parent::create([
                'name' => $data['name'],
            ]);

            if ($organisation) {
                return $organisation;
            }

            throw new GeneralException(__('backend_organisations.exceptions.create_error'));
        });
    }

    /**
     * @param Organisation  $organisation
     * @param array     $data
     *
     * @return Organisation
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Organisation $organisation, array $data) : Organisation
    {
        return DB::transaction(function () use ($organisation, $data) {
            if ($organisation->update([
                'name' => $data['name'],
            ])) {

                return $organisation;
            }

            throw new GeneralException(__('backend_organisations.exceptions.update_error'));
        });
    }

    /**
     * @param Organisation $organisation
     *
     * @return Organisation
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     */
    public function forceDelete(Organisation $organisation) : Organisation
    {
        if (is_null($organisation->deleted_at)) {
            throw new GeneralException(__('backend_organisations.exceptions.delete_first'));
        }

        return DB::transaction(function () use ($organisation) {
            if ($organisation->forceDelete()) {
                return $organisation;
            }

            throw new GeneralException(__('backend_organisations.exceptions.delete_error'));
        });
    }

    /**
     * Restore the specified soft deleted resource.
     *
     * @param Organisation $organisation
     *
     * @return Organisation
     * @throws GeneralException
     */
    public function restore(Organisation $organisation) : Organisation
    {
        if (is_null($organisation->deleted_at)) {
            throw new GeneralException(__('backend_organisations.exceptions.cant_restore'));
        }

        if ($organisation->restore()) {
            return $organisation;
        }

        throw new GeneralException(__('backend_organisations.exceptions.restore_error'));
    }
}
