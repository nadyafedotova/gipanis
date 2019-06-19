<?php

namespace App\Repositories\JTL;

use App\Models\Jtl\JtlAttribut;
use App\Repositories\BaseRepository;

class JtlAttributRepository extends BaseRepository
{

    public function model()
    {
        return JtlAttribut::class;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function attributesColumnX04($ids = null)
    {
        $this->newQuery();
        if($ids) {
            $this->query->whereIn('kAttribut', $ids);
        }
        $models = $this->query
            ->where('cGruppeName', 'Amazon')
            ->where('nIstMehrsprachig', 1)
            ->whereNotNull('cBeschreibung')
            ->get(['kAttribut', 'cBeschreibung']);
        return $models;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function customAttributesColumnX04($ids = null)
    {
        $this->newQuery();
        if($ids) {
            $this->query->whereIn('kAttribut', $ids);
        }
        $models = $this->query
            ->where('NAusgabeweg', '>', 0)
            ->whereNotNull('cBeschreibung')
            ->get(['kAttribut', 'cBeschreibung']);

        return $models;
    }

}