<?php

namespace App\Utils\AmazonImport;

trait Columns
{

    protected $attibutesIds = [
        113, 119, 194, 195, 196, 197, 200, 201, 202, 204, 205, 206, 263
    ];

    protected $custom_attributes = [119];

    protected $merkal = [6, 12, 22, 27];

    protected $columns = [
        'base' => [
            'feed_product_type',
            'item_sku',
            'external_product_id',
            'external_product_id_type',
            'brand_name',
            'item_name',
            'manufacturer',
            'recommended_browse_nodes',
            'outer_material_type',
            'standard_price'
        ],
        'Bilder' => [

        ],
        'Varianten' => [

        ],
        'Grundlegende' => [
            'update_delete',
            'part_number',
            'product_description',
            'language_value1'
        ],
        'Artikelerkennungs' => [
            'bullet_point1',
            'bullet_point2',
            'bullet_point3',
            'bullet_point4',
            'bullet_point5',
            'generic_keywords',
            'target_audience_base',
            'catalog_number'
        ],
        'Ungruppiert' => [
            'color_name',
            'color_map',
            'size_name',
            'size_map',
            'material_type',
        ],
        'Abmessungen' => [
            'item_height',
            'item_length',
            'item_width',
            'item_length_unit_of_measure'
        ],
        'Versand' => [
            'fulfillment_center_id'
        ],
        'Konformitäts' => [
            'batteries_required'
        ],
        'Angebot' => [
            'condition_type'
        ],
        'b2b' => [

        ]
    ];
    /**
     * @var array
     *  "item_name" > 200 bytes
     *
     *
     *"generic_keywords" > 249 bytes
     *
     *"product_description" > 2.000 bytes
     *
     *summa "bullet_point1 + bullet_point2 + bullet_point3 + bullet_point4 + bullet_point5" >1.000 bytes
     */
    protected $limitBytes = [
        'item_name' => 200,
        'bullet_point' => 1000,
        'product_description' => 2000,
        'generic_keywords' => 249,
    ];

    protected $notEmpty = [
        'recommended_browse_nodes',
        'standard_price',
        'generic_keywords',
        'external_product_id',
    ];

    /**
     * @var array
     * attribute_113;
     * attribute_194;
     * attribute_195;
     * attribute_196;
     * attribute_197;
     */
    protected $bulletPointAttributes = [
        'attribute_113',
        'attribute_194',
        'attribute_195',
        'attribute_196',
        'attribute_197',
    ];


    /**
     * @return array
     */
    public function getAttibutes(): array
    {
        return $this->attibutesIds;
    }
    /**
     * @return array
     */
    public function getCustomAttributes(): array
    {
        return $this->custom_attributes;
    }

    /**
     * @return array
     */
    public function getMerkal(): array
    {
        return $this->merkal;
    }
    /** START BASE
     * 'feed_product_type',
     * 'item_sku',
     * 'external_product_id',
     * 'external_product_id_type',
     * 'brand_name',
     * 'item_name',
     * 'manufacturer',
     * 'recommended_browse_nodes',
     * 'outer_material_type',
     * 'standard_price'
     */
    protected function feed_product_type()
    {
        return $this->model->merkal_27;
    }

    protected function item_sku()
    {
        return $this->model->cArtNr;
    }

    protected function external_product_id()
    {
        return (string)$this->model->cBarcode;
    }

    protected function external_product_id_type()
    {
        return !empty($this->model->cBarcode) ? 'EAN' : '';
    }

    protected function brand_name()
    {
        return $this->model->hersteller;
    }

    protected function item_name()
    {
        return $this->model->cName;
    }

    protected function manufacturer()
    {
        return $this->model->hersteller;
    }

    protected function recommended_browse_nodes()
    {
        return $this->model->custom_attribute_119;
    }

    protected function outer_material_type()
    {
        return $this->model->attribute_263;
    }

    protected function standard_price()
    {
        return money_format('%!i', $this->model->fAmazonVK);
    }

    /** START Grundlegende
     * 'update_delete',
     * 'part_number',
     * 'product_description',
     * 'language_value1'
     */

    protected function update_delete()
    {
        return 'Aktualisierung';
    }

    protected function part_number()
    {
        return $this->model->ID;
    }

    protected function product_description()
    {
        return $this->model->cBeschreibung;
    }

    protected function language_value1()
    {
        return 'deutsch';
    }

    /** START Artikelerkennungs
     * 'bullet_point1',
     * 'bullet_point2',
     * 'bullet_point3',
     * 'bullet_point4',
     * 'bullet_point5',
     * 'generic_keywords',
     * 'target_audience_base',
     * 'catalog_number'
     */
    protected function bullet_point1()
    {
        return $this->model->attribute_113;
    }

    protected function bullet_point2()
    {
        return $this->model->attribute_194;
    }

    protected function bullet_point3()
    {
        return $this->model->attribute_195;
    }

    protected function bullet_point4()
    {
        return $this->model->attribute_196;
    }

    protected function bullet_point5()
    {
        return $this->model->attribute_197;
    }

    protected function generic_keywords()
    {
        return $this->model->attribute_200;
    }

    protected function target_audience_base()
    {
        return $this->model->merkal_12;
    }

    protected function catalog_number()
    {
        return $this->model->cHAN;
    }

    /**
     * START Ungruppiert
     * 'color_name',
     * 'color_map',
     * 'size_name',
     * 'size_map',
     * 'material_type'
     */

    protected function color_name()
    {
        return $this->model->attribute_201;
    }

    protected function color_map()
    {
        return $this->model->merkal_6;
    }

    protected function size_name()
    {
        return $this->model->attribute_202;
    }

    protected function size_map()
    {
        return $this->model->merkal_22;
    }

    protected function material_type()
    {
        return $this->model->attribute_263;
    }

    /** START Abmessungen
     * 'item_height',
     * 'item_length',
     * 'item_width',
     * 'item_length_unit_of_measure'
     * 204    205    206
     */

    protected function item_height()
    {
        return $this->model->attribute_204;
    }

    protected function item_length()
    {
        return $this->model->attribute_205;
    }

    protected function item_width()
    {
        return $this->model->attribute_206;
    }

    protected function item_length_unit_of_measure()
    {
        if (!empty($this->model->attribute_204) && !empty($this->model->attribute_205) && !empty($this->model->attribute_206)) {
            return 'CM';
        }

        return '';
    }

    /** START Versand
     * 'fulfillment_center_id'
     */

    protected function fulfillment_center_id()
    {
        return 'AMAZON_EU';
    }

    /** START Konformitäts
     * 'batteries_required'
     */

    protected function batteries_required()
    {
        return 'false';
    }

    /** START Angebot
     * 'condition_type'
     */

    protected function condition_type()
    {
        return 'Neu';
    }

    /**
     *  not found in amz txt
     */
    protected function supplier_declared_dg_hz_regulation1()
    {
        return 'Not Applicable';
    }

}