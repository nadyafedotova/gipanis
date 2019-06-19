<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JtlAmzConcatArtikel extends Model
{
    const STATUS_NEW = 'new';
    const STATUS_UPDATED = 'updated';
    const STATUS_NO_CHANGES = 'no_changes';

    const TYPE_BASE = 'b';
    const TYPE_HAUPTARTIKEL = 'h';
    const TYPE_STUECKLISTE = 's';
    const TYPE_CHILD = 'c';
    const TYPE_ARCHIVED = 'a';
    const IN_STOCK = 35;

    protected $table = 'jtl_amz_concat_artikel';
}
