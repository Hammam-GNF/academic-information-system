<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'code',
    'name',
    'description',
    'is_active',
])]
class Department extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function classrooms(): HasMany
    {
        return $this->hasMany(Classroom::class);
    }
}
