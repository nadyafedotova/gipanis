<?php

namespace App\Repositories\JTL;


use App\Models\Jtl\JtlMerkmalSprache;
use App\Repositories\BaseRepository;

class JtlMerkmalSpracheRepository extends BaseRepository
{

    public function model()
    {
        return JtlMerkmalSprache::class;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function merkmalsColumnX04($ids = null)
    {
        $this->newQuery();

        if($ids) {
            $this->query->whereIn('kMerkmal', $ids);
        }

        $models = $this->query
            ->where('kSprache', 1)
            ->get(['kMerkmal', 'cName']);
        return $models;
    }
}