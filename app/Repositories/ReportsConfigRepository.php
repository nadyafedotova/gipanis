<?php

namespace App\Repositories;

use App\Models\ReportsConfig;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class ReportsConfigRepository extends BaseRepository
{

    /**
     * @return string
     */
    public function model(): string
    {
        return ReportsConfig::class;
    }

    public function getBaseGroup()
    {
        return config('app.reports_group');
    }


    public function listTableByGroup(): array
    {
        $list = $this->all();
        $sortList = [];
        if (!empty($list)) {
            foreach ($list as $item) {
                $sortList[$item->group][] = $item;
            }
        }
        return $sortList;
    }

    public function listHistoryTables()
    {
        return $this->model->where('history', 1)->pluck('name_table');
    }
}