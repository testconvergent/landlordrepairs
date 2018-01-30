<div id="request_feed" class="modal fade " role="dialog">
	<div class="modal-dialog"> 
	<!-- Review Modal content-->
		<div class="modal-content bborder_bottom">
			<div class="modal-header review_modal_header">
				<button type="button" class="close cllose" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> </button>
				{{$title}}
			</div>
			<div class="modal-body request_feed_msg">
				<h3><i class="fa fa-commenting-o" aria-hidden="true"></i> Your feedback request is send to the customer. </h3>
			<form action="request-feedback" method="post" id="request-feedback">
			 {{csrf_field()}}
			   <input type="hidden" name="invitation_master_id" id="invitation_master_id" value="">
				<div class="form-group">				  
				  <textarea class="form-control required" rows="3" name="request_feedback" id="comment"></textarea>
				</div>
				<button type="submit" class="btn btn-primary mark_com">Submit</button>
			</form>
			</div>
		</div>
	</div>
</div>