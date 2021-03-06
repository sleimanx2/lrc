<!doctype html>

        <!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>LRC Intranet</title>
    <meta name="description" content="">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="csrf-token" content="{{ csrf_token() }}" />

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,700,600,400' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="/fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/fonts/weather-icons/css/weather-icons.min.css">

    <link rel="stylesheet" href="/dist/vendor.min.css">
    <link rel="stylesheet" href="/dist/app.min.css">

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places&key=AIzaSyC2OagaYbI14yXJ9D_i-4401gYT0FZN9LY"></script>
    <script type="text/javascript" src="/dist/app.min.js"></script>

</head>
<body>
    <div>
        <!-- <div class="phonebook-container">
            <div class="overlay" onclick="hidePhonebookSidebar()"></div>
            @include('partials.phonebook')
        </div> -->

        <div class="view-container">
            <!-- <div class="no-print">
                <section id="header" class="top-header dashboard-header">
                   {{-- @include('partials.dashboard-header') --}}
                </section>
            </div> -->

            <section id="content" class="animate-fade-up dashboard-content">
                <?php $success = Session::get('success') ?>
                @if($success)
                <script type="text/javascript">
                    $(document).ready(function() {
                        toastr.success("", "{{ $success }}", { timeOut: 5000, positionClass: "toast-top-center" });
                        //swal("", "{{ $success }}", "success");
                    });
                </script>
                @endif
                
                @yield('content')
            </section>
        </div>
    </div>

    @include('partials.common')

@yield('script')
</body>
</html>
