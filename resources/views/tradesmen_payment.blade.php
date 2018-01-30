@extends('layout.app')
@section('title','Tradesmen Signup')
@section('body')
<script src="js/jquery.payform.min.js" charset="utf-8"></script>
 <script src="js/script.js"></script>
<div class="wrapper">
	<header class="header_area">
		@include('layout.header')
		<div class="tradesmen"><img src="images/tradesmen.jpg" alt="">
			<div class="iner_contain">
				<div class="container">
					<div class="left_cntent">
						<h2>Connect with new customers today</h2>
						<ul>
							<li><img src="images/lfrarw.png" alt=""> Sign up now to start receiving job leads</li>
							<li><img src="images/lfrarw.png" alt=""> Buy the leads you want</li>
							<li><img src="images/lfrarw.png" alt=""> win the work & get rated</li>
						</ul>
						<!--<button type="submit" class="btn sub_bttn sgnw">sign up now</button>-->
					</div>
				</div>
			</div>
        </div>
	</header>
						@if ($message = Session::get('success'))
								<div class="custom-alerts alert alert-success fade in">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
									{!! $message !!}
								</div>
								<?php Session::forget('success');?>
								@endif
								@if ($message = Session::get('error'))
								<div class="custom-alerts alert alert-danger fade in">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
									{!! $message !!}
								</div>
								<?php Session::forget('error');?>
								@endif
	<div class="tradesmen_signup">
		<div class="container">
			<div class="bred">
				<ul>
					<li class="active"><a href="javascript:void(0)"><span class="rundd">1</span>Set-up your account</a></li>
					<li class="active"><a href="javascript:void(0)" class="pdngL"><span class="rundd">2</span> Verify your identity</a></li>
					<li class="active"><a href="javascript:void(0)" class="pdngL nbdr"><span class="rundd">3</span> Payment</a></li>
				</ul>
			</div> 
			<div class="clearfix"></div>
			<div class="setup_frm">
			<div class="col-md-3 col-sm-12 ">
					<div class="one_pac">
					<h5>Activation</h5>
					<table class="table table-striped package_subscribe">
							<thead>
							  <tr>
								  <th scope="col"></th>								 
								  <th scope="col">Cost</th>
								  <th scope="col">Duration</th>								  
							  </tr>
							</thead>
							  <tbody>	
								  <tr>
									<td><input type="radio" checked id="activation_package" form="submit_package_for_payment" name="activation_package_id" value="{{$memberPackageDetails->package_id}}"/></td>
									<td>€ {{ $memberPackageDetails->cost }}</td>
									<td>
										@if ($memberPackageDetails->duration==1)
										{{ '3 Months' }} 
										@endif
									</td>										
								  </tr>
							</tbody>
						  </table> 
						<div class="auto">
								<label>Auto renewal</label>
								<div class="checkbox_to_select chhkk" >
									<input type="checkbox" name="auto_renew"  form ="submit_package_for_payment" id="auto_renew" value="Yes">
								</div>
						</div>
				</div>
			</div>
			<div class="col-md-1 col-sm-12 plss" style="text-align:center;">
					<i class="fa fa-plus" aria-hidden="true"></i>
                    {{--  <div class="checkbox_to_select pac_chck" >
					<input type="checkbox" name="package_select" id="package_select">
				</div>  --}}
			</div>
			<div class="col-md-5 col-sm-12 " style="position:relative">
            	<div class="one_pac">
					<h5>Credit Packages</h5> 
                    {{--  <div class="auto">
                    	<label>Auto renew</label>
                        <div class="checkbox_to_select chhkk" >
                            <input type="checkbox" name="package_select" id="package_select">
                        </div>
                    </div>  --}}
                	<table class="table table-striped package_subscribe">
                      <thead>
						<tr>
							<th scope="col"></th>
							<th scope="col">Type</th>
							<th scope="col">Cost</th>
							<th scope="col">Credit point</th>
							{{--  <th scope="col">Period</th>  --}}
							<th scope="col">Package Description</th>
                        </tr>
                      </thead>
						<tbody>											
							@foreach ($creditPackageDetails as $item)
							<tr>
									<td><input type="radio" id="package" checked form="submit_package_for_payment" data-package-type="{{$item->credit_type_package_name}}" data-price="{{$item->cost}}" name="credit_package_id" value="{{$item->package_id}}"/></td>
									<td>
										{{$item->credit_type_package_name}}	
									</td>
									<td>£ {{ $item->cost }}</td>
									<td>£ {{ $item->credit_point }}</td>
									{{--  <td>{{ $item->period }}</td>  --}}
									<td>{{ $item->package_description }}</td>														
							</tr>
							@endforeach
							<tr>
									<td><input type="radio" id="package" checked form="submit_package_for_payment" data-price="0" name="credit_package_id" value="0"/></td>
									<td>None</td>
									<td></td>
									<td></td>
									<td></td>														
							</tr>
                      </tbody>
                    </table>
                    </div>
                </div>
                
			<div class="col-md-3 col-sm-12">
            	<div class="one_pac">
						<h5>Cart Details</h5> 
						<table class="table table-striped package_subscribe">
						  <thead>
							<tr>
								
								<th scope="col">Package Type</th>
								<th scope="col">Cost</th>
							</tr>
						  </thead>
							<tbody>	
								<tr>
										<td> Activation </td>
										<td>£ {{$memberPackageDetails->cost }}</td>			
								</tr>
								<tr class="credit_point_package" style="display:none">
								<td><span class="credit_type_package_name"></span> </td>
								<td>£ <span class="credit_type_package_price"></span></td>			
								</tr>
								
						  </tbody>
						</table>
						<div class="total_price">
							<div class="price">
                            	<b>Total price</b>
								<span>£ <span class="calculate_price">{{$memberPackageDetails->cost}}</span></span>
							</div>
						</div>
					</div>
            </div>        
				<h5>Payment</h5>
				<div class="clearfix"></div>
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
						<input value="fINISH" class="btn btn-default" id="confirm-purchase" type="submit">
					</div>
				</div>
				</form>
				{{--  <form action="/your-server-side-code" method="POST" id="submit_package_for_payment">
					<script
						src="https://checkout.stripe.com/checkout.js" class="stripe-button"
						data-key="pk_test_U8kQCyPl6Uop0wup5F5Jkp3M"
						data-amount="999"
						data-name="Demo Site"
						data-description="Widget"
						data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
						data-locale="auto">
					</script>
				</form>  --}}
				</div>
				</div>
			</div>
		</div>
	</div>
	@include('layout.footer')
</div>
<script>
$(document).ready(function(){
	$('#tradesmen_frm').validate();
	$('[name="credit_package_id"]').click(function(){
		var package_price=$(this).attr('data-price');
		var package_type=$(this).attr('data-package-type');
		if(package_price==0)$('.credit_point_package').hide();
		if(package_price!=0)$('.credit_point_package').show();
		$('.credit_type_package_name').html(package_type);
		$('.credit_type_package_price').html(package_price);
		var activation_price=parseFloat("{{$memberPackageDetails->cost}}");
		var total_price=parseFloat(activation_price)+parseFloat(package_price);
		$('.calculate_price').html(total_price);
		});
});
</script>
@endsection