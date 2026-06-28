<?php

namespace App\DTOs\Admin;

use App\Http\Requests\Admin\SiteSettingRequest;

class SiteSettingDTO
{
    public function __construct(
        public readonly ?string $value,
        public readonly bool $hasImage,
    ) {}

    public static function fromRequest(SiteSettingRequest $request): self
    {
        return new self(
            value: $request->input('value'),
            hasImage: $request->hasFile('value'),
        );
    }
}
