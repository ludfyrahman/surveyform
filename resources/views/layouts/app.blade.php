<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
		<meta name="Author" content="Spruko Technologies Private Limited">
		<meta name="Keywords" content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4"/>

		<!-- Title -->
		<title> Valex -  Premium dashboard ui bootstrap rwd admin html5 template </title>

		<!-- Favicon -->
		<link rel="icon" href="{{ asset('assets/img/brand/favicon.png') }}" type="image/x-icon"/>

		<!-- Icons css -->
		<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">

		<!-- Bootstrap css -->
		<link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

		<!--  Custom Scroll bar-->
		<link href="{{ asset('assets/plugins/mscrollbar/jquery.mCustomScrollbar.css') }}" rel="stylesheet"/>

		<!--  Sidebar css -->
		<link href="{{ asset('assets/plugins/sidebar/sidebar.css') }}" rel="stylesheet">

		<!--- Internal Morris css-->
		<link href="{{ asset('assets/plugins/morris.js/morris.css') }}" rel="stylesheet">

		<!--- Style css --->
		<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/boxed.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/dark-boxed.css') }}" rel="stylesheet">

		<!--- Dark-mode css --->
		<link href="{{ asset('assets/css/style-dark.css') }}" rel="stylesheet">

		<!---Skinmodes css-->
		<link href="{{ asset('assets/css/skin-modes.css') }}" rel="stylesheet" />

	</head>

<body class="main-body">

    <!-- Loader -->
    <div id="global-loader">
        <img src="{{asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
    </div>
    <!-- /Loader -->

    <!-- Page -->
    <div class="page">
	<!-- /Loader -->

	@yield('content')

	<!-- Back-to-top -->
	<a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>

	<!-- custom js -->


</body>
<!-- Page -->
<div class="page">
	<!-- main-content -->
    @include('includes.topnav')
    @include('includes.navbar')
	<div class="main-content horizontal-content">
        <div class="container">
            @yield('content-app')
        </div>
	</div>
	@include('includes.footer')
</div>
<!-- JQuery min js -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>


<!-- Bootstrap Bundle js -->
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/js/popper.min.js')}}"></script>

<!--Internal  Chart.bundle js -->
<script src="{{asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>

<!-- Ionicons js -->
<script src="{{asset('assets/plugins/ionicons/ionicons.js')}}"></script>

<!-- Moment js -->
<script src="{{asset('assets/plugins/moment/moment.js')}}"></script>

<!--Internal Sparkline js -->
<script src="{{asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>

<!-- Moment js -->
<script src="{{asset('assets/plugins/raphael/raphael.min.js')}}"></script>

<!--Internal Apexchart js-->
<script src="{{asset('assets/js/apexcharts.js')}}"></script>

<!-- Rating js-->
<script src="{{asset('assets/plugins/rating/jquery.rating-stars.js')}}"></script>
<script src="{{asset('assets/plugins/rating/jquery.barrating.js')}}"></script>

<!--Internal  Perfect-scrollbar js -->
<script src="{{asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min-rtl.js')}}"></script>
<script src="{{asset('assets/plugins/perfect-scrollbar/p-scroll-rtl.js')}}"></script>

<!-- Eva-icons js -->
<script src="{{asset('assets/js/eva-icons.min.js')}}"></script>

<!-- right-sidebar js -->
<script src="{{asset('assets/plugins/sidebar/sidebar-rtl.js')}}"></script>
<script src="{{asset('assets/plugins/sidebar/sidebar-custom.js')}}"></script>

<!-- Sticky js -->
<script src="{{asset('assets/js/sticky.js')}}"></script>
<script src="{{asset('assets/js/modal-popup.js')}}"></script>

<!-- Left-menu js-->
<script src="{{asset('assets/plugins/side-menu/sidemenu.js')}}"></script>

<!-- Internal Map -->
<script src="{{asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>

<!--Internal  index js -->
<script src="{{asset('assets/js/index.js')}}"></script>

<!-- Apexchart js-->
<script src="{{asset('assets/js/apexcharts.js')}}"></script>
<script src="{{asset('assets/js/jquery.vmap.sampledata.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>

<script>
	var $div = $("#bodyID");
	var observer = new MutationObserver(function(mutations) {
		mutations.forEach(function(mutation) {
			var attributeValue = $(mutation.target).prop(mutation.attributeName);
			if(attributeValue === "main-body app sidebar-mini sidenav-toggled"){
				$("#salamTitle").html(`<img src="{{ asset('img/logo/LAMSAMA.png') }}" class="logo" alt="logo" height="30">`);
			}
			else{
				$("#salamTitle").html(`<h3 class="text-dark" id="salamTitle"><img src="{{ asset('img/logo/LAMSAMA.png') }}" class="logo" alt="logo" height="30"> SALAM</h3>`);
			}
		});
	});

	observer.observe($div[0], {
		attributes: true,
		attributeFilter: ['class']
	});
</script>

@stack('script')
</html>
