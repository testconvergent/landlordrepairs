<div id="myModal2" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Review Modal content-->
        <div class="modal-content bborder_bottom">
            <div class="modal-header review_modal_header">
                <button type="button" class="close cllose" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>
                </button>
                <h4 class="modal-title">Logo </h4>
            </div>
            <div class="modal-body review_modal_body1 NopaddB">
                <div class="col-md-12 popad">
                    <div class="recomnd modal_logo">
                        <div class="radio_area port_pop">
                            <form action="prof-description-logo-block" id="logo-frm" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="col-md-12">
                                    <div class="logo_view_image view-first"></div>
                                    <div class="upload_icon">
                                        <div class="Uploadbtn">
                                            <input type="file" name="logo_image" id="logo_image" class="input-upload required">
                                            <span> <b>Upload</b> <i><img src="images/ddownload.png"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" style="margin-top:15px;">
                                    <input type="submit" class="btn btn-primary mark_com pull-left post_bbttn" value="Submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>