@extends('layout.app') 
@section('title','My Profile') 
@section('body')
<script src="js/jquery.payform.min.js" charset="utf-8"></script>
 <script src="js/script.js"></script>
<!--wrapper start-->
	<!--wrapper start-->
    <div class="wrapper">
    	<div class="row Nomarg">
            	@include('layout.provider_header')
        </div> 
        <section class="package_body">
        	<div class="container">
            	<div class="row">
                	<div class="col-md-12">
                    	<div class="package_box">
                            @if ($message = Session::get('success'))
                            <div class="custom-alerts alert alert-success fade in">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                {!! $message !!}
                            </div>
                            <?php Session::forget('success');?>
                            @endif
                            <div class="one_package">
                            	<img src="images/package2.png" alt="">
                                <p>Package Type <span>{{ $package_name }}</span> </p>
                            </div>
                            <div class="one_package">
                            	<img src="images/package1.png" alt="">
                                <p>Credit Left  <span>30</span> </p>
                            </div>
                        </div>
                        
                        <div class="package_table">
                        	<h2>Package</h2>
                            <div class="table_area">
                            	<div class="trip_table">
                                    	<div class="">
                                        	<div class="table">
                                                <div class="one_row1 hidden-xs">
                                                    <div class="cell1 tab_head_sheet">Package Type</div>
                                                    <div class="cell1 tab_head_sheet">Cost</div>
                                                    <div class="cell1 tab_head_sheet">Credits You Recieve</div>                                                    
                                                    <div class="cell1 tab_head_sheet">&nbsp;</div>
                                                </div>
                                                
                                                <div class="one_row1 small_screen31 small_1">
                                                	<div class="cell1 tab_head_sheet_1 nn_rbnn">
                                                    	<span class="W55_1">Package Type</span>
                                                        <p class="add_ttrr">{{ $package_name }}</p>
                                                    </div>
                                                	
                                                    <div class="cell1 tab_head_sheet_1 nn_rbnn">
                                                    	<span class="W55_1">Cost</span>
                                                        <p class="add_ttrr">&pound; {{ $price }}</p>
                                                    </div>
                                                    <div class="cell1 tab_head_sheet_1 nn_rbnn">
                                                    	<span class="W55_1">Credits You Recieve</span>
                                                        <p class="add_ttrr">{{ $credit_receive }}</p>
                                                    </div>
                                                    <div class="cell1 tab_head_sheet_1 nn_rbnn">
                                                        <span class="W55_1">&nbsp;</span>
                                                        <p class="add_ttrr"><a class="sub_bttn sub_b uu" href="#"> Upgrade </a> 
                                                        @if ($is_renewed)
                                                            <a class="sub_bttn sub_b marggL10" id="renew" href="javascript:void(0)"> Renew </a></p>  
                                                        @endif
                                                        <!--<p class="add_ttrr"><a class="sub_bttn sub_b" href="#"> Downgrade </a> </p>-->
                                                    </div>
                                                    <form action="renew-package" method="post" id="renew_package">
                                                        {{csrf_field()}}
                                                    </form>
                                                </div>
                                                
                                                <div class="one_row1 small_screen31 small_1 ss" style="display:none">
                                                	<div class="cell1 tab_head_sheet_1 nn_rbnn">
                                                    	<span class="W55_1">Package Type</span>
                                                        <p class="add_ttrr">Bronze </p>
                                                    </div>
                                                	
                                                    <div class="cell1 tab_head_sheet_1 nn_rbnn">
                                                    	<span class="W55_1">Cost</span>
                                                        <p class="add_ttrr">&pound; 100</p>
                                                    </div>
                                                    <div class="cell1 tab_head_sheet_1 nn_rbnn">
                                                    	<span class="W55_1">Credits You Recieve</span>
                                                        <p class="add_ttrr">70</p>
                                                    </div>
                                                    
                                                    <div class="cell1 tab_head_sheet_1 nn_rbnn">
                                                    	<span class="W55_1">&nbsp;</span>
                                                        <p class="add_ttrr on_go">  <a class="sub_bttn sub_b" href="#"> Buy Now  </a> </p>
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="one_row1 small_screen31 small_1 sss" style="display:none">
                                                	<div class="cell1 tab_head_sheet_1 nn_rbnn">
                                                    	<span class="W55_1">Package Type</span>
                                                        <p class="add_ttrr">Silver</p>
                                                    </div>
                                                	
                                                    <div class="cell1 tab_head_sheet_1 nn_rbnn">
                                                    	<span class="W55_1">Cost</span>
                                                        <p class="add_ttrr">&pound; 150</p>
                                                    </div>
                                                    <div class="cell1 tab_head_sheet_1 nn_rbnn">
                                                    	<span class="W55_1">Credits You Recieve</span>
                                                        <p class="add_ttrr">110</p>
                                                    </div>
                                                    
                                                    <div class="cell1 tab_head_sheet_1 nn_rbnn">
                                                    	<span class="W55_1">&nbsp;</span>
                                                        <p class="add_ttrr"><a class="sub_bttn sub_b" href="#"> Buy Now </a> </p>
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="one_row1 small_screen31 small_1 ssss" style="display:none">
                                                	<div class="cell1 tab_head_sheet_1 nn_rbnn">
                                                    	<span class="W55_1">Package Type</span>
                                                        <p class="add_ttrr">Gold</p>
                                                    </div>
                                                	
                                                    <div class="cell1 tab_head_sheet_1 nn_rbnn">
                                                    	<span class="W55_1">Cost</span>
                                                        <p class="add_ttrr">&pound; 350</p>
                                                    </div>
                                                    <div class="cell1 tab_head_sheet_1 nn_rbnn">
                                                    	<span class="W55_1">Credits You Recieve</span>
                                                        <p class="add_ttrr">110</p>
                                                    </div>
                                                    
                                                    <div class="cell1 tab_head_sheet_1 nn_rbnn">
                                                    	<span class="W55_1">&nbsp;</span>
                                                       <p class="add_ttrr"><a class="sub_bttn sub_b" href="#"> Buy Now </a> </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="card_details">
                        	<h2>Your Credit Card is Saved</h2>
                            <a class="sub_bttn" href="javascript:void(0)" id="credit_card_form">Change card details</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('layout.builder_footer')
        <!-- Return to Top -->
		<a href="javascript:" id="return-to-top"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
    </div>
    <!--wrapper end-->
    @component('modal.builder_change_card_details',['title'=>'Change Card Details'])
		Modal pop-up HTML of mark complete will be included.
@endcomponent
<script>
        $(document).ready(function() {
        $('#credit_card_form').click(function(event){
            $('#change_card_details').modal('show');   
        }); 
        });
</script>
<script>
    $('#renew').click(function(){
        $('#renew_package').submit();
    });
</script>
@if(session()->get('success'))
@component('alert.sweet_alert')
	 @slot('message')
	 {{session()->get('success')}}
    @endslot
 Sweet alert message
@endcomponent
@endif 
@endsection
<!-- Modal -->




