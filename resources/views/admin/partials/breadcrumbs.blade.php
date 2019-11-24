<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            @if(isset($title))
                <h3 class="m-subheader__title m-subheader__title--separator">{{$title}}</h3>
            @endif
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="/" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                @if(isset($data))
                    @foreach($data as $title => $url)
                        @if($loop->last && !isset($ready))
                            <li class="m-nav__separator">-</li>
                            <li class="m-nav__item">
                                <a href="{{$url}}" class="m-nav__link">
                                    <span class="m-nav__link-text">{{$title}}</span>
                                </a>
                            </li>
                        @else
                            <li class="m-nav__separator">-</li>
                            <li class="m-nav__item">
                                <a href="{{$url}}" class="m-nav__link">
                                    <span class="m-nav__link-text">{{$title}}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            </ul>
        </div>
    <div>
</div>
    </div>
</div>