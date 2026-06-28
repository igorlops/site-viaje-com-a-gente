<?php

namespace App\Repositories;

use App\Models\SiteSetting;
use Illuminate\Support\Collection;

class SiteSettingRepository
{
    public function all(): Collection
    {
        return SiteSetting::orderBy('group')->orderBy('order')->get();
    }

    public function allGrouped(): \Illuminate\Support\Collection
    {
        return $this->all()->groupBy('group');
    }

    public function findById(int $id): SiteSetting
    {
        return SiteSetting::findOrFail($id);
    }

    public function findByKey(string $key): ?SiteSetting
    {
        return SiteSetting::where('key', $key)->first();
    }

    public function update(SiteSetting $setting, array $data): SiteSetting
    {
        $setting->update($data);
        return $setting->fresh();
    }
}
