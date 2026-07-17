<?php

namespace App\Repositories\Eloquent;

use App\Models\Setting;
use App\Repositories\Contracts\SettingRepositoryInterface;
use Illuminate\Support\Collection;

class SettingRepository extends BaseRepository implements SettingRepositoryInterface
{
    public function __construct(Setting $model)
    {
        parent::__construct($model);
    }

    public function getAllKeyValue(): Collection
    {
        return $this->model
            ->pluck('value', 'key');
    }

    public function updateMany(array $settings): void
    {
        foreach ($settings as $key => $value) {
            $this->model->updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}
