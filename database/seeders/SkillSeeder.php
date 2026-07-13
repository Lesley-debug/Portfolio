<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            ['name' => 'PHP',          'category' => 'Backend',  'proficiency' => 85, 'sort_order' => 1],
            ['name' => 'Laravel',      'category' => 'Backend',  'proficiency' => 80, 'sort_order' => 2],
            ['name' => 'REST APIs',    'category' => 'Backend',  'proficiency' => 65, 'sort_order' => 3],
            ['name' => 'Livewire',     'category' => 'Backend',  'proficiency' => 60, 'sort_order' => 4],
            ['name' => 'JavaScript',   'category' => 'Frontend', 'proficiency' => 65, 'sort_order' => 5],
            ['name' => 'React',        'category' => 'Frontend', 'proficiency' => 55, 'sort_order' => 6],
            ['name' => 'HTML & CSS',   'category' => 'Frontend', 'proficiency' => 80, 'sort_order' => 7],
            ['name' => 'Bootstrap',    'category' => 'Frontend', 'proficiency' => 75, 'sort_order' => 8],
            ['name' => 'MySQL',        'category' => 'Database', 'proficiency' => 80, 'sort_order' => 9],
            ['name' => 'XAMPP',        'category' => 'Database', 'proficiency' => 75, 'sort_order' => 10],
            ['name' => 'Git & GitHub', 'category' => 'Tools',    'proficiency' => 70, 'sort_order' => 11],
            ['name' => 'Docker',       'category' => 'Tools',    'proficiency' => 55, 'sort_order' => 12],
            ['name' => 'Linux / Bash', 'category' => 'Tools',    'proficiency' => 60, 'sort_order' => 13],
            ['name' => 'Lucidchart',   'category' => 'Tools',    'proficiency' => 70, 'sort_order' => 14],
        ];
        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }
}
