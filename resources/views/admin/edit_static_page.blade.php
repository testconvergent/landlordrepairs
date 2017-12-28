@extends('admin.layout.app')
@section('title','Edit Static Page')
@section('body')
    <div id="wrapper">
        @include('admin.layout.header')
        @include('admin.layout.nav')                    
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="pull-left page-title">Edit Page {{@$page->page_title}}</h4>
								<div class="submit-login pull-right">
									<a href="admin-static-page-list"><button type="submit" class="btn btn-default tpp">Back</button></a>
								</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-body table-rep-plugin">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12 nhp">
												<div class="table-responsive" data-pattern="priority-columns">
													<form id="add_blog" action="admin-edit-static-page/{{$page->page_id}}" enctype="multipart/form-data" method="post">
													{{csrf_field()}}
													<!--all_time_sho-->       
													<div class="all_time_sho">
														<div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
															<div class="your-mail">
																<label for="exampleInputEmail1">Description</label>
																<textarea placeholder="" rows="3" class="form-control message required froala-editor" name="page_description" id="blog_content">{{@$page->page_description}}</textarea>
																<span class="error content_error" id="static_page_content_error"></span>
															</div>
														</div>
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
															<div class="your-mail">
																<label for="exampleInputEmail1">Page Meta Title</label>
																<input type="text" class="form-control required" name ="page_meta_title" placeholder="" value="{{@$page->page_meta_title}}">
															</div>
														</div>
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
															<div class="your-mail">
																<label for="exampleInputEmail1">Page Meta Description</label>
																<textarea rows="3" class="form-control required" name ="page_meta_description">{{@$page->page_meta_description}}</textarea>
															</div>
														</div>
													</div>
													 <div class="clearfix"></div>
														<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
															<div class="add_btnm">
																<input value="Update" type="submit">
															</div>
														</div>
														<!--all_time_sho-->  
													</form>   
												</div>
											</div>
										</div>
									</div>
								</div>
                            </div>
                        </div> <!-- End Row -->
                    </div> <!-- container -->
                </div> <!-- content -->
			</div>
        </div>
		<style>
		.fr-wrapper div:first-child {
			display:none !important;
		}
		.fr-counter{
			display:none !important;
		}
		.fr-toolbar .fr-command.fr-btn.fr-hidden, .fr-popup .fr-command.fr-btn.fr-hidden
		{
			display:block !important;
		}
		#insertLink-1
		{
			display:none !important;
		}
		</style>
	<link href="text_editer/css/froala_editor.min.css" rel="stylesheet" type="text/css" />
	<link href="text_editer/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
	<link href="text_editer/css/froala_style.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="text_editer/css/code_view.css">
	<link rel="stylesheet" href="text_editer/css/colors.css">
	<link rel="stylesheet" href="text_editer/css/emoticons.css">
	<link rel="stylesheet" href="text_editer/css/image_manager.css">
	<link rel="stylesheet" href="text_editer/css/image.css">
	<link rel="stylesheet" href="text_editer/css/line_breaker.css">
	<link rel="stylesheet" href="text_editer/css/table.css">
	<link rel="stylesheet" href="text_editer/css/char_counter.css">
	<link rel="stylesheet" href="text_editer/css/video.css">
	<link rel="stylesheet" href="text_editer/css/file.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">

	<script type="text/javascript" src="text_editer/js/froala_editor.min.js"></script>
	<script type="text/javascript" src="text_editer/js/froala_editor.pkgd.min.js"></script>
	<script type="text/javascript" src="text_editer/js/align.min.js"></script>
	<script type="text/javascript" src="text_editer/js/code_beautifier.min.js"></script>
	<script type="text/javascript" src="text_editer/js/code_view.min.js"></script>
	<script type="text/javascript" src="text_editer/js/colors.min.js"></script>
	<script type="text/javascript" src="text_editer/js/draggable.min.js"></script>
	<script type="text/javascript" src="text_editer/js/emoticons.min.js"></script>
	<script type="text/javascript" src="text_editer/js/font_size.min.js"></script>
	<script type="text/javascript" src="text_editer/js/font_family.min.js"></script>
	<script type="text/javascript" src="text_editer/js/image.min.js"></script>
	<script type="text/javascript" src="text_editer/js/image_manager.min.js"></script>
	<script type="text/javascript" src="text_editer/js/line_breaker.min.js"></script>
	<script type="text/javascript" src="text_editer/js/link.min.js"></script>
	<script type="text/javascript" src="text_editer/js/lists.min.js"></script>
	<script type="text/javascript" src="text_editer/js/paragraph_format.min.js"></script>
	<script type="text/javascript" src="text_editer/js/paragraph_style.min.js"></script>
	<script type="text/javascript" src="text_editer/js/video.min.js"></script>
	<script type="text/javascript" src="text_editer/js/table.min.js"></script>
	<script type="text/javascript" src="text_editer/js/url.min.js"></script>
	<script type="text/javascript" src="text_editer/js/entities.min.js"></script>
	<script type="text/javascript" src="text_editer/js/char_counter.min.js"></script>
	<script type="text/javascript" src="text_editer/js/inline_style.min.js"></script>
	<script type="text/javascript" src="text_editer/js/save.min.js"></script>
	<script type="text/javascript" src="text_editer/js/file.min.js"></script>
	<script type="text/javascript" src="text_editer/js/ro.js"></script>
	<script>
			$(document).ready(function(){//alert();
				$('#add_blog').validate();
				$('#add_blog').submit(function(){
					$("#static_page_content_error").html('');
					var editorContent = $("#blog_content").val();
					//var editorContent1 = tinyMCE.get('meta_description').getContent();
					//alert(editorContent);
					if(editorContent == ""){
						// alert('Required');
						$("#static_page_content_error").html('This field is required.');
						return false;
					}
					else
					{
						$("#static_page_content_error").html('');
						return true;
					}
				});
			});
	</script>
	<script>
		$(function(){
			$('.froala-editor').froalaEditor({
				heightMin: 250,
				heightMax: 500,
				//align: 'left',
				imageDefaultAlign: 'left',
				videoDefaultAlign: 'left',
				toolbarButtons: ['html', '|', 'undo', 'redo', '|', 'selectAll', '|', 'bold', 'italic', 'underline',  '|', 'fontFamily', 'fontSize', '|', 'color', '|', 'paragraphStyle', 'paragraphFormat', '|', 'align', '|', 'formatOL', 'formatUL', '|', 'outdent', 'indent', '|', 'insertImage', 'insertTable', '|'],
				//videoInsertButtons: ['videoByURL', '|', 'videoEmbed'],
				imageAllowedTypes: ['jpeg', 'jpg', 'png'],
				videoAllowedTypes: ['mp4'],
				fileAllowedTypes: ['application/pdf', 'application/msword'],
				imageUploadURL:'<?php echo url('/admin-static-image');?>',
				//imageUploadMethod: 'P',
				videoUploadURL:'ajax/upload_video.php',
				fileUploadURL:'ajax/upload_file.php'
			}).on('froalaEditor.file.error', function(e, editor, error, response){
				console.log(error.code);
				alert(response);
				// Bad link.
				if(error.code == 1){
					
				}
				// No link in upload response.
				else if(error.code == 2){
					
				}
				// Error during image upload.
				else if(error.code == 3){
					
				}
				// Parsing response failed.
				else if(error.code == 4){
					
				}
				// Image too text-large.
				else if(error.code == 5){
					
				}
				// Invalid image type.
				else if(error.code == 6){
					
				}
				// Image can be uploaded only to same domain in IE 8 and IE 9.
				else if(error.code == 7){
					
				}
				// Response contains the original server response to the request if available.
			});
			
			//$('.froala-editor').froalaEditor('align.apply', 'left');
		});
	</script>
@endsection     