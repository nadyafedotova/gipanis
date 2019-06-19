<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportsConfig extends Model
{
    protected $casts = [
        'schedules' => 'array',
        'schedules_history' => 'array',
    ];


    public function getLinkToDataAttribute(): string
    {
        if (!isset($this->code)) {
            return '#';
        }
        return route(reports_parent($this->group).'.table-list', $this->code);
    }
}
