<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface SettingRepositoryInterface extends BaseRepositoryInterface
{
    public function getAllKeyValue(): Collection;

    public function updateMany(array $settings): void;
}
