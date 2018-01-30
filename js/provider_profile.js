$(document).ready(function(){
	$('.dess a').click(function(event){
	    event.preventDefault();
		var title_text=$('.title_description h3').text();
		var title_description_text=$('.title_description p').text();
		var textarea='<textarea class="form-control builder_type builder_text required" style="margin: 0px; width: 832px; height: 83px;" name="user_prof_description" placeholder="Type your profile description">'+title_description_text+'</textarea>';
		$('.title_description:eq(1)').html(textarea);
		autosize(document.querySelectorAll('textarea'));
		var input_box='<input class="form-control builder_type required" placeholder="Type your profile title" name="prof_title" type="text" value="'+title_text+'">';
		$('.title_description:eq(0)').html(input_box);
		$('.dess').append('<button type="submit" class="btn btn-primary mark_com pull-right post_bbttn submit_button">Submit</button>');
	});
	$('.edit_div a').click(function(event){
		$(this).hide();
	 event.preventDefault();
	$('.catt1,.mapps').hide();
	$('.edited_cat').show();
	var country_code = "UK";		
	var countryRestrict = {'country': country_code};
	var acOptions1 = {
		componentRestrictions: countryRestrict
	};
	var input = document.getElementById('location');
	var autocomplete = new google.maps.places.Autocomplete(input,acOptions1);
	 google.maps.event.addListener(autocomplete, 'place_changed', function() {
	//input.className = '';
	var place = autocomplete.getPlace();
	 document.getElementById('longitude').value = place.geometry.location.lng();
	 document.getElementById('lattitude').value = place.geometry.location.lat();
	});
	$('#from_time').timepicker();
	$('#to_time').timepicker();
	});
	$('.edit_iico').click(function(event){
		event.preventDefault();		
		$('#imgupload').trigger('click');
	});	
	$('#before_image').click(function(){
		console.log('before_image_caption');
		$("#before_image_file_id").trigger('click');
	});
	$('#after_image').click(function(){
		console.log('after_image_caption');
		$('#after_image_file_id').trigger('click');	
	});
	
	$('#portpolio_button').click(function(event){
		event.preventDefault();
		$('#myModal1').modal('show');
	});
	$("#imgupload").change(function () {
	$(".submit_prof_pic").html('<input type="submit" class="pro_pic_upload" value="upload">');
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var img = $('<img>').attr('src', e.target.result).attr('class',"img-circle img-ppic");
            $('.upload-image-preview').html(img);
        };
        reader.readAsDataURL(this.files[0]);
    }
	});
	$('#after_image_file_id').change(function () {
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var img = $('<img>').attr('src', e.target.result).attr('height','100').attr('width','150');
            $('.after_image').html(img);
        };
        reader.readAsDataURL(this.files[0]);
    }
	});
	
	$('#before_image_file_id').change(function (){
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var img = $('<img>').attr('src', e.target.result).attr('height','100').attr('width','150');
            $('.before_image').html(img);
        };
        reader.readAsDataURL(this.files[0]);
    }
	});
	$(".engg_panel a").click(function(event){
		event.preventDefault();
		$(this).hide();
		var qualification_text=$('.engg_panel h3').text();
		var form_box='<form action="prof-description-third-block" method="get" id="prof-description-third-block"><div class="col-md-4 col-sm-6 co-xs-12"><div class="your-mail"><input class="form-control required" placeholder="Type your company name" name="qualification" type="text" value="'+qualification_text+'"></div></div><button type="submit" class="btn btn-primary mark_com pull-right post_bbttn">Submit</button></form>';	
		$(".engg_panel").html(form_box);
	});
	$('#logo_button').click(function(event){
		event.preventDefault();	
		$("#myModal2").modal('show');
	});
	
	$("#logo_image").change(function(){
		console.log('#logo_image');
		if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var img = $('<img>').attr('src', e.target.result).attr('class','img-thumbnail').attr('height','100').attr('width','150');
            $('.logo_view_image').html(img);
        };
        reader.readAsDataURL(this.files[0]);
    }
	})
	$("#prov_form").validate();
	$('#portpolio-frm').validate();
	$('#logo-frm').validate();
	$('#prof-description-third-block').validate();
	$('#prof-description-secend-block').validate();
});