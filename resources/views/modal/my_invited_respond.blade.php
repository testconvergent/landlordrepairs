<div id="myModal1" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Review Modal content-->
		<div class="modal-content bborder_bottom">
			<div class="modal-header review_modal_header">
				<button type="button" class="close cllose" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>
				</button>
				<h4 class="modal-title">Response</h4>
			</div>
			<div class="modal-body review_modal_body1 NopaddB">
				<form class="modal_form_rreview" id="submit_quote" action="provider-quote-submit" method="post" enctype="multipart/form-data">
				{{csrf_field()}}
						<input type="hidden" name="invitation_id" id="invitation_id">
					<div class="col-sm-6 col-lg-6 col-md-6">
						<div class="form-group">
							<label class="control-label" for="pwd">Price</label>
							<input type="text" class="form-control required" name="price" placeholder="Price" onkeypress="validate(event)">
						</div>
					</div>
					<div class="col-sm-6 col-lg-6 col-md-6">
						<div class="form-group">
							<label class="control-label">Start Date</label>
							<div class="ccal">
								<img src="images/call.png">
								<input type="text" class="form-control required" placeholder="Start date" name="start_date" id="datepicker" readonly style="background-color: #fff;">
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-lg-12 col-md-12">
						<div class="form-group">
							<label class="control-label">Description</label>
							<textarea class="form-control required" name="quote_description" rows="3" id="comment"></textarea>
						</div>
					</div>
					<div class="col-sm-6 col-lg-6 col-md-6">
						<div class="form-group">
							<div class="Uploadbtn">
								<input type="file" id="quote_attachment" name="quote_attachment" class="input-upload" />
								<span> <b>Upload</b> <i><img src="images/ddownload.png"></i></span>
							</div>
						</div>
						<div class="file_name"></div>
					</div>
					<div class="col-sm-6 col-lg-6 col-md-6">
						<button type="submit" class="btn btn-primary mark_com pull-right MargT30 post_bbttn">Post</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>