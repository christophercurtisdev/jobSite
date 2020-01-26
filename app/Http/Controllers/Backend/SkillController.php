<?php

namespace App\Http\Controllers\Backend;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Skill;
use App\Repositories\Backend\SkillRepository;
use App\Http\Requests\Backend\Skill\ManageSkillRequest;
use App\Http\Requests\Backend\Skill\StoreSkillRequest;
use App\Http\Requests\Backend\Skill\UpdateSkillRequest;

use App\Events\Backend\Skill\SkillCreated;
use App\Events\Backend\Skill\SkillUpdated;
use App\Events\Backend\Skill\SkillDeleted;

class SkillController extends Controller
{
    /**
     * @var SkillRepository
     */
    protected $skillRepository;

    /**
     * SkillController constructor.
     *
     * @param SkillRepository $skillRepository
     */
    public function __construct(SkillRepository $skillRepository)
    {
        $this->skillRepository = $skillRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ManageSkillRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageSkillRequest $request)
    {
        return view('backend.skill.index')
            ->withskills($this->skillRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ManageSkillRequest    $request
     *
     * @return mixed
     */
    public function create(ManageSkillRequest $request)
    {
        return view('backend.skill.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSkillRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreSkillRequest $request)
    {
        $this->skillRepository->create($request->only(
            'name'
        ));

        // Fire create event (SkillCreated)
        event(new SkillCreated($request));

        return redirect()->route('admin.skills.index')
            ->withFlashSuccess(__('backend_skills.alerts.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param ManageSkillRequest  $request
     * @param Skill               $skill
     *
     * @return mixed
     */
    public function show(ManageSkillRequest $request, Skill $skill)
    {
        return view('backend.skill.show')->withSkill($skill);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ManageSkillRequest $request
     * @param Skill              $skill
     *
     * @return mixed
     */
    public function edit(ManageSkillRequest $request, Skill $skill)
    {
        return view('backend.skill.edit')->withSkill($skill);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSkillRequest  $request
     * @param Skill               $skill
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateSkillRequest $request, Skill $skill)
    {
        $this->skillRepository->update($skill, $request->only(
            'name'
        ));

        // Fire update event (SkillUpdated)
        event(new SkillUpdated($request));

        return redirect()->route('admin.skills.index')
            ->withFlashSuccess(__('backend_skills.alerts.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManageSkillRequest $request
     * @param Skill              $skill
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageSkillRequest $request, Skill $skill)
    {
        $this->skillRepository->deleteById($skill->id);

        // Fire delete event (SkillDeleted)
        event(new SkillDeleted($request));

        return redirect()->route('admin.skills.deleted')
            ->withFlashSuccess(__('backend_skills.alerts.deleted'));
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param ManageSkillRequest $request
     * @param Skill              $deletedSkill
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManageSkillRequest $request, Skill $deletedSkill)
    {
        $this->skillRepository->forceDelete($deletedSkill);

        return redirect()->route('admin.skills.deleted')
            ->withFlashSuccess(__('backend_skills.alerts.deleted_permanently'));
    }

    /**
     * @param ManageSkillRequest $request
     * @param Skill              $deletedSkill
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManageSkillRequest $request, Skill $deletedSkill)
    {
        $this->skillRepository->restore($deletedSkill);

        return redirect()->route('admin.skills.index')
            ->withFlashSuccess(__('backend_skills.alerts.restored'));
    }

    /**
     * Display a listing of deleted items of the resource.
     *
     * @param ManageSkillRequest $request
     *
     * @return mixed
     */
    public function deleted(ManageSkillRequest $request)
    {
        return view('backend.skill.deleted')
            ->withskills($this->skillRepository->getDeletedPaginated(25, 'id', 'asc'));
    }
}
