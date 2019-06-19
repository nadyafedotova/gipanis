<?php


namespace App\Utils\Calculator;

use App\Utils\Calculator\Entity\CalculatorComplexProductEntity;
use App\Utils\Calculator\Entity\CalculatorProductEntity;

class Calculator
{
    protected $interval;

    protected $products;

    public function __construct(array $products, int $interval)
    {
        $this->interval = $interval;

        $this->products = $products;
    }

    public function calculate()
    {
        foreach ($this->products as $product) {

            $product = (array)$product;

            $product['calculate'] = (new CalculatorProductEntity($product, $this->interval))->calculate();
            $productsByKArtikel[$product['kArtikel']] = $product;
            if ($product['kType'] == 'h') {

                $available[$product['kArtikel']] = $product['calculate']['availableForAFN'];
            }

            if (($product['kType'] == 's' || $product['kType'] == 's,c') && !is_null($product['stueckliste_child'])) {
                $stueckliste_child[$product['kArtikel']] = json_decode($product['stueckliste_child'], true);
            }

        }
//        echo '<pre>';
//        print_r($stueckliste_child);
//        echo '</pre>';
//            exit();
        foreach ($stueckliste_child as $kArtikel => $childs) {
            $parent = $productsByKArtikel[$kArtikel];
            $composite_artikel = [];
            $availableForStuckliste = [];
            foreach ($childs as $child) {
                $product = $productsByKArtikel[$child['kArtikel']];
                $product['fAnzahl'] = $child['fAnzahl'];

                $product['calculate'] = (new CalculatorComplexProductEntity($product, $parent, $this->interval))->calculate();

                $composite_artikel[$child['kArtikel']] = $product;
                $availableForStuckliste[$child['kArtikel']] = floor($product['calculate']['availableForAFN'] / $child['fAnzahl']);
            }

            $productsByKArtikel[$kArtikel]['composite_artikel'] = $composite_artikel;
            $productsByKArtikel[$kArtikel]['calculate']['availableForAFN'] = min($availableForStuckliste);
        }
        return compact('productsByKArtikel', 'available');
    }
}