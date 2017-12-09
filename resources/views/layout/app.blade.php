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
    <link href="css/font-awesome.min.css" type="text/css" rel="stylesheet" media="all"/>
    <!--fonts-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700|Roboto:100,300,400,500,700,900" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet"> 
    <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script src="js/jquery.min.js"></script>
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
    $( "#datepicker" ).datepicker();
  } );
  
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
</head>
	<body>
		@section('body')
		@show
	</body>
</html>