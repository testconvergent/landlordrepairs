<div id="change_card_details" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Review Modal content-->
		<div class="modal-content bborder_bottom">
			<div class="modal-header review_modal_header">
				<button type="button" class="close cllose" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>
				</button>
				<h4 class="modal-title">{{$title}}</h4>
			</div>
			<div class="modal-body review_modal_body1 NopaddB">
				<form class="modal_form_rreview" id="submit_package_for_payment" action="change-card-details" method="post" enctype="multipart/form-data">
				{{csrf_field()}}
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
					<div class="col-md-4 col-sm-6 co-xs-12">
							<div class="your-mail">
								<input value="Update" class="btn btn-default" id="confirm-purchase" type="submit">
							</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>