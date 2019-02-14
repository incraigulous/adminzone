<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ url('vendor/adminzone/adminzone.css') }}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        
    </head>
    
    <body>
        
        <div class="body-wrapper" data-controller="dashboard">
            @section('sidebar')
                <az-sidebar data-target="dashboard.sidebar">
                    <div class="sidebar__brand">
                        @if(config('adminzone.logo'))
                            <div class="text-center mb-3">
                                <img class="img-fluid" src="{{ config('adminzone.logo') }}">
                            </div>
                        @endif
                        <h6>{{ config('app.name') }}</h6>
                    </div>
                    <div class="sidebar__content">
                        <az-resources-menu :resources="$resources"></az-resources-menu>
                    </div>
                </az-sidebar>
            @show
            
            <div class="content-wrapper">
                @section('navbar')
                    <az-topbar :resources="$resources" data-target="dashboard.topbar"></az-topbar>
                @show
                @yield('utility-nav')
                
                <main class="invisible-sidebar-open">
                    <az-overlay-stack></az-overlay-stack>
                    @section('flash')
                        @if(Session::has('alert-message'))
                            <div class="container-fluid">
                                <az-alert :theme="Session::get('alert-theme', 'info')">{{ Session::get('alert-message') }}</az-alert>
                            </div>
                        @endif
                    @show
                    @yield('main')
                </main>
                
                @section('footer')
                    <az-footer data-target="dashboard.footer" class="d-none d-lg-flex">
                        {!! config('adminzone.copyright') !!}
                    </az-footer>
                @show
            </div>
        </div>
    
    
        <!-- Optional JavaScript -->
        @routes
        <script src="{{ url('vendor/adminzone/adminzone.js') }}"></script>
    </body>
</html>
