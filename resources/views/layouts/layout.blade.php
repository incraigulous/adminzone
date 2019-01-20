<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ url('vendor/adminzone/adminzone.css') }}">

        <title>{{ Breadcrumbs::current()->title }}</title>
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
                @section('utility-bar')
                    <az-utility-nav></az-utility-nav>
                @show
                <main>
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
        <script src="{{ url('vendor/adminzone/adminzone.js') }}"></script>
    </body>
</html>
