<?php

namespace App\Events\Backend\Skill;

use Illuminate\Queue\SerializesModels;

/**
 * Class SkillDeleted.
 */
class SkillDeleted
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
