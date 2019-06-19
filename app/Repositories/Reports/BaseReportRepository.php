<?php

namespace App\Repositories\Reports;


use App\Repositories\Reports\Complex\Contract\ReportRepositoryContract;
use App\Utils\Reports\Complex\Contract\ReportsConfigContract;
use App\Utils\Reports\Complex\Datatables\Contract\QueryFiltersContract;
use App\Utils\Reports\Complex\Datatables\Contract\ReportsBuildQuery;

abstract class BaseReportRepository implements ReportRepositoryContract
{

    protected $reportBuildQuery;

    protected $reportFiltersQuery;

    /**
     * @var ReportsConfigContract
     */
    protected $reportConfig;

    public function __construct(ReportsConfigContract $reportsConfig)
    {
        $this->setReportConfig($reportsConfig);

        $this->setReportBuildQuery();

        $this->setReportFiltersQuery();


    }

    public function datatable()
    {
        $base = $this->base();
        $complex = [];
        $child = [];
        if (!empty($base)) {
            foreach ($base['data'] as $item) {
                $parentsId[] = $item->kArtikel;
            }
            $complex = $this->complex($parentsId);
            $child = $this->child($parentsId);
        }
        $sort = null;

        $complexSort = $this->sortComplex($complex);

        $childSort = $this->sortChild($child);

        foreach ($base['data'] as $main) {
            $sort[$main->kArtikel] = [
                'base' => $main,
                'main' => $main,
            ];

            if (!empty($complexSort)) {
                $stueckliste = !is_null($main->kStuecklistes) ? json_decode($main->kStuecklistes, true) : [];
                foreach ($stueckliste as $kStueckliste) {
                    $sort[$main->kArtikel]['complex'][] = $complexSort[$kStueckliste['kStueckliste']];
                }
            }

            if (!empty($childSort)) {
                $sort[$main->kArtikel]['child'] = !empty($childSort[$main->kArtikel]);

            }
        }

        $base['data'] = $sort;
        $paginator = $base;

        return $paginator;
    }

    public function all(): array
    {
        $query = app()->make($this->reportBuildQuery, ['reportConfig' => $this->geReportConfig()])->all();
        $query =  app()->make($this->reportFiltersQuery, ['query' => $query])->make();
        return $query->get()->toArray();
    }

    public function base(): array
    {
        $query = app()->make($this->reportBuildQuery, ['reportConfig' => $this->geReportConfig()])->base();
        $base =  app()->make($this->reportFiltersQuery, ['query' => $query, 'products' => 'b'])
            ->make();
        return $base->paginate(paginate_settings('per_page'))->toArray();
    }

    public function complex(array $parentsId): array
    {
        $query = app()->make($this->reportBuildQuery, ['reportConfig' => $this->geReportConfig()])->complex($parentsId);
        return $query->get()->toArray();
    }

    public function child(array $parentsId): array
    {
        $query = app()->make($this->reportBuildQuery, ['reportConfig' => $this->geReportConfig()])->child($parentsId);
        return $query->get()->toArray();
    }

    /**
     * @return ReportsConfigContract
     */
    public function geReportConfig(): ReportsConfigContract
    {
        return $this->reportConfig;
    }

    public function setReportConfig(ReportsConfigContract $reportsConfig) {
        $this->reportConfig = $reportsConfig;
    }

    protected function sortChild($data) {
        $sort = [];
        foreach ($data as $item) {
            $sort[$item->kVaterArtikel] = $item;
        }
        return $sort;
    }

    protected function sortComplex($data)
    {
        $sort = [];
        foreach ($data as $item) {
            $sort[$item->kStueckliste] = $item;
        }
        return $sort;
    }

    abstract protected function setReportBuildQuery();

    abstract protected function setReportFiltersQuery();



}