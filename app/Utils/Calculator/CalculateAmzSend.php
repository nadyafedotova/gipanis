<?php

namespace App\Utils\Calculator;


class CalculateAmzSend
{
    protected $products;

    protected $afnStockToGo;

    protected $available = [];

    protected $priority;

    protected $basekArtikel;

    public function __construct(array $products, array $available)
    {
        $this->products = $products;
        $this->available = $available;
    }

    public function calculate()
    {
        foreach ($this->products as $kArtikel => $product) {

            if (!is_null($product['stueckliste_child'])) {
                if (!empty($product['composite_artikel'])) {
                    $this->products[$kArtikel]['calculate']['availableForAFN'] = $this->calculateAvailable($product['composite_artikel']);

                }
                $afnStockToGo = $this->calculateStuecklisteProduct($product);
                $afnStockToGo[0] = $this->setAfnStockToGo($afnStockToGo[0], $product);
                $this->products[$kArtikel]['calculate']['afnStockToGo'] = $afnStockToGo;

//                if(is_numeric($afnStockToGo[0])) {
//                    $this->available[$kArtikel] -= $afnStockToGo[0];
//                }
            } else {
                $this->products[$kArtikel]['calculate']['availableForAFN'] = !empty($this->available[$kArtikel]) ? $this->available[$kArtikel] : 0;
                $afnStockToGo = $this->calculateOneProduct($product);
                $afnStockToGo = $this->setAfnStockToGo($afnStockToGo, $product);
                if (is_numeric($afnStockToGo)) {
                    if(isset($this->available[$kArtikel])) {
                        $this->available[$kArtikel] -= $afnStockToGo;
                    } else {
                        $this->available[$kArtikel] = 0;
                    }

                }

                $this->products[$kArtikel]['calculate']['afnStockToGo'] = $afnStockToGo;
            }
            $this->afnStockToGo[$kArtikel] = $afnStockToGo;
        }

        return $this->products;
    }

    protected function calculateOneProduct($product)
    {
        $available = !empty($this->available[$product['kArtikel']])? $this->available[$product['kArtikel']]: 0;

        if ($product['calculate']['afnStockNeeded'] <= 0) {
            $afnStockToGo = 0;
        } elseif ($product['calculate']['afnStockNeeded'] > 0 && $product['calculate']['afnStockNeeded'] <= $available) {

            $afnStockToGo = $product['calculate']['afnStockNeeded'];

        } else {
            $afnStockToGo = ($available > 0) ? $available : 0;
        }
        return $afnStockToGo;
    }

    protected function calculateStuecklisteProduct($product)
    {

        $afnStockToGo = [];
        if ($product['calculate']['afnStockNeeded'] <= 0) {
            $afnStockToGo[0] = 0;
            foreach ($product['composite_artikel'] as $key => $composeProduct) {
                $afnStockToGo['composite_artikel'][$key] = 0;
            }
        } else {
            foreach ($product['composite_artikel'] as $key => $composeProduct) {
                $afnStockToGoCompose = $this->calculateOneProduct($composeProduct);
                $afnStockToGoComposeList[$composeProduct['kArtikel']]['calculate']['afnStockToGo'] = $afnStockToGoCompose;
                if ($afnStockToGoCompose == 0) {
                    $percents[$composeProduct['kArtikel']] = 0;
                } else {
                    $percents[$composeProduct['kArtikel']] = $afnStockToGoCompose * 100 / $composeProduct['calculate']['afnStockNeeded'];
                }

            }
            arsort($percents);
            $minToGoPercent = end($percents);

            if ($minToGoPercent == 0) {
                $afnStockToGo[0] = 0;
            } else {
                $afnStockToGo[0] = ceil(100 * $minToGoPercent / $product['calculate']['afnStockNeeded']);
            }
            $afnStockToGo['composite_artikel'] = $afnStockToGoComposeList;
        }


        return $this->setAfnStockToGo($afnStockToGo, $product);
    }

    protected function calculateAvailable(array $products)
    {
        foreach ($products as $product) {
            $availableList[] = $this->available[$product['kArtikel']];
        }
        return min($availableList);
    }

    protected function isCheck($product)
    {

        if ($product['AMALogik'] == 0
            && !empty($product['ASIN'])
            && $product['AFNSales'] < 0.1
            && !empty($product['FVerfuegbar'])
        ) {
            if ($product['AMZInStockDays'] == 35
                && $product['AFNQuantity'] == 0
            ) {
                return 0;
            } else if($product['AMZInStockDays'] >9 ) {
                return 0;
            }
            return 'check';
        } else {
            return 0;
        }
    }

    protected function isAsinMissing($product)
    {
        if (empty($product['ASIN'])
            && !empty($product['FVerfuegbar'])
        ) {
            return 'asin missing';
        } else {
            return 0;
        }
    }

    protected function setAfnStockToGo($afnStockToGo, $product)
    {
        $status = ['isCheck', 'isAsinMissing'];
        while ($afnStockToGo == 0 && !empty($status)) {
            $method = array_shift($status);
            $afnStockToGo = $this->{$method}($product);
            if (!empty($afnStockToGo)) {
                break;
            }

        }
        return $afnStockToGo;
    }
}