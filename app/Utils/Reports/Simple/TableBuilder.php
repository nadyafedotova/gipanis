<?php

namespace App\Utils\Reports\Simple;

use App\Exceptions\TableBuilderException;
use App\Helpers\General\InitModel;
use App\Models\Contract\TableModelContract;
use App\Repositories\ReportsConfigRepository;
use App\Repositories\TableSearchRepository;

class TableBuilder
{
    /**
     * @var ReportsConfigRepository
     */
    protected $reportsConfigRepository;

    protected $initModel;

    /**
     * @var TableSearchRepository
     */
    protected $tableRepository;

    /**
     * @var TableFieldsBuilder
     */
    protected $fieldsBuilder;

    public function __construct(ReportsConfigRepository $reportsConfigRepository)
    {
        $this->reportsConfigRepository = $reportsConfigRepository;
    }

    public function builder(string $code) {
        try {
            $model = app()->make(InitModel::class)->getByCode($code);
            $this->setFieldsBuilder($model);
            $this->setRepository($model, $this->fieldsBuilder);

            return $this->tableRepository->getData();
        } catch (\Exception $e) {
            throw new TableBuilderException($e->getMessage());
        }

    }

    public function setFieldsBuilder(TableModelContract $model)
    {
        $this->fieldsBuilder = new TableFieldsBuilder($model);
    }
    public function getFieldsBuilder()
    {
        return $this->fieldsBuilder;
    }

    public function setRepository($model, $fieldsBuilder)
    {
        $this->tableRepository = new TableSearchRepository($model, $fieldsBuilder);
    }

    public function getRepository()
    {
        return $this->tableRepository;
    }
}