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
        
        <div class="body-wrapper">
            @section('sidebar')
                <az-sidebar>
                    <az-resources-menu :resources="$resources"></az-resources-menu>
                </az-sidebar>
            @show
            
            <div class="content-wrapper">
                @section('navbar')
                    <az-topbar :resources="$resources"></az-topbar>
                @show
                @yield('utility-nav')
                
                <main>
                    <az-page-tabs></az-page-tabs>
                    @yield('main')
                </main>
                
                @section('footer')
                    <az-footer>
                        Proudly created by <a href="http://www.github.com/incraigulous/">@incraigulous</a> from <a href="https://codezone.io">CodeZone</a>. I worked really hard on this! <a href="https://www.paypal.me/incraigulous">Give me a tip</a>?
                    </az-footer>
                @show
            </div>
        </div>
    
    
        <!-- Optional JavaScript -->
        @routes
        <script src="{{ url('vendor/adminzone/adminzone.js') }}"></script>
    </body>
</html>
