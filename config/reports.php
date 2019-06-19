<?php
return [
    'rating' => [
        'fillable' => [
            'amz_ratings.asin' => 'ASIN',
            'sku' => 'SKU',
            'amz_ratings.created_at' => 'LastCheck',
            'amz_ratings.rating' => 'rating',
            'amz_ratings.stars1' => 'stars1',
            'amz_ratings.stars2' => 'stars2',
            'amz_ratings.stars3' => 'stars3',
            'amz_ratings.stars4' => 'stars4',
            'amz_ratings.stars5' => 'stars5',
            'total' => 'total',
            'afn' => 'AFN',
            'c.notVenkon' => 'Competitors',

        ],
        'filterable' => [
            'all'
        ],
        'sortable' => [
            'all'
        ],
    ],

];