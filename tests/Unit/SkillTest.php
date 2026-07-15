<?php

namespace Tests\Unit;

use App\Models\Skill;
use Tests\TestCase;

class SkillTest extends TestCase
{
    public function test_portfolio_skills_can_be_loaded_from_config(): void
    {
        config()->set('portfolio.skills', [
            ['name' => 'Configured Skill', 'category' => 'Backend', 'proficiency' => 99, 'sort_order' => 1],
        ]);

        $skills = Skill::portfolioSkills();

        $this->assertCount(1, $skills);
        $this->assertSame('Configured Skill', $skills->first()['name']);
    }
}
