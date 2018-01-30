<div id="myModal1" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Review Modal content-->
        <div class="modal-content bborder_bottom">
            <div class="modal-header review_modal_header">
                <button type="button" class="close cllose" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>
                </button>
                <h4 class="modal-title">Portfolio</h4>
            </div>
            <div class="modal-body review_modal_body1 NopaddB">
                <div class="col-md-12 popad">
                    <div class="recomnd">
                        <div class="radio_area port_pop">
                            <form action="prof-description-portpolio-block" id="portpolio-frm" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="col-md-6">
                                    <div class="before_image view-first"></div>
                                    <div class="upload_icon">
                                        <div class="Uploadbtn">
                                            <input type="file" id="before_image_file_id" name="before_image" class="input-upload required">
                                            <span><b>choose before image</b> <i><img src="images/ddownload.png"></i></span>
                                        </div>
                                    </div>
                                    <div class="upload_caption">
                                        <input type="text" class="form-control builder_type required" name="before_image_caption" placeholder="Before image caption">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="after_image view-first"></div>
                                    <div class="upload_icon">
                                        <div class="Uploadbtn">
                                            <input type="file" id="after_image_file_id" name="after_image" class="input-upload required">
                                            <span> <b>choose after image</b> <i><img src="images/ddownload.png"></i></span>
                                        </div>
                                    </div>
                                    <div class="upload_caption">
                                        <input type="text" class="form-control builder_type required" name="after_image_caption" placeholder="After image caption">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <input type="submit" class="btn btn-primary mark_com pull-left post_bbttn" vlaue="Submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>