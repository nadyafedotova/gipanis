<?php

namespace App\Http\Composers\Backend;

use App\Repositories\ReportsConfigRepository;
use Illuminate\View\View;
use App\Repositories\Backend\Auth\UserRepository;

/**
 * Class SidebarComposer.
 */
class SidebarComposer
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var ReportsConfigRepository
     */
    protected $reportsConfigRepository;

    /**
     * SidebarComposer constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository, ReportsConfigRepository $reportsConfigRepository)
    {
        $this->userRepository = $userRepository;

        $this->reportsConfigRepository = $reportsConfigRepository;
    }

    /**
     * @param View $view
     *
     * @return bool|mixed
     */
    public function compose(View $view)
    {
        if (config('access.users.requires_approval')) {
            $view->with('pending_approval', $this->userRepository->getUnconfirmedCount());
        } else {
            $view->with('pending_approval', 0);
        }

        $view->with('listTableByGroup',  $this->reportsConfigRepository->listTableByGroup());
        $view->with('uri_pattern_reports',  $this->uriPatternReports());
    }

    protected function uriPatternReports() {
        return ['/reports/complex/*'];
    }
}
