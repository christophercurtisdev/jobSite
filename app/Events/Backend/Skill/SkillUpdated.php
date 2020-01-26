<?php

namespace App\Events\Backend\Skill;

use Illuminate\Queue\SerializesModels;

/**
 * Class SkillUpdated.
 */
class SkillUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $skills;

    /**
     * @param $skills
     */
    public function __construct($skills)
    {
        $this->skills = $skills;
    }
}
