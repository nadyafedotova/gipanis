<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\Contract\TableModelContract;
use App\Utils\Reports\Simple\TableFieldsBuilder;
use Yajra\Datatables\Datatables;

class TableSearchRepository extends BaseRepository
{
    protected $model;
    protected $fieldsBuilder;

    public function __construct(
        TableModelContract $model,
        TableFieldsBuilder $fieldsBuilder
    )
    {
        $this->model = $model;
        $this->fieldsBuilder = $fieldsBuilder;
        parent::__construct();
    }

    /**
     * @param string $code
     * @param array $request
     * @throws GeneralException
     */
    public function getData()
    {

        $query = $this->model->select(
            $this->fieldsBuilder->getColumns()
        );

        return Datatables::of($query)->make(true);
    }



    public function model()
    {
        return get_class($this->model);
    }
}