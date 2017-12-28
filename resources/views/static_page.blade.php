@extends('layout.app')
@section('title',__(@$page->page_title))
@section('body')
<div class="wrapper">
	<header class="header_area">
		@if(session()->get('user_id') =="")
			@include('layout.header')
		@else
			@if(session()->get('user_type') == 2)
				@include('layout.provider_header')
			@else 
				@include('layout.customer_header')
			@endif
		@endif
	</header>
	<section class="">
		<!--<div class="about_banner">
			<h2>{{@$page->page_title}}</h2>
			<img src="images/tradesmen11.jpg"/> 
		</div>-->
		<div class="about_content">
			<div class="container">
				@php echo @$page->page_description; @endphp
			</div>
		</div>
	</section>
	@include('layout.footer')
</div>
@endsection