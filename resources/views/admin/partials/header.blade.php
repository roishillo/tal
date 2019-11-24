<header id="m_header" class="m-grid__item m-header" m-minimize-offset="200" m-minimize-mobile-offset="200">

    <div class="m-container m-container--fluid m-container--full-height">

        <div class="m-stack m-stack--ver m-stack--desktop">

        <div class="m-stack__item m-brand  m-brand--skin-dark">

            <div class="m-stack m-stack--ver m-stack--general">

                <div class="m-stack__item m-stack__item--middle m-brand__logo">

                </div>
                <div class="m-stack__item m-stack__item--middle m-brand__tools">
                    <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left" style="overflow: inherit; text-indent: inherit; margin-right: 13px;">

                    <img src="{{url('assets/admin/images/compie_logo.png')}}" style= alt="">
                    </a>
                </div>
            </div>
        </div>

            <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
                @include('admin.partials.horizontal_menu')
                @include('admin.partials.topbar')
            </div>


    </div>
</header>