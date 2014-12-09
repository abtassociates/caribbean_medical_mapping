<?php $instance = Instance::get(); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />

		@yield('meta_description')

		<title>{{ $instance->country }} Health {{ ucfirst($instance->facility_term) }} Listings</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- basic styles -->
		<link rel="stylesheet" href="/assets/css/uncompressed/bootstrap.css" />
		<link rel="stylesheet" href="/assets/css/font-awesome.min.css" />
		<link rel="stylesheet" href="/assets/chosen/chosen.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="/assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!-- fonts -->
		<link rel="stylesheet" href="/assets/css/ace-fonts.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="/assets/css/ace.min.css" />
		<link rel="stylesheet" href="/assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="/assets/css/ace-skins.min.css" />

		<!-- Don't remove, the CUSTOM STYLE below will override other style being used. -->
		<link rel="stylesheet" href="/assets/jquery-ui/jquery-ui.min.css" />
		<link rel="stylesheet" href="/assets/colorpicker/css/bootstrap-colorpicker.min.css" />
		<link rel="stylesheet" href="/assets/css/custom/general.css" />
		<link rel="stylesheet" href='//fonts.googleapis.com/css?family=Muli'>

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js'>"+"<"+"/script>");
		</script>
		<!-- <![endif]-->

		<!--[if IE]>
		<script type="text/javascript">
		 window.jQuery || document.write("<script src='//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'>"+"<"+"/script>");
		</script>
		<![endif]-->
		
		@yield('styles')

		<style>
			@if($instance->main_color)
			.main-content-header{
				background-color: {{ $instance->main_color }};
			}
			#sidebar > div.logo-header{
				border-bottom-color: {{ $instance->main_color }};
			}
			@endif

			@if($instance->accent_color)
			.main-content-header{
				border-bottom-color: {{ $instance->accent_color }};
			}

			.sidebar:before {
				background-color: {{ $instance->accent_color }};
			}
			@endif

			@if($instance->font_color==1)
			.main-content-header-title{
				color: white;
			}
			@else 
			.main-content-header-title{
				color: black;
			}
			@endif

		</style>

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="/assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- ace settings handler -->
		<script src="/assets/js/ace-extra.min.js"></script>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="/assets/js/html5shiv.js"></script>
		<script src="/assets/js/respond.min.js"></script>
		<![endif]-->

		@if($instance->google_analytics_key)
		<!-- google analytics -->
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		  ga('create', '{{ $instance->google_analytics_key }}', '{{ $instance->getDomain() }}');
		  ga('send', 'pageview');
		</script>
		@endif

	</head>

	<body class="{{ str_replace('.', '_', Route::currentRouteName()) }}">

		<div lass="col-xs-6.col-sm-2" >
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>
		</div><!-- /.ol-xs-6.col-sm-2 -->

		<div class="span">
			<div id="main-container">
				<script type="text/javascript">
					try{ace.settings.check('main-container' , 'fixed')}catch(e){}
				</script>

				<div class="main-container-inner">
					<a class="menu-toggler" id="menu-toggler" href="#">
						<span class="menu-text"></span>
					</a>

					<div class="sidebar" id="sidebar">
						<script type="text/javascript">
							try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
						</script>

						<div class="logo-header">
							<a href="/" class="brand">
								<center>
									<img src="{{ $instance->getLogoPath() }}" class="logo">
								</center>
							</a><!-- /.brand -->
						</div><!-- /.logo-header -->

						{{ View::make('partials.navigation') }}

						<div class="sidebar-collapse" id="sidebar-collapse">
							<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
						</div>

						<script type="text/javascript">
							try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
						</script>
					</div>

					<div class="main-content">
						<div class="col-xs-12 main-content-header">

							<div class="USAID_brand pull-left">
								<h3 class='main-content-header-title'>{{ $instance->country }} Health {{ ucfirst($instance->facility_term) }} Listings</h3>
							</div>

							<div id="report-missing-wrapper" class="pull-right show-edit-bt error-button" title="Report a missing facility">
								<a class="btn btn-custom-blue" data-toggle="modal" data-target="#missing-modal">
									Report Missing {{ ucfirst($instance->facility_term) }}
								</a>
							</div>
							<div style="clear:both;"></div>

						</div>
						<div class="breadcrumbs" id="breadcrumbs">
							<script type="text/javascript">
								try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
							</script>

							@if(isset($breadcrumbs))
							{{ View::make('partials.breadcrumbs')->with('breadcrumbs', $breadcrumbs) }}
							@endif

						</div>

						<div class="page-content">
							<div class="row">
								<div class="col-xs-12">
									<!-- PAGE CONTENT BEGINS -->

		    					@yield('content')

									<!-- PAGE CONTENT ENDS -->
								</div><!-- /.col -->
							</div><!-- /.row -->
						</div><!-- /.page-content -->
					</div><!-- /.main-content -->

					<!--FOOTER CONTENT-->
					<div class="main-content row">
						<div class="col-md-5 col-sm-7 col-xs-12 pull-right">

							<a href="http://www.shopsproject.org/" target="_BLANK">
								<img src="/assets/img/logo_shops.png" style="max-width: 21%">
							</a>

							<img src="/assets/img/logo_spacer.png" style="max-width: 3%">

							<a href="http://www.pepfar.gov/" target="_BLANK">
								<img src="/assets/img/logo_pepfar.png" style="max-width: 15%">
							</a>

							<img src="/assets/img/logo_spacer.png" style="max-width: 3%">

							<a href="http://www.usaid.gov/" target="_BLANK">
								<img src="/assets/img/logo_usaid.png" style="max-width: 49%">
							</a>
						</div>
					</div>

					<div class="main-content row">
						<div class="col-md-5 col-sm-7 col-xs-12 pull-right disclaimer">
							The information provided on this website is not official U.S. government information and does not represent the views or positions of USAID or the U.S. government.
						</div>
					</div>
					
					<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
						<i class="icon-double-angle-up icon-only bigger-110"></i>
					</a>
				</div><!-- /.main-container -->
			
			</div>
		</div>

		@include('partials.missingModal')

		<!-- basic scripts -->
		<script>

			var currentPosition = {{ json_encode(Session::get('currentPosition')) }};

		</script>



		<!-- save user location -->
		<script>

			if(!currentPosition && navigator.geolocation){
		    	navigator.geolocation.getCurrentPosition(function(p){
			        				
			        $lat_input = $("<input>")
			        				.attr('name', 'lat')
			        				.attr('value', p.coords.latitude);
			        				
			        $lng_input = $("<input>")
			        				.attr('name', 'lng')
			        				.attr('value', p.coords.longitude);

			        var $form = $('<form></form>')
			        				.attr('method', 'post')
			        				.attr('action', '/set_current_position')
			        				.append($lat_input)
			        				.append($lng_input);

			        $('body').append($form);

			        $form.hide();

			        $form.submit();
			    });

			}
			 
			// Remove logo when menu collapse.
			$(document).ready(function(){
				// On DOM load check if open or closed 
				if($('.menu-min')[0]){ // if element return 0, that true
					$(".logo-header").hide();
				  }else{
					$(".logo-header").show();
				}
				// On Click remove logo
				$(".sidebar-collapse" ).on( "click", function() {
				  if(! $('div#sidebar').hasClass('menu-min')){
					$(".logo-header").hide();
				  }else{
					$(".logo-header").show();
				  }
				});
			});

			$(".error-form").on("submit", function(e){

				e.preventDefault();

				var $form = $(this);
				var action = $form.attr('action');
				var data = $form.serialize();
				var wrapper = $form.closest('div.modal-content');

				$form.find(".error-submitting").show();

				$.post(action, data, function(response){

					setTimeout(function(){

						$form.find(".error-submitting").hide();

						var good = true;
						$form.find(".text-error").html("");
						$.each(response, function(prop, val){
							good = false;
							var input = $form.find("#"+prop);
							var group = input.closest(".form-group");
							var error_div = group.find(".text-error");
							error_div.html(val);
						});

						if(good){
							$form.closest('.modal').modal('hide');
						}
					}, 200);
				});
			});

			$('#error-modal, #missing-modal').on('hidden.bs.modal', function () {
				var $modal = $(this);
				var form = $modal.find('form')[0];
				form.reset();
				$modal.find('.text-error').html("");
				$modal.find('.error-received').hide();
			});


		</script>

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="/assets/jquery-ui/jquery-ui.min.js"></script>
		<script src="/assets/colorpicker/js/bootstrap-colorpicker.min.js"></script>

		<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
		<script src="/assets/js/typeahead-bs2.min.js"></script>

		<!-- ace scripts -->
		<script src="/assets/js/ace-elements.min.js"></script>
		<script src="/assets/js/ace.min.js"></script>

		<!-- map stuff -->
		<script src="https://maps.googleapis.com/maps/api/js?key={{ $instance->google_maps_key }}&sensor=false"></script>
		<script>var default_map_data = {{ json_encode($instance->getDefaultMapData()) }};</script>
		<script src="/assets/js/custom/map-helper.js"></script>

		<!-- general -->
		<script src="/assets/chosen/chosen.jquery.min.js"></script>
		<script src="/assets/js/jquery.viewport.mini.js"></script>
		<script src="/assets/js/custom/general.js"></script>

		@yield('scripts')

	</body>

</html>
