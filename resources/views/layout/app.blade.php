<!DOCTYPE html>
<html> 
<head>
<base href="{{url('to/')}}">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title')</title>
	<!--style-->
    <link href="css/style.css" type="text/css" rel="stylesheet" media="all"/>
    <link href="css/responsive.css" type="text/css" rel="stylesheet" media="all"/>
    <!--bootstrape-->
    <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" media="all"/>
    <!--font-awesome-->
    <link href="css/font-awesome.min.css" type="text/css" rel="stylesheet" media="all"/><link href="css/jquery.timepicker.css" type="text/css" rel="stylesheet" media="all"/>
    <!--fonts-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700|Roboto:100,300,400,500,700,900" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet"> 
	
	<link rel="apple-touch-icon" sizes="57x57" href="images/fav-icon//apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="images/fav-icon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/fav-icon//apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="images/fav-icon//apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/fav-icon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="images/fav-icon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="images/fav-icon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="images/fav-icon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="images/fav-icon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="images/fav-icon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="images/fav-icon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="images/fav-icon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="images/fav-icon/favicon-16x16.png">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="images/fav-icon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<link rel="icon" href="favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <script type="text/javascript" src="js/jquery-3.2.1.js"></script>	
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
       <script type="text/javascript" src="js/jquery.timepicker.js"></script>
	<script src="js/jquery.validate.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWeU87Wceot0e9rzcVCndL26yGzUPxlMg&libraries=places"></script>
    <!--date picker-->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<a href="javascript:" id="return-to-top"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
	<script>
	// ===== Scroll to Top ==== 
	$(window).scroll(function() {
		if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
			$('#return-to-top').fadeIn(200);    // Fade in the arrow
		} else {
			$('#return-to-top').fadeOut(200);   // Else fade out the arrow
		}
	});
	$('#return-to-top').click(function() {      // When arrow is clicked
		$('body,html').animate({
			scrollTop : 0                       // Scroll to top of body
		}, 500);
	});
</script> 
<script>
  $( function() {
    $( "#datepicker" ).datepicker({
		 minDate: '0'
	});
  });
  
  $( function() {
    $( "#datepicker1" ).datepicker();
  } );
  
</script>
<script>
$(window).scroll(function(){

		if ($(this).scrollTop() > 120) {
		//alert('hi');	
			
        $('.top_head').css('background','#000');
       
		} 
		else
		{
			 $('.top_head').css('background','rgba(0,0,0,0.4)');
		}
	});
</script>
<script>
$(document).ready(function(){
    $(".aa").click(function(){
        $(".dropss_down").slideToggle();
    });
});
</script>
<script type="text/javascript" src="js/jquery.mousewheel.pack.js?v=3.1.3"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="js/jquery.fancybox.pack.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css?v=2.1.5" media="screen" />

	<!-- Add Button helper (this is optional) -->	
	<script type="text/javascript" src="js/jquery.fancybox-buttons.js?v=1.0.5"></script>

	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="css/jquery.fancybox-thumbs.css?v=1.0.7" />	

	<!-- Add Media helper (this is optional) -->
	<script type="text/javascript" src="js/jquery.fancybox-media.js?v=1.0.6"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox();

			/*
			 *  Different effects
			 */

			// Change title type, overlay closing speed
			$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});

			// Disable opening and closing animations, change title type
			$(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				closeEffect	: 'none',

				helpers : {
					title : {
						type : 'over'
					}
				}
			});

			// Set custom style, close if clicked, change title type and overlay color
			$(".fancybox-effects-c").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});

			// Remove padding, set opening and closing animations, close if clicked and disable overlay
			$(".fancybox-effects-d").fancybox({
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				helpers : {
					overlay : null
				}
			});

			/*
			 *  Button helper. Disable animations, hide close button, change title type and content
			 */

			$('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});


			/*
			 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
			 */

			$('.fancybox-thumbs').fancybox({
				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,
				arrows    : false,
				nextClick : true,

				helpers : {
					thumbs : {
						width  : 50,
						height : 50
					}
				}
			});

			/*
			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
			*/
			$('.fancybox-media')
				.attr('rel', 'media-gallery')
				.fancybox({
					openEffect : 'none',
					closeEffect : 'none',
					prevEffect : 'none',
					nextEffect : 'none',

					arrows : false,
					helpers : {
						media : {},
						buttons : {}
					}
				});

			/*
			 *  Open manually
			 */

			$("#fancybox-manual-a").click(function() {
				$.fancybox.open('1_b.jpg');
			});

			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});

			$("#fancybox-manual-c").click(function() {
				$.fancybox.open([
					{
						href : '1_b.jpg',
						title : 'My title'
					}, {
						href : '2_b.jpg',
						title : '2nd title'
					}, {
						href : '3_b.jpg'
					}
				], {
					helpers : {
						thumbs : {
							width: 75,
							height: 50
						}
					}
				});
			});


		});
	</script>
	<script type="text/javascript" src="js/provider_profile.js"></script>
	<script type="text/javascript" src="js/autosize.js"></script>	
</head>
	<body>
		@section('body')
		@show
	</body>
</html>