<?php

namespace App\Http\Controllers\Backend\Reports\Simple;

use App\Http\Controllers\Controller;
use App\Repositories\Amazon\AmzRatingRepository;
use Illuminate\Http\Request;

class AmzRatingController extends Controller
{
    /**
     * @var AmzRatingRepository
     */
    protected $repository;

    public function __construct(AmzRatingRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return view('backend.amzrating');
    }
}
