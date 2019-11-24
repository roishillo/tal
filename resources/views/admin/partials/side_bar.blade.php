<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>

<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
    <div
            id="m_ver_menu"
            class="m-aside-menu m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark m-scroller ps ps--active-y "
            m-menu-vertical="1"
            m-menu-vertical="1"
            m-menu-scrollable="1" m-menu-dropdown-timeout="500"
            style="position: relative; height: 938px; overflow: hidden;"">

        <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

            @foreach($sideBarItems as $name => $sideBarItem)

                @if(
                        isset($sideBarItem['authenticate']) &&
                        !in_array(auth()->guard('admins')->user()->role, $sideBarItem['authenticate'])
                        )
                    @continue
                @endif


                @if(isset($sideBarItem['items']))
                    <li class="m-menu__item @if(isset($currentActivePage) && $currentActivePage['route'] == $sideBarItem['route']) m-menu__item--active @endif " aria-haspopup="true">
                        <a href="javascript:;" class="m-menu__link">
                            <i class="m-menu__link-icon  {{$sideBarItem['icon']}}" ></i>
                            <span class="m-menu__link-title">{{trans($sideBarItem['display'])}}</span>
                            <span class="arrow @if(isset($currentActivePage) && $currentActivePage['route'] == $sideBarItem['route']) open @endif"></span>
                        </a>
                        <ul class="m-menu__subnav">
                            @foreach($sideBarItem['items'] as $subName => $subItem)
                                <li class="m-menu__item @if(isset($currentActivePage) && $currentActivePage['route'] == $sideBarItem['route']) m-menu__item--active @endif" aria-haspopup="true">
                                    <a href="{{route($subItem['route'])}}" class="nav-link ">
                                        <i class="{{$subItem['icon']}}"></i>
                                        <span class="m-menu__link-title">{{trans($subItem['display'])}}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @elseif(isset($sideBarItem['space']))
                    <li class="m-menu__item" style="height:{{ $sideBarItem['space'] }}"></li>
                @else
                    <li class="m-menu__item @if(isset($currentActivePage) && $currentActivePage['route'] == $sideBarItem['route']) m-menu__item--active @endif" aria-haspopup="true">
                        <a href="{{route($sideBarItem['route'])}}" class="m-menu__link">
                            <i class=" m-menu__link-icon {{$sideBarItem['icon']}}"></i>  {{-- {{$sideBarItem['icon']}} --}}
                            <span class="m-menu__link-title"><span class="m-menu__link-text">{{trans($sideBarItem['display'])}}</span></span>
                            @if(isset($currentActivePage) && $currentActivePage['route'] == $sideBarItem['route'])
                                <span class="m-menu__link-wrap"></span>
                            @endif
                        </a>
                    </li>
                @endif
            @endforeach

        </ul>



    </div>
</div>