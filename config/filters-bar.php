<?php
use App\Repositories\Amazon\AmzSettingsRepository;
use App\Utils\Reports\Complex\Datatables\FilterSettings\ValuesBuilder;
use App\Utils\Reports\Complex\AmazonImportConfig;

return [
    'filters' => [
        'store' => [
            'name' => 'store',
            'label' => 'Select store',
            'type' => 'select',
            'values' => function () {

                $listStores = (new AmzSettingsRepository())->getStoresList();

                return app()->make(ValuesBuilder::class)->make($listStores);
            },
            'value' => AmzSettingsRepository::STORE_BASE,
        ],

        'filterText' => [
            'name' => 'filterText',
            'label' => '',
            'type' => 'text',
            'values' => function () {

                return app()->make(ValuesBuilder::class)->make([]);
            },
            'value' => '',
        ],

        'rating' => [
            'filters' => [
                'status' => [
                    'name' => 'status',
                    'label' => 'Status',
                    'type' => 'radio',
                    'values' => function () {

                        $list = ['All', 'Active', 'Inactive'];

                        return app()->make(ValuesBuilder::class)->make($list);
                    },
                    'value' => 0,
                ],
                'growth' => [
                    'name' => 'growth',
                    'label' => 'Grows',
                    'type' => 'radio',
                    'values' => function () {

                        $list = ['All', 'Positive', 'Negative'];

                        return app()->make(ValuesBuilder::class)->make($list);
                    },
                    'value' => 0,
                ],
                'rating' => [
                    'name' => 'rating',
                    'label' => 'Rating',
                    'type' => 'radio',
                    'values' => function () {

                        $list = [1 => '>=3.8', 2 => '< 3.8 && >= 3.4', 3 => '< 3.4 && != 0'];

                        return app()->make(ValuesBuilder::class)->make($list);
                    },
                    'value' => 0,
                ],
            ]
        ],

    ],

    'routes' => [

        'amz-rating' => ['store', 'rating', 'filterText'],

        'amz-import' => ['store', 'import', 'filterText'],

        'amz-table-list' => ['store', 'filterText'],

        'jtl-table-list' => ['store', 'filterText'],

        'amz-history-table-list' => ['store', 'filterText'],

        'jtl-history-table-list' => ['filterText'],

    ]

];