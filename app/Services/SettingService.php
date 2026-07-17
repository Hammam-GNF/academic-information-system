<?php

namespace App\Services;

use App\Repositories\Contracts\SettingRepositoryInterface;
use App\Services\Contracts\SettingServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;

class SettingService implements SettingServiceInterface
{
    public function __construct(
        protected SettingRepositoryInterface $settingRepository,
    ) {}

    public function index(): Collection
    {
        return $this->settingRepository->getAllKeyValue();
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->settingRepository->get(
            $key,
            $default
        );
    }

    public function update(array $settings): RedirectResponse
    {
        $this->settingRepository->updateMany($settings);

        return back()->with(
            'success',
            'Settings updated successfully.'
        );
    }
}
