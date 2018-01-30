<div id="mark_complete" class="modal fade" role="dialog">
	<div class="modal-dialog"> 
	<!-- Review Modal content-->
		<div class="modal-content bborder_bottom">
			<div class="modal-header review_modal_header">
				<button type="button" class="close cllose" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> </button>
				<h4 class="modal-title">{{$title}}</h4>
			</div>
			<div class="modal-body marks_completed NopaddB">
				<form action="provider-mark-complete-job" method="post" id="provider-mark-complete-job">
				{{csrf_field()}}
					<h3><i class="fa fa-check-circle" aria-hidden="true"></i>
					<span>The job is marked as completed and costomers are notified</span></h3>
					<input type="hidden" name="invitation_id" id="invitation_id">
					<div class="form-group">				  
					  <textarea class="form-control required" rows="5" name="request_feedback" id="comment"></textarea>
					</div>
					<button type="submit" class="btn btn-primary mark_com">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>