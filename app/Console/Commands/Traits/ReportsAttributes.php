<?php

namespace App\Console\Commands\Traits;


use App\Models\Amazon\AmzDetailedSale;
use App\Models\Amazon\AmzFbaConverged;
use App\Models\Amazon\AmzFbaDailyReport;
use App\Models\Amazon\AmzFbaHistory;
use App\Models\Amazon\AmzFbaMerchant;
use App\Models\Amazon\AmzFbaMerchantInactive;
use App\Models\Amazon\AmzFbaReserved;
use App\Models\Amazon\AmzFees;
use App\Models\Amazon\AmzOrder;
use App\Models\Amazon\AmzOrderItem;
use App\Models\Amazon\AmzPrice;
use App\Models\Amazon\AmzProductList;
use App\Models\Amazon\AmzRating;
use App\Models\Amazon\AmzReview;
use App\Models\Amazon\AmzTask;
use App\Models\Amazon\Competitors;
use App\Models\Jtl\JtlArtikel;
use App\Models\Jtl\JtlArtikelAttribut;
use App\Models\Jtl\JtlArtikelAttributSprache;
use App\Models\Jtl\JtlArtikelBeschreibung;
use App\Models\Jtl\JtlArtikelMerkmal;
use App\Models\Jtl\JtlAttribut;
use App\Models\Jtl\JtlLagerbestand;
use App\Models\Jtl\JtlLagerplatzReport;
use App\Models\Jtl\JtlMerkmalSprache;
use App\Models\Jtl\JtlMerkmalWertSprache;
use App\Models\Jtl\JtlTbestellpos;
use App\Models\Jtl\JtlTBestellung;
use App\Models\Jtl\JtlTkategorie;
use App\Models\Jtl\JtlTkategorieartikel;
use App\Models\Jtl\JtlTKategorieSprache;
use App\Models\Jtl\JtlTliefartikel;
use App\Models\Jtl\JtlTlieferant;
use App\Models\Jtl\JtlTLieferantenBestellungPos;
use App\Models\Jtl\JtlTPlattform;
use App\Models\Jtl\JtlTStueckliste;
use App\Models\Jtl\JtlTWarenLagerEingang;
use App\Models\Jtl\JtlWarenlager;

trait ReportsAttributes
{
    public function listEntities(): array
    {
        return [
            'J01' => JtlArtikel::class,
            'J02' => JtlLagerbestand::class,
            'J03' => JtlLagerplatzReport::class,
            'J04' => JtlTbestellpos::class,
            'J05' => JtlTBestellung::class,
            'J06' => JtlTPlattform::class,
            'J07' => JtlWarenlager::class,
            'J08' => JtlTkategorie::class,
            'J09' => JtlTkategorieartikel::class,
            'J10' => JtlTKategorieSprache::class,
            'J11' => JtlTStueckliste::class,
            'J12' => JtlTliefartikel::class,
            'J13' => JtlTlieferant::class,
            'J14' => JtlTLieferantenBestellungPos::class,
            'J15' => JtlTWarenLagerEingang::class,
            'J16' => JtlArtikelAttribut::class,
            'J17' => JtlArtikelBeschreibung::class,
            'J18' => JtlArtikelAttributSprache::class,
            'J19' => JtlArtikelMerkmal::class,
            'J20' => JtlMerkmalSprache::class,
            'J21' => JtlAttribut::class,
            'J22' => JtlMerkmalWertSprache::class,
            'J23' => JtlTBestellung::class,
            'a01' => AmzFbaHistory::class,
            'a02' => AmzFbaReserved::class,
            'a03' => AmzFbaMerchant::class,
            'a04' => AmzFbaMerchantInactive::class,
            'a06' => AmzFbaConverged::class,
            'a07' => AmzFbaDailyReport::class,
            'a08' => AmzOrder::class,
            'a09' => AmzOrderItem::class,
            'a10' => AmzProductList::class,
            'a11' => AmzPrice::class,
            'a12' => AmzFees::class,
            'b01' => AmzDetailedSale::class,
            'p01' => AmzRating::class,
            'p02' => AmzReview::class,
            'p03' => Competitors::class,
            'p04' => AmzReview::class,
            'tasks' => AmzTask::class,
        ];
    }

    public function getEntityByCode(string $code):? string
    {
        $listEntities = $this->listEntities();
        return $listEntities[$code] ?? null;
    }

}