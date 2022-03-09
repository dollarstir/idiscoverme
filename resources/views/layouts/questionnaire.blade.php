
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="MAVIA - Register, Reservation, Questionare, Reviews form wizard">
	<meta name="author" content="Ansonika">
	<title>Personality And Career Inventory</title>

	<!-- Favicons-->
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

	<!-- GOOGLE WEB FONT -->
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">

	<!-- BASE CSS -->
	<link href="{{url('/css/questionnaire/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{url('/css/questionnaire/style.css')}}" rel="stylesheet">
	<link href="{{url('/css/questionnaire/responsive.css')}}" rel="stylesheet">
	<link href="{{url('/css/questionnaire/menu.css')}}" rel="stylesheet">
	<link href="{{url('/css/questionnaire/animate.min.css')}}" rel="stylesheet">
	<link href="{{url('/css/questionnaire/icon_fonts/css/all_icons_min.css')}}" rel="stylesheet">
	<link href="{{url('/css/questionnaire/skins/square/grey.css')}}" rel="stylesheet">

	<!-- YOUR CUSTOM CSS -->
	<link href="{{url('/css/questionnaire/custom.css')}}" rel="stylesheet">

	<script src="{{url('/js/questionnaire/modernizr.js')}}"></script>
	<!-- Modernizr -->

</head>

<body>
	
	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div><!-- /Preload -->
	
	<div id="loader_form">
		<div data-loader="circle-side-2"></div>
	</div><!-- /loader_form -->


	<main>
		<div id="form_container">
			@yield('content')
		</div><!-- /Form_container -->
	</main>
	
	<footer id="home" class="clearfix">
		<p>&copy; {{date('Y M',time())}}</p>
		<ul>
			<li><a href="http://deswebsolutions.com" class="animated_link">Developed By Desweb Solutions</a></li>
		</ul>
	</footer>
	<!-- end footer-->
	

	
	<!-- cd-overlay-content -->

	<!-- Modal info -->
	<div class="modal fade" id="more-info" tabindex="-1" role="dialog" aria-labelledby="more-infoLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="more-infoLabel">Frequently asked questions</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in <strong>nec quod novum accumsan</strong>, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus. Lorem ipsum dolor sit amet, <strong>in porro albucius qui</strong>, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn_1" data-dismiss="modal">Close</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

	<!-- SCRIPTS -->
	<!-- Jquery-->
	<script src="{{url('/js/questionnaire/jquery-3.2.1.min.js')}}"></script>
	<!-- Common script -->
	<script src="{{url('/js/questionnaire/common_scripts_min.js')}}"></script>
	<!-- Wizard script -->
	<script src="{{url('/js/questionnaire/registration_wizard_func.js')}}"></script>
	<!-- Menu script -->
	<script src="{{url('/js/questionnaire/velocity.min.js')}}"></script>
	<script src="{{url('/js/questionnaire/main.js')}}"></script>
	<!-- Theme script -->
	<script src="{{url('/js/questionnaire/functions.js')}}"></script>

</body>
</html>