<?php

namespace App\Repositories\JTL;


use App\Models\Jtl\JtlArtikelBeschreibung;
use App\Repositories\BaseRepository;

class JtlArtikelBeschreibungRepository extends BaseRepository
{
    public function model()
    {
        return JtlArtikelBeschreibung::class;
    }
}