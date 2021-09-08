<?php

namespace App\Domain\Settings\Service;

use App\Base\Domain\Service;
use App\Domain\Settings\Repository\SettingsRepository;

class Settings extends Service
{

    protected $repository;
    public $settings = [];

    public function __construct(SettingsRepository $repository)
    {
        $this->repository = $repository;
        $this->setUp();
    }

    private function setUp()
    {
        $settings = $this->readAll();

        foreach ($settings as $row) {
            $this->settings[$row->setting] = $row->value;
        }
    }

    public function __get($setting)
    {
        return $this->settings[$setting];
    }

    public function __set($setting, $value)
    {
        $this->settings[$setting] = $value;
        return (bool) $this->update([
            'setting' => $setting,
            'value' => $value
        ]);
    }

    public function updateSettings($data)
    {
        // update normal records
        foreach ($data as $key => $value) $this->$key = $value;
        // commit the changes
        return true;
    }
}
