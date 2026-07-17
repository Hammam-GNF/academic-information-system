<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSettingRequest;
use App\Services\Contracts\SettingServiceInterface;

class SettingController extends Controller
{
    public function __construct(
        protected SettingServiceInterface $settingService,
    ) {}

    public function index()
    {
        $settings = $this->settingService->index();

        return view('admin.settings.index', compact('settings')
        );
    }

    public function update(UpdateSettingRequest $request)
    {
        return $this->settingService->update(
            $request->validated()
        );
    }
}
