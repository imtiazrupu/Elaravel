<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from bootstrapmaster.com/live/metro/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 08 Jan 2018 16:56:12 GMT -->
<head>

	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Metro Admin Template - Metro UI Style Bootstrap Admin Template</title>
	<meta name="description" content="Metro Admin Template.">
	<meta name="author" content="Łukasz Holeczek">
	<meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<!-- end: Meta -->

	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->

	<!-- start: CSS -->
    <link id="bootstrap-style" href="{{asset('assets/backend/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('assets/backend/css/bootstrap-responsive.min.css')}}" rel="stylesheet">
	<link id="base-style" href="{{asset('assets/backend/css/style.css')}}" rel="stylesheet">
	<link id="base-style-responsive" href="{{asset('assets/backend/css/style-responsive.css')}}" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	<!-- end: CSS -->


	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->

	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->

	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->




</head>

<body>
		<!-- start: Header -->
        @include('backend.partial.topbar')
        <!-- start: Header -->
        <div class="container-fluid-full">
            <div class="row-fluid">

			<!-- start: Main Menu -->
			@include('backend.partial.sidebar')
			<!-- end: Main Menu -->

			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>

            <!-- start: Content -->
            <div id="content" class="span10">

                @yield('content')

            </div><!--/.fluid-container-->

            <!-- end: Content -->
        </div><!--/#content.span10-->
    </div><!--/fluid-row-->

	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Settings</h3>
		</div>
		<div class="modal-body">
			<p>Here settings can be configured...</p>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
			<a href="#" class="btn btn-primary">Save changes</a>
		</div>
	</div>

	<div class="clearfix"></div>

	@include('backend.partial.footer')

	<!-- start: JavaScript-->

        <script src="{{asset('assets/backend')}}/js/jquery-1.9.1.min.js"></script>
	    <script src="{{asset('assets/backend')}}/js/jquery-migrate-1.0.0.min.js"></script>

		<script src="{{asset('assets/backend')}}/js/jquery-ui-1.10.0.custom.min.js"></script>

		<script src="{{asset('assets/backend')}}/js/jquery.ui.touch-punch.js"></script>

		<script src="{{asset('assets/backend')}}/js/modernizr.js"></script>

		<script src="{{asset('assets/backend')}}/js/bootstrap.min.js"></script>

		<script src="{{asset('assets/backend')}}/js/jquery.cookie.js"></script>

		<script src='{{asset('assets/backend')}}/js/fullcalendar.min.js'></script>

		<script src='{{asset('assets/backend')}}/js/jquery.dataTables.min.js'></script>

		<script src="{{asset('assets/backend')}}/js/excanvas.js"></script>
    	<script src="{{asset('assets/backend')}}/js/jquery.flot.js"></script>
    	<script src="{{asset('assets/backend')}}/js/jquery.flot.pie.js"></script>
	    <script src="{{asset('assets/backend')}}/js/jquery.flot.stack.js"></script>
	    <script src="{{asset('assets/backend')}}/js/jquery.flot.resize.min.js"></script>

		<script src="{{asset('assets/backend')}}/js/jquery.chosen.min.js"></script>

		<script src="{{asset('assets/backend')}}/js/jquery.uniform.min.js"></script>

		<script src="{{asset('assets/backend')}}/js/jquery.cleditor.min.js"></script>

		<script src="{{asset('assets/backend')}}/js/jquery.noty.js"></script>

		<script src="{{asset('assets/backend')}}/js/jquery.elfinder.min.js"></script>

		<script src="{{asset('assets/backend')}}/js/jquery.raty.min.js"></script>

		<script src="{{asset('assets/backend')}}/js/jquery.iphone.toggle.js"></script>

		<script src="{{asset('assets/backend')}}/js/jquery.uploadify-3.1.min.js"></script>

		<script src="{{asset('assets/backend')}}/js/jquery.gritter.min.js"></script>

		<script src="{{asset('assets/backend')}}/js/jquery.imagesloaded.js"></script>

		<script src="{{asset('assets/backend')}}/js/jquery.masonry.min.js"></script>

		<script src="{{asset('assets/backend')}}/js/jquery.knob.modified.js"></script>

		<script src="{{asset('assets/backend')}}/js/jquery.sparkline.min.js"></script>

		<script src="{{asset('assets/backend')}}/js/counter.js"></script>

		<script src="{{asset('assets/backend')}}/js/retina.js"></script>

		<script src="{{asset('assets/backend')}}/js/custom.js"></script>
	<!-- end: JavaScript-->

</body>

<!-- Mirrored from bootstrapmaster.com/live/metro/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 08 Jan 2018 16:56:47 GMT -->
</html>
