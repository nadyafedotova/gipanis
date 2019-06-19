<?php

namespace App\Http\Controllers\Api\Reports\Simple;


use App\Repositories\Amazon\AmzRatingRepository;
use App\Utils\Reports\Simple\ReportsTableFieldsBuilder;
use Illuminate\Http\Request;

class AmzRatingController
{
    protected $amzRatingRepository;

    /**
     * AmzRatingController constructor.
     * @param AmzRatingRepository $amzRatingRepository
     */
    public function __construct(AmzRatingRepository $amzRatingRepository)
    {
        $this->amzRatingRepository = $amzRatingRepository;
    }

    public function index(Request $request)
    {
        $reqestData = $request->all();
        $filters = [];
        if(!empty($reqestData['filters'])) {
            $filters = json_decode($reqestData['filters'], true);

        }

        return $this->amzRatingRepository->search($filters);
    }

    public function getFields()
    {
        $fields = app()->make(ReportsTableFieldsBuilder::class, ['reportName' => 'rating'])->builder();

        return ['fields' => $fields];
    }
}