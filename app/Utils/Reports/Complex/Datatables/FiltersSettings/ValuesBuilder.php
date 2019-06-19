<?php

namespace App\Utils\Reports\Complex\Datatables\FilterSettings;

class ValuesBuilder
{

    public function make(array $data)
    {
        $values = [];
        foreach ($data as $key => $value) {
            $values[] = [
                'key' => $key,
                'label' => $value,
            ];
        }
        return $values ?? [
                'key' => 0,
                'label' => '',
            ];
    }
}