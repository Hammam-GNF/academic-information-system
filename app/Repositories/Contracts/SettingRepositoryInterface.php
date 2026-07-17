<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface SettingRepositoryInterface extends BaseRepositoryInterface
{
    public function getAllKeyValue(): Collection;

    public function get(
        string $key,
        mixed $default = null
    ): mixed;

    public function set(
        string $key,
        mixed $value
    ): void;

    public function updateMany(array $settings): void;
}
