<!-- BEGIN: Topbar -->
<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general m-stack--fluid">


    <div class="m-stack__item m-topbar__nav-wrapper">
        <ul class="m-topbar__nav m-nav m-nav--inline">

            <li style="display: none" class="m-nav__item m-topbar__quick-actions m-topbar__quick-actions--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push m-dropdown--mobile-full-width m-dropdown--skin-light"  m-dropdown-toggle="click">
                <a href="#" class="m-nav__link m-dropdown__toggle">
                    <span class="m-nav__link-badge m-badge m-badge--dot m-badge--info m--hide"></span>
                    <span class="m-nav__link-icon"><i class="flaticon-share"></i></span>
                </a>
                <div class="m-dropdown__wrapper">
                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                    <div class="m-dropdown__inner">
                        <div class="m-dropdown__header m--align-center" style="background: url('assets/admin/metronic/img/quick_actions_bg.jpg'); background-size: cover;">
                            <span class="m-dropdown__header-title">Quick Actions</span>
                            <span class="m-dropdown__header-subtitle">Shortcuts</span>
                        </div>
                        <div class="m-dropdown__body m-dropdown__body--paddingless">
                            <div class="m-dropdown__content">
                                <div class="data" data="false" data-height="380" data-mobile-height="200">
                                    <div class="m-nav-grid m-nav-grid--skin-light">
                                        <div class="m-nav-grid__row">
                                            <a href="#" class="m-nav-grid__item">
                                                <i class="m-nav-grid__icon flaticon-file"></i>
                                                <span class="m-nav-grid__text">Generate Report</span>
                                            </a>
                                            <a href="#" class="m-nav-grid__item">
                                                <i class="m-nav-grid__icon flaticon-time"></i>
                                                <span class="m-nav-grid__text">Add New Event</span>
                                            </a>
                                        </div>
                                        <div class="m-nav-grid__row">
                                            <a href="#" class="m-nav-grid__item">
                                                <i class="m-nav-grid__icon flaticon-folder"></i>
                                                <span class="m-nav-grid__text">Create New Task</span>
                                            </a>
                                            <a href="#" class="m-nav-grid__item">
                                                <i class="m-nav-grid__icon flaticon-clipboard"></i>
                                                <span class="m-nav-grid__text">Completed Tasks</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
                <a href="#" class="m-nav__link m-dropdown__toggle">
                    <span class="m-topbar__userpic"><img src="/assets/admin/images/avatar3.png" class="m--img-rounded m--marginless" alt=""/>
	                </span>
                    <span class="m-topbar__username m--hide">Nick</span>
                </a>
                <div class="m-dropdown__wrapper">
                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                    <div class="m-dropdown__inner">
                        <div class="m-dropdown__header m--align-center" style="background: url(/assets/admin/metronic/img/user_profile_bg.jpg); background-size: cover;">

                            <div class="m-card-user m-card-user--skin-dark">
                                <div class="m-card-user__pic">
                                    <img src = "/assets/admin/images/avatar3.png" class="m--img-rounded m--marginless" alt=""/>
                                </div>
                                <div class="m-card-user__details">
                                    <span class="m-card-user__name m--font-weight-500">{{ title_case(\Illuminate\Support\Facades\Auth::guard('admins')->user()->first_name.' '.\Illuminate\Support\Facades\Auth::guard('admins')->user()->last_name) }}</span>
                                    <a href="" class="m-card-user__email m--font-weight-300 m-link">{{ (\Illuminate\Support\Facades\Auth::guard('admins')->user()->email) }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="m-dropdown__body">
                            <div class="m-dropdown__content">
                                <ul class="m-nav m-nav--skin-light">
                                    <li class="m-nav__section m--hide">
                                        <span class="m-nav__section-text">Section</span>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="/admin/profile" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-profile-1"></i>
                                            <span class="m-nav__link-title">
									<span class="m-nav__link-wrap">
										<span class="m-nav__link-text">My Profile</span>
										<span class="m-nav__link-badge" style="display: none"><span class="m-badge m-badge--success">2</span></span>
									</span>
								</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item" style="display: none">
                                        <a href="?page=header/profile&demo=default" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-share"></i>
                                            <span class="m-nav__link-text">Activity</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item" style="display: none">
                                        <a href="?page=header/profile&demo=default" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-chat-1"></i>
                                            <span class="m-nav__link-text">Messages</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__separator m-nav__separator--fit">
                                    </li>
                                    <li class="m-nav__item" style="display: none">
                                        <a href="?page=header/profile&demo=default" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-info"></i>
                                            <span class="m-nav__link-text">FAQ</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item" style="display: none">
                                        <a href="?page=header/profile&demo=default" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                            <span class="m-nav__link-text">Support</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__separator m-nav__separator--fit">
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="/admin/logout" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- END: Topbar -->