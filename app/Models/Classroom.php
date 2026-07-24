<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'department_id',
    'grade_id',
    'name',
    'capacity',
    'description',
    'is_active',
])]
class Classroom extends Model
{
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'capacity' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(
            Department::class
        );
    }

    public function grade(): BelongsTo
    {
        return $this->belongsTo(
            Grade::class
        );
    }
}
