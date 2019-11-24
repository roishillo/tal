
<button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>

<div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark "  >
    <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
        <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
            <a  href="javascript:;" class="m-menu__link m-menu__toggle" title="Quick Actions">
                <i class="m-menu__link-icon flaticon-add"></i>
                <span class="m-menu__link-text">Actions</span>
                <i class="m-menu__hor-arrow la la-angle-down"></i>
                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                <ul class="m-menu__subnav">

                    @if(auth()->guard('admins')->user()->role == 'Admin')

                    <li class="m-menu__item "  aria-haspopup="true">
                        <a href="/admin/admins/create" class="m-menu__link " >
                            <i class="m-menu__link-icon flaticon-user-add"></i>
                            <span class="m-menu__link-text">Create New User</span>
                        </a>
                    </li>
                    @endif
                        @if(auth()->guard('admins')->user()->role === 'Admin' || auth()->guard('admins')->user()->role === 'Site Builder' || auth()->guard('admins')->user()->role === 'Helper')
                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                        <a href="/admin/sites/create" class="m-menu__link " >
                            <i class="m-menu__link-icon fa fa-building"></i>
                            <span class="m-menu__link-title">
                                <span class="m-menu__link-wrap">
                                    <span class="m-menu__link-text">Create New Site</span>

                                    </span>
                                </span>
                            </span>
                        </a>
                    </li>
                        @endif
                        @if(auth()->guard('admins')->user()->role === 'Admin' || auth()->guard('admins')->user()->role === 'Helper')
                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                        <a href="/admin/tasks/create" class="m-menu__link " >
                            <i class="m-menu__link-icon fa fa-clipboard-list"></i>
                            <span class="m-menu__link-title">
                                <span class="m-menu__link-wrap">
                                    <span class="m-menu__link-text">Create New Task</span>

                                    </span>
                                </span>
                            </span>
                        </a>
                    </li>
                        @endif
                        @if(auth()->guard('admins')->user()->role === 'Admin' || auth()->guard('admins')->user()->role === 'Helper')
                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                        <a href="/admin/tracks/create" class="m-menu__link " >
                            <i class="m-menu__link-icon fa fa-list-ol"></i>
                            <span class="m-menu__link-title">
                                <span class="m-menu__link-wrap">
                                    <span class="m-menu__link-text">Create New Route</span>

                                    </span>
                                </span>
                            </span>
                        </a>
                    </li>
                        @endif
                        @if(auth()->guard('admins')->user()->role === 'Admin' || auth()->guard('admins')->user()->role === 'Helper')
                    <li class="m-menu__item "  m-menu-link-redirect="1" aria-haspopup="true">
                        <a href="/admin/educands/create" class="m-menu__link " >
                            <i class="m-menu__link-icon flaticon-users"></i>
                            <span class="m-menu__link-text">Create New Hero</span>
                        </a>
                    </li>
                            @endif
                </ul>
            </div>
        </li>

    </ul>
</div>