<!doctype html>
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Admin angular theme</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,700,600,400' rel='stylesheet' type='text/css'>

        <!-- Include Fonts from the theme fonts directory -->
        <link rel="stylesheet" href="/fonts/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="/fonts/weather-icons/css/weather-icons.min.css">

        <!-- Include App-Header in the vendor folder -->
        <script type="text/javascript" src="/dist/app-header.min.js"></script>

        <!-- Theme's own CSS file -->
        <link rel="stylesheet" href="/dist/main.min.css">

    </head>
    <body data-ng-app="app" id="app" data-custom-background="" data-off-canvas-nav="" data-ng-controller="AdminAppCtrl">

        <div>
            <div data-ng-hide="checkIfOwnPage()" data-ng-cloak="" class="no-print">


                <aside data-ng-include=" '/app/views/navigation.html' " id="nav-container"></aside>
            </div>

            <div class="view-container">

                <div data-ng-hide="checkIfOwnPage()" data-ng-cloak="" class="no-print">
                    <section data-ng-include=" '/app/views/header.html' " id="header" class="top-header"></section>
                </div>

                <section data-ng-view="" id="content" class="animate-fade-up">

                </section>
            </div>
            <div>
                @yield('content')
            </div>
        </div>
        <div class="page-loading-overlay"> <div class="loader-2"></div> </div>

        <div class="load_circle_wrapper">

            <div class="loading_spinner">
                <div id="wrap_spinner">
                    <div class="loading outer">
                        <div class="loading inner"></div>
                    </div>
                </div>
            </div>
        </div>

        <!--Uncomment for deployment using Grunt-->
        <script type="text/javascript" src="/dist/app.min.js"></script>



    </body>
</html>