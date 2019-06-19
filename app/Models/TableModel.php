<?php

namespace App\Models;


use App\Models\Contract\TableModelContract;
use App\Models\Traits\DataAttribute;
use Illuminate\Database\Eloquent\Model;

class TableModel extends Model implements TableModelContract
{
    use DataAttribute;
}