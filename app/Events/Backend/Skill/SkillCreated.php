<?php

namespace App\Events\Backend\Skill;

use Illuminate\Queue\SerializesModels;

/**
 * Class SkillCreated.
 */
class SkillCreated
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
