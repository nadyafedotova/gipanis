<?php
namespace App\Repositories\JTL;

use App\Models\Jtl\JtlHersteller;
use App\Repositories\BaseRepository;

class JtlHerstellerRepository extends BaseRepository
{

    public function model(): string
    {
        return JtlHersteller::class;
    }

}