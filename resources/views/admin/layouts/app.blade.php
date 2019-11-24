<!DOCTYPE html>
<html lang="en" dir="{{config('app.direction')}}">
<head>
    <meta charset="utf-8" />
    <title>{{config('app.name')}}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700%7CRoboto:300,400,500,600,700" rel="stylesheet" media="all" />
    <link href="{{ url((config('app.direction') == 'rtl') ? 'assets/admin/metronic/css/all-rtl.css' : 'assets/admin/metronic/css/all.css') }}?v={{ env('version', time()) }}" rel="stylesheet" type="text/css" />
    <link href="{{ url((config('app.direction') == 'rtl') ? 'assets/admin/css/app-rtl.css' : 'assets/admin/css/app.css') }}?v={{ env('version', time()) }}" rel="stylesheet" type="text/css" />
    <link href="{{ url((config('app.direction') == 'rtl') ? 'assets/admin/css/components_rtl.css' : 'assets/admin/css/components_ltr.css') }}" rel="stylesheet" type="text/css" />

    @stack('cssHead')
    <link rel="shortcut icon" href="{{ url('favicon.ico') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript">
        var GlobalPath = '{{url('/admin')}}';
        var GlobalPublicPath = '{{url('/')}}';
    </script>
    @include('FileManager::partials.styles')
</head>

<!-- begin::Body -->

<body  class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-aside-left--minimize m-brand--minimize m-footer--push m-aside--offcanvas-default @stack('bodyClass')">

<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
@include('admin.partials.header')

    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

    @include('admin.partials.side_bar')

        <div class="m-grid__item m-grid__item--fluid">
            @if(Route::currentRouteName() == 'filemanager.main')
                @include('admin.partials.breadcrumbs', ['title' => 'File Manager', 'data' => [ 'Media Storage' => url('admin/file-manager') ]])
                <div class="m-content">
                    @yield('content')
                </div>
                @else
                @yield('content')
                @endif


        </div>

@include('admin.partials.footer')
    </div>
</div>

<script src="{{ elixir('assets/admin/metronic/js/all.js') }}"></script>
<script src="{{ elixir('assets/admin/metronic/js/custom.js') }}"></script>

@routes

<script>

    function showToast(message, title, type, options) {
        var originalOptions = {
            "closeButton": true,
            "debug": false,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        for(k in originalOptions) {
            if(!originalOptions.hasOwnProperty(k)) {
                if(options && options[k]){
                    originalOptions[k] = options[k];
                }
            }
        }

        toastr.options = originalOptions;

        if(!type)
            type = 'success';

        if(title)
            toastr[type](message, title);
        else
            toastr[type](message);
    }

    @stack('regularScripts')
    $(document).ready(function(){

        FileManagerModal.init();

        App.setGlobalImgPath('/img/');

        App.setAssetsPath('{{url('assets/admin/metronic')}}');

        @if(session('toastr'))
                showToast('{{ session('toastr')['message'] }}', {!! isset(session('toastr')['title']) ? "'".session('toastr')['title']."'" : 'false' !!}, {!!isset(session('toastr')['type']) ? "'".session('toastr')['type']."'" : 'false'!!});
        @endif

        @stack('readyScripts')
    });

</script>

@include('FileManager::partials.scripts')
@include('FileManager::partials.file-manager-modal')
<script>
    [].forEach.call(document.body.getElementsByTagName('script'), function( scr ) {
        if( scr.getAttribute( 'src' ) === 'https://cdnjs.cloudflare.com/ajax/libs/jquery-sortable/0.9.13/jquery-sortable-min.js' ) {
            scr.parentNode.removeChild( scr );
        }
    });
</script>

{{-- jquery-ui script needed here for draggable to work, overwrites jquery-sortable from file-manager  --}}
<script src="/assets/admin/metronic/js/jquery-ui.js"></script>

@stack('freeScripts')

</body>
</html>