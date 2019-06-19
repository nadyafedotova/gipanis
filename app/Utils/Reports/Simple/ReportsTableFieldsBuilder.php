<?php

namespace App\Utils\Reports\Simple;


use App\Exceptions\TableBuilderException;

class ReportsTableFieldsBuilder implements FieldContract
{
    /**
     * @var string
     */
    protected $reportName;

    /**
     * @var array
     *
     */
    protected $baseFields;

    public function __construct(string $reportName)
    {
        $this->reportName = $reportName;

        $this->init();

    }

    public function builder(): array
    {
        $columns = $this->getColumns();
        $sortable = $this->getSorts();
        $fields = [];
        /**
         *  name: 'email',
         * //sortField: 'email'
         */
        $i = 0;
        foreach ($columns as $keyColumn => $column) {
            $fields[$i]['name'] = $column;
            if (in_array($keyColumn, $sortable)) {
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
        if (isset($this->baseFields->fillable)) {
            return $this->baseFields->fillable;
        } else {
            return [];
        }
    }

    /**
     * @return array
     */
    public function getFilters(): array
    {
        if (isset($this->baseFields->filterable)) {

            if($this->baseFields->filterable[0] != 'all') {
                return $this->baseFields->filterable;
            } else {
                return array_keys($this->getColumns());
            }

        } else {
            return [];
        }
    }

    /**
     * @return array
     */
    public function getSorts(): array
    {
        if (isset($this->baseFields->sortable)) {

            if($this->baseFields->sortable[0] != 'all') {
                return $this->baseFields->sortable;
            } else {
                return array_keys($this->getColumns());
            }

        } else {
            return [];
        }
    }

    protected function init()
    {
        $this->baseFields = (object)config('reports.' . $this->reportName);
        if (empty($this->baseFields)) {
            throw new TableBuilderException("Report with name " . $this->reportName . " not found");
        }
    }
}