<?php

use App\Models\Jtl\JtlAttribut;
use Faker\Generator;

$factory->define(JtlAttribut::class, function (Generator $faker) {
    return [
        'kAttribut' => 9,
        'nIstMehrsprachig' => 1,
        'nIstFreifeld' => 0,
        'nSortierung' => 1,
        'cBeschreibung' => 'Bullet Point 2',
        'nBezugstyp' => 0,
        'nAusgabeweg' => 0,
        'nIstStandard' => 0,
        'kFeldTyp' => 3,
        'cRegEx' => null,
        'cGruppeName' => 'Amazon',
        'nReadOnly' => 0,
        'bRowversion' => null,
    ];
});