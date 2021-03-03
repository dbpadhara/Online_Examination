function res(){
	$('#registration_form')[0].reset();
	
}

function check_email(){
	let email = $('[name = "email"]').val();
	console.log(email);
	$.ajax({
		url:'controller.php',
		method:'POST',
		data:{'action':'checkEmail','email':email},
		success:function(ret){
			let data = JSON.parse(ret);
			console.log(data);
			if(data=="true"){
				$('#email').html('email can be exist').addClass('text-danger');
			}else{
				$('#email').html('');
			}
		}
	})
}

function save(){

	var name = $('[name = "username"]');
	var field = $('[name = "field"]');
	var semester = $('[name = "semester"]');
	var email = $('[name = "email"]');
	var password = $('[name = "password"]');
	var conf_password = $('[name = "conf_password"]');
	var profile = $('[name = "profile"]');

	if(empty_data(name,"username")){
		if(allLetter(name,"username")){
			if(empty_data(field,"field")){
				if(empty_data(semester,"semester")){
					if(empty_data(email,'email')){
						if(email(email)){
							if(empty_data(password,"password")){
								if(password_length(password,8)){
									if(empty_data(conf_password,"confirm password")){
										if(same_length(password,conf_password)){
											if(empty_data(profile,'profile')){
												if(check_image_file(profile,"image",400)){

												}else { return false; }
											}else{ return false; }
										}else { return false; }
									}else { return false; }
								}else{ return false; }
							}else{ return false; }
						}else{ return false; }
					}else{ return false; }
				}else{ return false; }
			}else { return false; }
		}else{ return false; }
	}else{ return false; }

	

	var form_data = new FormData();
	
	var file_data = $('#profile_image').prop('files')[0];
	var other_data = $('#registration_form').serializeArray();
	$.each(other_data , function(key ,input) {
		form_data.append(input.name , input.value);
		console.log(input.name ,":", input.value);
	});

	console.log(file_data);
	form_data.append('file',file_data);

	$('#add').attr('disabled',true);
	$.ajax({
		url : 'controller.php',
		cache : false,
		contentType : false,
		processData : false,
		data : form_data,
		method : 'POST',
		success : function(ret){
			var data = JSON.parse(ret);
			console.log(data);
			if (data) {
				
				iziToast.success({
		    	    title: 'Success',
		    	    message: 'record can be inserted!!!',
		    	    position: 'topRight'
		    	  });
				$('#add').attr('disabled',false);
				res();
				setTimeout(
					function(){
						window.location.href="login.php";
					},
					5000
				);
				// table.ajax.reload();
				// res();
			}else{
				iziToast.error({
		    	    title: 'error',
		    	    message: 'record cannot inserted!!!',
		    	    position: 'topRight'
		    	  });
				res();
			}
		}
	});
}


getField();
function getField(){
	$.ajax({
		url:'controller.php',
		method:'POST',
		data: {'action':'getField'},
		success:function(ret)
		{	
			let data = JSON.parse(ret);
			// console.log(data); 
			$('#field_id').html('');
  			var optionf = $('<option/>');
			optionf.attr('value',"").text("select field");
			$('#field_id').append(optionf);
  			
			var obj=data.data;
			$(obj).each(function()
			{
				var option = $('<option />');
				option.attr('value', this.field_id).text(this.field_name);           
				$('#field_id').append(option);
         	});
		}		
	});
}