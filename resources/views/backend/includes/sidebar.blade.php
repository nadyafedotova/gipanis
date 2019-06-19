<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                @lang('menus.backend.sidebar.general')
            </li>
            <li class="nav-item">
                <a class="nav-link {{ active_class(Active::checkUriPattern('dashboard')) }}"
                   href="{{ route('dashboard') }}">
                    <i class="nav-icon icon-speedometer"></i> @lang('menus.backend.sidebar.dashboard')
                </a>
            </li>

            <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('amz*'), 'open') }}">
                <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('amz*')) }}"
                   href="#">
                    <i class="nav-icon icon-list"></i> @lang('menus.backend.sidebar.amz-data')
                </a>

                <ul class="nav-dropdown-items">
                    <li class="nav-title">
                        @lang('menus.backend.amz.by_api')
                    </li>
                    @if(isset($listTableByGroup["amz"]))
                        @include('backend.includes.partials.sidebar.tables_list', ["items" => $listTableByGroup["amz"]])
                    @endif
                    <li class="nav-title">
                        @lang('menus.backend.amz.parser-by-auth')
                    </li>
                    @if(isset($listTableByGroup["b"]))
                        @include('backend.includes.partials.sidebar.tables_list', ["items" => $listTableByGroup["b"]])
                    @endif
                    <li class="nav-title">
                        @lang('menus.backend.amz.parser')
                    </li>
                    @if(isset($listTableByGroup["p"]))
                        @include('backend.includes.partials.sidebar.tables_list', ["items" => $listTableByGroup["p"]])
                    @endif
                </ul>
            </li>
            <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('jtl*'), 'open') }}">
                <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('jtl*')) }}"
                   href="#">
                    <i class="nav-icon icon-list"></i> @lang('menus.backend.sidebar.jtl-data')
                </a>

                <ul class="nav-dropdown-items">
                    @if(isset($listTableByGroup["p"]))
                        @include('backend.includes.partials.sidebar.tables_list', ["items" => $listTableByGroup["jtl"]])
                    @endif
                </ul>
            </li>
            <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern($uri_pattern_reports), 'open') }}">
                <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern($uri_pattern_reports)) }}"
                href="#">
                <i class="nav-icon icon-list"></i> @lang('menus.backend.sidebar.reports')
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Active::checkUriPattern('amz/rating')) }}"
                           href="{{ route('amz.rating') }}">
                            <i class="nav-icon icon-speedometer"></i> @lang('menus.backend.sidebar.rating')
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ active_class(Active::checkUriPattern('amz/import')) }}"
                           href="{{ route('amz.import') }}">
                            <i class="nav-icon icon-speedometer"></i> @lang('menus.backend.sidebar.amz_import')
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ active_class(Active::checkUriPattern('/amz/calculator')) }}"
                           href="{{ route('amz.calculator') }}">
                            <i class="nav-icon icon-speedometer"></i> @lang('menus.backend.sidebar.amz_calculator')
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-title">
                @lang('menus.backend.sidebar.system')
            </li>


            @if ($logged_in_user->isAdmin())
                <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('auth*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('auth*')) }}"
                       href="#">
                        <i class="nav-icon icon-user"></i> @lang('menus.backend.access.title')

                            @if ($pending_approval > 0)
                                <span class="badge badge-danger">{{ $pending_approval }}</span>
                            @endif
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('auth/user*')) }}"
                               href="{{ route('admin.auth.user.index') }}">
                                @lang('labels.backend.access.users.management')

                                    @if ($pending_approval > 0)
                                        <span class="badge badge-danger">{{ $pending_approval }}</span>
                                    @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Active::checkUriPattern('auth/role*')) }}"
                               href="{{ route('admin.auth.role.index') }}">
                                @lang('labels.backend.access.roles.management')
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            <li class="divider"></li>

            <li class="nav-item nav-dropdown {{ active_class(Active::checkUriPattern('log-viewer*'), 'open') }}">
                <a class="nav-link nav-dropdown-toggle {{ active_class(Active::checkUriPattern('log-viewer*')) }}"
                   href="#">
                    <i class="nav-icon icon-list"></i> @lang('menus.backend.log-viewer.main')
                </a>

                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Active::checkUriPattern('log-viewer')) }}"
                           href="{{ route('log-viewer::dashboard') }}">
                            @lang('menus.backend.log-viewer.dashboard')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Active::checkUriPattern('log-viewer/logs*')) }}"
                           href="{{ route('log-viewer::logs.list') }}">
                            @lang('menus.backend.log-viewer.logs')
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
