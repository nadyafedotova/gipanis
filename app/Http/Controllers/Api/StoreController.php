<?php

namespace App\Http\Controllers\Api;

use App\Repositories\Amazon\AmzSettingsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    /***
     * @var AmzSettingsRepository
     */
    protected $amzSettingsRepository;

    /**
     * StoreController constructor.
     * @param AmzSettingsRepository $amzSettingsRepository
     */
    public function __construct(AmzSettingsRepository $amzSettingsRepository)
    {
        $this->amzSettingsRepository = $amzSettingsRepository;
    }

    public function getList()
    {
        return ['stores' => $this->amzSettingsRepository->getStoresList(), 'storeBase' => AmzSettingsRepository::STORE_BASE ];
    }
}
