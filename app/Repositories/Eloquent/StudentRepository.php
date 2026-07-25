<?php

namespace App\Repositories\Eloquent;

use App\Models\Student;
use App\Repositories\Contracts\StudentRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{
    public function __construct(Student $model)
    {
        parent::__construct($model);
    }

    public function query(): Builder
    {
        return $this->model
            ->newQuery()
            ->with([
                'classroom.department',
                'classroom.grade',
            ]);
    }

    public function findById(int $id): ?Student
    {
        return $this->query()
            ->find($id);
    }

    public function getActive(): Collection
    {
        return $this->query()
            ->where('is_active', true)
            ->get();
    }

    public function findByStudentNumber(
        string $studentNumber
    ): ?Student {

        return $this->query()
            ->where(
                'student_number',
                $studentNumber
            )
            ->first();
    }
}
