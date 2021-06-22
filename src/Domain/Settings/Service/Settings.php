<?php

namespace App\Domain\Settings\Service;

use App\Domain\Settings\Repository\SettingsRepository;

class Settings
{

    private $repository;

    public function __construct(SettingsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function read(string $setting = null): array
    {
        return (array) $this->repository->read($setting);
    }

    public function update(string $setting, string $value): bool
    {
        return $this->repository->update($setting, $value);
    }
}
