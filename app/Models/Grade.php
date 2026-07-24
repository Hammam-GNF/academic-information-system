<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'code',
    'name',
    'minimum_score',
    'maximum_score',
    'grade_point',
    'description',
    'is_active',
])]
class Grade extends Model
{
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'minimum_score' => 'integer',
            'maximum_score' => 'integer',
            'grade_point' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function classrooms(): HasMany
    {
        return $this->hasMany(Classroom::class);
    }
}
