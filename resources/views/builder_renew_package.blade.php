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
                            {{--  <div class="one_package" style="float: left;">
                            	<img src="images/package2.png" alt="">
                                <p>Package Type <span>{{ $package_name }}</span> </p>
                            </div>  --}}
                            {{--  <div class="one_package">
                            	<img src="images/package1.png" alt="">
                                <p>Credit Left  <span>30</span> </p>
                            </div>  --}}
                        
                        <div class="package_table">                        
                            <div class="table_area">                            
                            	<div class="trip_table">
                                    	<div class="">
                                        	<div class="table">
                                            	
                                                <div class="one_row1 hidden-xs">
                                                    <div class="cell1 tab_head_sheet">Package Type</div>
                                                    <div class="cell1 tab_head_sheet">Cost</div>
                                                    <div class="cell1 tab_head_sheet">Credits You Recieve</div>
                                                    <div class="cell1 tab_head_sheet">Valid from</div>
                                                    <div class="cell1 tab_head_sheet">Valid to</div>
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
                                                            <span class="W55_1">Credits You Recieve</span>
                                                            <p class="add_ttrr">{{ Date('F j, Y',strtotime($valid_from))}}</p>
                                                     </div>
                                                    <div class="cell1 tab_head_sheet_1 nn_rbnn">
                                                            <span class="W55_1">Credits You Recieve</span>
                                                            <p class="add_ttrr">{{ Date('F j, Y',strtotime($valid_to)) }}</p>
                                                    </div>
                                                   
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
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="package_subscribe">
                            
                                <label>Exist one
                                <input  type="radio" id="package"  name="use_credit_card" value="exits_one"/>
                                </label>
                                 <label>New one
                                    <input  type="radio" id="package" name="use_credit_card" value="new_one"/>
                                </label>
                          
                        </div>
                        <div class="new_credit_card" style="display:none">
                                <div class="cardsp">
                                        <ul>
                                            <li><a href="#"><img src="images/card_1.png" alt="" id="visa"></a></li>
                                            <li><a href="#"><img src="images/card_2.png" alt="" id="mastercard" ></a></li>
                                        </ul>
                                    </div>
                        <form id="submit_package_for_payment" action="stripe" method="post">
                                {{csrf_field()}}
                                <input type="hidden" name="amount" value="255"/>
                                <div class="col-md-4 col-sm-6 co-xs-12">
                                       <div class="your-mail">
                                           <label>Name on Card</label>
                                           <input class="form-control owner" placeholder="Your Name" type="text" name="name_on_card" id="owner">
                                       </div>
                                   </div>
                                   <div class="col-md-4 col-sm-6 co-xs-12">
                                       <div class="your-mail" id="card-number-field">
                                           <label>Card Number</label>
                                           <input class="form-control" placeholder="Card Number" type="text" id="cardNumber" name="card_no">
                                       </div>
                                   </div>
                                   <div class="col-md-4 col-sm-6 co-xs-12">
                                       <div class="">
                                           <div class="your-mail" id="expiration-date">
                                           <label>Expiration Date</label>
                                           <div class="exprtn">
                                               <select class="form-control newdrop3" name="ccExpiryMonth">
                                               <option value="01">January</option>
                                               <option value="02">February </option>
                                               <option value="03">March</option>
                                               <option value="04">April</option>
                                               <option value="05">May</option>
                                               <option value="06">June</option>
                                               <option value="07">July</option>
                                               <option value="08">August</option>
                                               <option value="09">September</option>
                                               <option value="10">October</option>
                                               <option value="11">November</option>
                                               <option value="12">December</option>
                                               </select>
                                           </div>
                                           <div class="exprtn2">      
                                               <select class="form-control newdrop3" name="ccExpiryYear">
                                                       @php
                                                           $year=Date('Y');
                                                       @endphp
                                                       @for($i=0;$i<=6;$i++)
                                                       <option value="{{ $year }}">{{ $year++ }}</option>	
                                                       @endfor	
                                               </select> 
                                           </div>  	
                                           </div>
                                       </div>  
                                   </div>
                                   <div class="col-md-4 col-sm-6 co-xs-12">
                                       <div class="your-mail">
                                           <label>CCV</label>
                                           <input class="form-control" name="cvvNumber" placeholder="Type your CCV number" type="text" id="cvv">
                                       </div>
                                   </div>
                           <div class="col-md-12">
                               <div class="your-mail">
                                   <input value="Checkout" class="btn btn-default" id="confirm-purchase" type="submit">
                               </div>
                           </div>
                           </form>
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
 <script>
     $('[name="use_credit_card"]').click(function(){
         if($(this).val()=='new_one'){
            $('.new_credit_card').show();
         }else{
            $('.new_credit_card').hide();
         }
       
     });
        
 </script>   
@endsection
<!-- Modal -->




