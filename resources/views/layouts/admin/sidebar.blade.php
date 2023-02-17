<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('admin/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('admin/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('admin/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('admin/images/logo-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title">
                    <span data-key="t-menu">Menu</span>
                </li>

                @php
                    $admin_sidebar_data = \SiteHelper::get_admin_sidebar_tree();
                @endphp

                @if ($admin_sidebar_data && count($admin_sidebar_data) > 0)
                    @foreach ($admin_sidebar_data as $item)
                        @if ($item->is_multi_level == 0)
                            <li class="nav-item">
                                @php
                                    $active_cases = explode(',', $item->active_cases);
                                    if ($active_cases && count($active_cases) > 0) {
                                        $active = 0;
                                        foreach ($active_cases as $key => $value) {
                                            if (Request::is($value)) {
                                                $active = 1;
                                            }
                                        }
                                    }
                                @endphp
                                <a class="nav-link menu-link {{ $active == 1 ? 'active' : '' }}"
                                    href="{{ route($item->url) }}">
                                    {!! $item->icon !!}
                                    <span data-key="t-dashboards">{{ $item->name }}</span>
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                @php
                                    $active_cases = explode(',', $item->active_cases);
                                    if ($active_cases && count($active_cases) > 0) {
                                        $active = 0;
                                        foreach ($active_cases as $key => $value) {
                                            if (Request::is($value)) {
                                                $active = 1;
                                            }
                                        }
                                    }
                                @endphp
                                <a class="nav-link menu-link {{ $active == 1 ? 'active' : '' }}"
                                    href="#{{ str_replace('_', '', $item->name) }}" data-bs-toggle="collapse"
                                    role="button" aria-expanded=" {{ $active == 1 ? 'true' : 'false' }} "
                                    aria-controls="{{ str_replace('_', '', $item->name) }}">
                                    {!! $item->icon !!}
                                    <span data-key="t-apps">{{ $item->name }}</span>
                                </a>
                                <div class="collapse menu-dropdown  {{ $active == 1 ? 'show' : '' }}"
                                    id="{{ str_replace('_', '', $item->name) }}">
                                    <ul class="nav nav-sm flex-column">
                                        @if ($item->sub_modules_count > 0)
                                            @foreach ($item->sub_modules as $sub_module)
                                                <li class="nav-item">
                                                    @php
                                                        if (!empty($sub_module->url_slug)) {
                                                            $url = route($sub_module->url, $sub_module->url_slug);
                                                        } else {
                                                            $url = route($sub_module->url);
                                                        }
                                                    @endphp
                                                    <a href="{{ $url }}"
                                                        class="nav-link {{ Request::is($sub_module->active_cases) ? 'active' : '' }}"
                                                        data-key="t-{{ str_replace('_', '', $sub_module->name) }}">
                                                        {{ $sub_module->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        @endif

                                        {{-- <li class="nav-item">
                                            <a href="#sidebarEmail" class="nav-link" data-bs-toggle="collapse"
                                                role="button" aria-expanded="false" aria-controls="sidebarEmail"
                                                data-key="t-email">
                                                Email
                                            </a>
                                            <div class="collapse menu-dropdown" id="sidebarEmail">
                                                <ul class="nav nav-sm flex-column">
                                                    <li class="nav-item">
                                                        <a href="ajavascript:void(0);" class="nav-link"
                                                            data-key="t-mailbox">
                                                            Mailbox </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#sidebaremailTemplates" class="nav-link"
                                                            data-bs-toggle="collapse" role="button"
                                                            aria-expanded="false" aria-controls="sidebaremailTemplates"
                                                            data-key="t-email-templates">
                                                            Email Templates
                                                        </a>
                                                        <div class="collapse menu-dropdown" id="sidebaremailTemplates">
                                                            <ul class="nav nav-sm flex-column">
                                                                <li class="nav-item">
                                                                    <a href="javascript:void(0);" class="nav-link"
                                                                        data-key="t-basic-action"> Basic Action </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a href="javascript:void(0);" class="nav-link"
                                                                        data-key="t-ecommerce-action"> Ecommerce Action
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li> --}}
                                    </ul>
                                </div>
                            </li>
                        @endif
                    @endforeach
                @endif
                <!-- end Dashboard Menu -->
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
