<?php

namespace App\Services\Contracts;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;

interface SettingServiceInterface
{
    public function index(): Collection;

    public function get(
        string $key,
        mixed $default = null
    ): mixed;

    public function update(array $settings): RedirectResponse;
}
