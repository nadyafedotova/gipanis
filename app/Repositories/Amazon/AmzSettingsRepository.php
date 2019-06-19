<?php

namespace App\Repositories\Amazon;

use App\Models\Amazon\AmzSettings;
use App\Repositories\BaseRepository;

class AmzSettingsRepository extends BaseRepository
{

    const STORE_BASE = 1;

    /**
     * @return string
     */
    public function model(): string
    {
        return AmzSettings::class;
    }

    public function getStoresList()
    {
        $this->newQuery();
        return $this->query->get()->pluck('country','id')->toArray();
    }

    public function getStoresId()
    {
        $this->newQuery();
        return $this->query->get()->pluck('ratings','id')->toArray();
    }
}