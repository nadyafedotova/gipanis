<?php

namespace App\Models\Traits;


use Illuminate\Support\Facades\Schema;

trait DataAttribute
{

    public function getFields(): array
    {
        if(!empty($this->getFillable())) {
            return $this->getFillable();
        } else {
            return Schema::getColumnListing($this->getTable());
        }

    }
}