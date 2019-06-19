<?php

namespace App\Utils\Reports\Simple;


use App\Models\Contract\TableModelContract;

class TableFieldsBuilder implements FieldContract
{
    protected $model;

    protected $baseFields;

    public function __construct(TableModelContract $model)
    {
        $this->model = $model;
        $this->init();
    }

    public function builder(): array
    {
        $columns = $this->getColumns();
        $sortable = $this->getSorts();
        $fields = [];
        /**
         *  name: 'email',
        //sortField: 'email'
         */
        $i =0 ;
        foreach ($columns as $column ) {
            $fields[$i]['name'] = $column;
            if(in_array($column,$sortable)) {
                $fields[$i]['sortField'] = $column;
            }

            $i++;
        }
        return $fields;
    }

    /**
     * @return array
     */
    public function getColumns(): array
    {
        if (isset($this->model->fillable)) {
            return $this->model->fillable;
        } else {
            return $this->model->getFields();
        }
    }

    /**
     * @return array
     */
    public function getFilters(): array
    {
        if (isset($this->model->filterable)) {
            return $this->model->filterable;
        } else {
            return $this->getColumns();
        }
    }

    /**
     * @return array
     */
    public function getSorts(): array
    {
        if(isset($this->model->sortable)) {
            return $this->model->sortable;
        } else {
            return $this->getColumns();
        }
    }

    protected function init()
    {
        $this->baseFields = $this->model->getFields();
    }


}