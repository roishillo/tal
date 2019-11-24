@extends('admin.layouts.app')

@section('content')
    @include('admin.partials.breadcrumbs', ['title' => 'Dashboard', 'data' => ['Dashboard ' => url('/admin')]])

    <div class="m-content">
        <div class="m-section__content">
            <div class="m-demo__preview">
            <div class="m-nav-grid">
                <div class="m-nav-grid__row">
                    @foreach($sideBarItems as $key => $item)

                        @if($item["route"] === "admin.dashboard")
                            @continue
                        @endif
                        @if(
                            isset($item['authenticate']) &&
                            !in_array(auth()->guard('admins')->user()->role, $item['authenticate'])
                            )
                            @continue
                        @endif
                            @if(isset($item['route']) && array_search($key, array_keys($sideBarItems))<= 3)
                    <a href="{{route($item['route'])}}" class="m-nav-grid__item" style="background-color: white; border-right: 4px solid #f4f5f8; border-bottom: 4px solid #f4f5f8">
                        <i class="m-nav-grid__icon {{$item['icon']}}"></i>
                        <span class="m-nav-grid__text">{{trans($item['display'])}}</span>
                    </a>
                            @elseif(isset($item['items']))
                                @foreach($item['items'] as $childItem)
                                    @if(
                               isset($item['authenticate']) &&
                               !in_array(auth()->guard('admins')->user()->role, $item['authenticate'])
                               )
                                        @continue
                                    @endif
                                        @if(isset($childItem['url']))
                    <a href="{{route($childItem['route'])}}" class="m-nav-grid__item" style="background-color: white; border-right: 4px solid #f4f5f8; border-bottom: 4px solid #f4f5f8" >
                        <i class="m-nav-grid__icon {{$childItem['icon']}}"></i>
                        <span class="m-nav-grid__text">{{trans($childItem['display'])}}</span>
                    </a>
                                        @endif
                                @endforeach
                            @endif
                    @endforeach

                </div>
                <div class="m-nav-grid__row">
                    @foreach($sideBarItems as $key => $item)

                        @if($item["route"] === "admin.dashboard")
                            @continue
                        @endif
                        @if(
                            isset($item['authenticate']) &&
                            !in_array(auth()->guard('admins')->user()->role, $item['authenticate'])
                            )
                            @continue
                        @endif
                    @if(isset($item['route']) && array_search($key, array_keys($sideBarItems)) > 3)
                    <a href="{{route($item['route'])}}" class="m-nav-grid__item" style="background-color: white; border-right: 4px solid #f4f5f8; border-bottom: 4px solid #f4f5f8">
                        <i class="m-nav-grid__icon {{$item['icon']}}"></i>
                        <span class="m-nav-grid__text">{{trans($item['display'])}}</span>
                    </a>
                    @endif
                        @endforeach

                </div>
            </div>
            </div>

        </div>

    </div>
@endsection