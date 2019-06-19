<?php

namespace App\Utils\Reports\Complex\Datatables\FilterSettings;

use App\Exceptions\DataTableException;
use App\Utils\Reports\Complex\Datatables\Entity\Filter;

class FilterConfiguration
{
    /**
     * @var \Illuminate\Config\Repository|mixed
     */
    protected $config;

    /**
     * @var array
     */
    protected $filters;

    /**
     * @var string
     */
    protected $route;

    public function __construct()
    {
        $this->config = config('filters-bar');
    }

    /**
     * @param string $route
     * @return array
     */
    public function make(string $route)
    {
        $this->route = $route;

        $filtersName = $this->getFiltersSetByRoute();
        $this->initFilters($filtersName);

        return$this->filters;
    }

    /**
     * @return mixed
     * @throws DataTableException
     */
    protected function getFiltersSetByRoute()
    {
        if (empty($this->config['routes'][$this->route])) {
            throw new DataTableException('No filters set for this path ' . $this->route);
        }
        $filters = $this->config['routes'][$this->route];
        if(is_callable($filters)) {
            return call_user_func($filters);
        }
        return $this->config['routes'][$this->route];
    }

    /**
     * @param $filtersName
     */
    protected function initFilters($filtersName)
    {
        foreach ($filtersName as $filterName) {
            if (empty($this->config['filters'][$filterName])) {
                continue;
            }
            $filter = $this->config['filters'][$filterName];
            if ($this->isGroup($filter)) {
                $this->groupFilter($filter['filters']);
            } else {
                $this->filter($filterName, $filter);
            }


        }
    }

    /**
     * @param $filtersName
     * @param $filter
     */
    protected function filter($filtersName, $filter)
    {
        if (!empty($this->filters[$filtersName])) {
            return;
        }
        $entity = new Filter();

        $entity->setLabel($filter['label']);
        $entity->setName($filter['name']);
        $entity->setType($filter['type']);
        if(is_callable($filter['values'])) {
            $values = call_user_func($filter['values']);
        } else {
            $values = $filter['values'];
        }

        $entity->setValues($values);
        $entity->setValue($filter['value']);

        $this->filters[$filtersName] = $entity;
    }

    /**
     * @param $filters
     */
    protected function groupFilter($filters)
    {
        foreach ($filters as $filtersName => $filter) {
            $this->filter($filtersName, $filter);
        }
    }

    /**
     * @param $filter
     * @return bool
     */
    protected function isGroup($filter): bool
    {
        if (!empty($filter['filters'])) {
            return true;
        }
        return false;
    }
}