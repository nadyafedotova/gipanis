<?php

namespace App\Utils\Calculator\Entity;

abstract class CalculatorEntity
{
    /**
     * @var array
     */
    protected $product;

    /**
     * @var array
     */
    protected $calculate;

    /**
     * @var int
     */
    protected $interval;

    public function calculate()
    {
        $this->demandMFN();
        $this->demandMFNParent();
        $this->demandAFN();
        $this->demandAFNParent();
        $this->totalDemandSingle();
        $this->afnStockNeeded();
        $this->afnStockNeededParent();
        $this->availableForAFN();
        return $this->calculate;
    }

    abstract public function demandMFN();

    abstract public function demandMFNParent();

    abstract public function demandAFN();

    abstract public function demandAFNParent();

    abstract public function totalDemandSingle();

    abstract public function afnStockNeeded();

    abstract public function afnStockNeededParent();

    abstract public function availableForAFN();

    protected function demand($sale, $quantityProduct, $interval): int
    {
        return $sale * $quantityProduct * $interval;
    }

}