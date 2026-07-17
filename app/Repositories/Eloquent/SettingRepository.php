<?php

namespace App\Repositories\Eloquent;

use App\Models\Setting;
use App\Repositories\Contracts\SettingRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class SettingRepository extends BaseRepository implements SettingRepositoryInterface
{
    public function __construct(Setting $model)
    {
        parent::__construct($model);
    }

    public function getAllKeyValue(): Collection
    {
        return Cache::rememberForever(
            'settings.all',
            fn () => $this->model->pluck('value', 'key')
        );
    }

    public function get(string $key,mixed $default = null): mixed
    {
        return Cache::rememberForever(
            "setting.{$key}",
            fn () => $this->model
                ->where('key', $key)
                ->value('value')
                ?? $default
        );
    }

    public function set(string $key,mixed $value): void
    {
        $this->model->updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        Cache::forget("setting.{$key}");
        Cache::forget('settings.all');
    }

    public function updateMany(array $settings): void
    {
        foreach ($settings as $key => $value) {
            $this->set($key, $value);
        }
    }
}
