<?php

namespace App\Http\Controllers\Backend;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Organisation;
use App\Repositories\Backend\OrganisationRepository;
use App\Http\Requests\Backend\Organisation\ManageOrganisationRequest;
use App\Http\Requests\Backend\Organisation\StoreOrganisationRequest;
use App\Http\Requests\Backend\Organisation\UpdateOrganisationRequest;

use App\Events\Backend\Organisation\OrganisationCreated;
use App\Events\Backend\Organisation\OrganisationUpdated;
use App\Events\Backend\Organisation\OrganisationDeleted;

class OrganisationController extends Controller
{
    /**
     * @var OrganisationRepository
     */
    protected $organisationRepository;

    /**
     * OrganisationController constructor.
     *
     * @param OrganisationRepository $organisationRepository
     */
    public function __construct(OrganisationRepository $organisationRepository)
    {
        $this->organisationRepository = $organisationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ManageOrganisationRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageOrganisationRequest $request)
    {
        return view('backend.organisation.index')
            ->withorganisations($this->organisationRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ManageOrganisationRequest    $request
     *
     * @return mixed
     */
    public function create(ManageOrganisationRequest $request)
    {
        return view('backend.organisation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrganisationRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreOrganisationRequest $request)
    {
        $this->organisationRepository->create($request->only(
            'name'
        ));

        // Fire create event (OrganisationCreated)
        event(new OrganisationCreated($request));

        return redirect()->route('admin.organisations.index')
            ->withFlashSuccess(__('backend_organisations.alerts.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param ManageOrganisationRequest  $request
     * @param Organisation               $organisation
     *
     * @return mixed
     */
    public function show(ManageOrganisationRequest $request, Organisation $organisation)
    {
        return view('backend.organisation.show')->withOrganisation($organisation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ManageOrganisationRequest $request
     * @param Organisation              $organisation
     *
     * @return mixed
     */
    public function edit(ManageOrganisationRequest $request, Organisation $organisation)
    {
        return view('backend.organisation.edit')->withOrganisation($organisation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOrganisationRequest  $request
     * @param Organisation               $organisation
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateOrganisationRequest $request, Organisation $organisation)
    {
        $this->organisationRepository->update($organisation, $request->only(
            'name'
        ));

        // Fire update event (OrganisationUpdated)
        event(new OrganisationUpdated($request));

        return redirect()->route('admin.organisations.index')
            ->withFlashSuccess(__('backend_organisations.alerts.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManageOrganisationRequest $request
     * @param Organisation              $organisation
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageOrganisationRequest $request, Organisation $organisation)
    {
        $this->organisationRepository->deleteById($organisation->id);

        // Fire delete event (OrganisationDeleted)
        event(new OrganisationDeleted($request));

        return redirect()->route('admin.organisations.deleted')
            ->withFlashSuccess(__('backend_organisations.alerts.deleted'));
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param ManageOrganisationRequest $request
     * @param Organisation              $deletedOrganisation
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManageOrganisationRequest $request, Organisation $deletedOrganisation)
    {
        $this->organisationRepository->forceDelete($deletedOrganisation);

        return redirect()->route('admin.organisations.deleted')
            ->withFlashSuccess(__('backend_organisations.alerts.deleted_permanently'));
    }

    /**
     * @param ManageOrganisationRequest $request
     * @param Organisation              $deletedOrganisation
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManageOrganisationRequest $request, Organisation $deletedOrganisation)
    {
        $this->organisationRepository->restore($deletedOrganisation);

        return redirect()->route('admin.organisations.index')
            ->withFlashSuccess(__('backend_organisations.alerts.restored'));
    }

    /**
     * Display a listing of deleted items of the resource.
     *
     * @param ManageOrganisationRequest $request
     *
     * @return mixed
     */
    public function deleted(ManageOrganisationRequest $request)
    {
        return view('backend.organisation.deleted')
            ->withorganisations($this->organisationRepository->getDeletedPaginated(25, 'id', 'asc'));
    }
}
