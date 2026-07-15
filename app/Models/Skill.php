<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Skill extends Model
{
    protected $fillable = [
        'name',
        'category',
        'proficiency',
        'sort_order',
    ];

    public static function portfolioSkills(): Collection
    {
        $configuredSkills = config('portfolio.skills', []);

        if (!empty($configuredSkills)) {
            return collect($configuredSkills)->sortBy('sort_order')->values();
        }

        return self::query()->orderBy('sort_order')->get();
    }
}
