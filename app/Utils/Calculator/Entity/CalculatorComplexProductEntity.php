<?php

namespace App\Utils\Calculator\Entity;

class CalculatorComplexProductEntity extends CalculatorEntity
{

    protected $parent;

    public function __construct(array $product, array $parent, int $interval)
    {
        $this->product = $product;

        $this->parent = $parent;

        if (empty($this->product['fAnzahl'])) {
            $this->product['fAnzahl'] = 1;
        }
        $this->interval = $interval;
    }

    public function demandMFN()
    {
        $this->calculate['demandMFN'] = $this->demand($this->parent['MFNSales'], $this->product['fAnzahl'], $this->interval);
    }

    public function demandMFNParent()
    {
        $this->calculate['demandMFNParent'] = $this->demand($this->product['MFNTotalSales'], 1, $this->interval);

    }

    public function demandAFN()
    {
        $this->calculate['demandAFN'] = $this->demand($this->parent['AFNSales'], $this->product['fAnzahl'], $this->interval);
    }

    public function demandAFNParent()
    {
        $this->calculate['demandAFNParent'] = $this->demand($this->product['AFNTotalSales'], 1, $this->interval);
    }

    public function totalDemandSingle()
    {
        $this->calculate['totalDemandSingle'] = $this->calculate['demandMFN'] + $this->calculate['demandAFN'];
    }

    public function afnStockNeeded()
    {
        $this->calculate['afnStockNeeded'] = ($this->product['AFNQuantity'] >= $this->calculate['demandAFN']) ? 0 : $this->calculate['demandAFN'] - $this->product['AFNQuantity'];

        if (
            $this->calculate['afnStockNeeded'] == 0
            && $this->product['AMALogik'] == 0
            && !empty($this->product['ASIN'])
            && $this->product['FVerfuegbar'] > 20
            && $this->product['AFNSales'] < 0.1
            && $this->product['AFNQuantity'] == 0
        ) {
            $this->calculate['afnStockNeeded'] = 10;
        }
    }

    public function afnStockNeededParent()
    {
        $this->calculate['afnStockNeededParent'] = ($this->product['AFNQuantity'] >= $this->calculate['demandAFNParent']) ? 0 : $this->calculate['demandAFNParent'] - $this->product['AFNQuantity'];
        if ($this->calculate['afnStockNeededParent'] == 0 && $this->calculate['afnStockNeeded'] == 10) {
            $this->calculate['afnStockNeededParent'] == 10;
        }
    }

    public function availableForAFN()
    {
        $this->calculate['availableForAFN'] = $this->product['FVerfuegbar'] - $this->calculate['demandMFNParent'];
    }
}