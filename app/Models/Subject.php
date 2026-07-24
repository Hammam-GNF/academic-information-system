<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'department_id',
    'code',
    'name',
    'credit_hours',
    'description',
    'is_active',
])]
class Subject extends Model
{
    use SoftDeletes;

    public function department(): BelongsTo
    {
        return $this->belongsTo(
            Department::class
        );
    }

    protected function casts(): array
    {
        return [
            'credit_hours' => 'integer',
            'is_active' => 'boolean',
        ];
    }
}
