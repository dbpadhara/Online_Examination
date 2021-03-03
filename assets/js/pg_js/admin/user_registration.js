var table='';

window.onload=function()
{
	table =$('#sample').DataTable({
		  dom: 'Bfrtip',
		  buttons: [
		    'copy', 'excel', 'csv', 'pdf', 'print'
		  ], ajax : "controller.php?action=getUsers",
            	columns : [ {
            		"data" : "user_id"
            	},{
            		"data" : "user_name"
            	},{
            		"data" : "field_id"
            	},{
            		"data" : "semester"
            	},{
            		"data" : "email"
            	},{
            		"render" : function(data,type,JsonResultRow,meta){//mimage using for database model vastu
            			return '<img style="height:80px;width:80px;" src="../assets/uploads/'+JsonResultRow.profile_pic+'">'
            		}
            	},{
            		"render":function(data,type,JsonResultRow,meta){
            					if(JsonResultRow.status==0){
            						return '<button class="btn btn-danger" id="status">Block</button>'
            					}else{
            						return '<button class="btn btn-success" id="status">Active</button>'
            					}
            				}
            	},{
            		"data" : " "
            	} ],
            	columnDefs : [
            			{
            				"targets" : -1,
            				"data" : null,
            				"defaultContent" :'<button class="btn btn-icon btn-primary" data-toggle="modal" data-target="#add_form" id="update"><i class="fa fa-edit"></i></button>&nbsp;<button class="btn btn-icon btn-danger" id="delete"><i class="fa fa-trash"></i></button>'
            			},
            			{
            				"targets" : [0],
            				"visible" : false,
            				"searchable" : false
            			}
            	],
            	"order" : [ [ 0, "desc" ] ],
            });


	//use update the user data

	$('#sample tbody').on( 'click', '#update', function () { 
		
		var  data = table.row($(this).parents('tr')).data();
		// console.log(data);
		$('[name = "id"]').val(data["user_id"]);
		$('[name = "username"]').val(data["user_name"]);

		//set and select the data of field option
		$('#field option:first').val(data['field_id']);
		$('#field option:first').attr('selected','selected');

		//set and select the data of field option
		$('#semester option:first').val(data['semester']).html('semester-'+data['semester']);
		$('#semester option:first').attr('selected','selected');

		// $('#profile_image').attr('src','../uploads/'+data['profile_pic']);
		// $('#profile_image').val(data['profile_pic']);

		$('[name = "email"]').val(data["email"]);
		$('[name = "password"]').val(data["password"]);
	});


	//using updating the ststus

	$('#sample tbody').on( 'click', '#status', function () { 
		
		var  data = table.row($(this).parents('tr')).data();
		let id=data['user_id'];
		let status=data['status'];
		// alert(id+" "+status);

		$.ajax({
		url : 'controller.php',
		method : 'POST',
		data : {"action":"updateStatus","id":id, "status":status},
		success : function(ret){
			let data=JSON.parse(ret);
			console.log(data);
			if (ret) {
				
				iziToast.success({
		    	    title: 'Success',
		    	    message: 'status can be updated!!!',
		    	    position: 'topRight'
		    	  });
				table.ajax.reload();
			}else{
				iziToast.error({
		    	    title: 'error',
		    	    message: 'status cannot inserted!!!',
		    	    position: 'topRight'
		    	  });
				res();
			}
		}
	}); //ajax function can be finished

	});//status function can be finished 

	$('#sample tbody').on( 'click', '#delete', function () { 
		  var  data = table.row($(this).parents('tr')).data();
		  // alert(data['user_id']);
		  if(confirm("Are you sure.?")){
		  		$.ajax({
	            		type:"POST",
	            		  url: "controller.php",
	            		  data:{'action':'deleteUser','id':data["user_id"]},
	            		  dataType : "JSON",
	            		  success:function reload(ret){
	            		  	let data = JSON.parse(ret);
	            			  if (data) {
	            					
	            					iziToast.success({
	            			    	    title: 'Success',
	            			    	    message: 'record can be deleted!!!',
	            			    	    position: 'topRight'
	            			    	  });
	            					$('#add').attr('disabled',false);
	            					table.ajax.reload();
	            					// res();
	            				}else{
	            					iziToast.error({
	            			    	    title: 'error',
	            			    	    message: 'record cannot deleted!!!',
	            			    	    position: 'topRight'
	            			    	  });
	            					// res();
	            				} 
	            		  },
	        		});
		  }else{
		  	iziToast.warning({
	    	    title: 'warning',
	    	    message: 'record cannot inserted!!!',
	    	    position: 'topRight'
	    	  });
		  }
	});
}
function res(){
	
	$('#user_id').val(0);
	$('#user_registration')[0].reset();
	$("#profile_image").attr('src','');
	$('#add_form').modal('hide');	
}

//set image source from 
//remove image source
function remo(){
	$("#profile_image").val("");
	$('#view').attr("src","");
}

function show(){
	$('#user_registration')[0].reset();	
	$('#add_form').modal('show');
	$('#field option:first').val("").html('----------select Field----------');
	$('#field option:first').attr('selected','selected');

		//set and select the data of field option
	$('#semester option:first').val("").html('----------select Semester----------');
	$('#semester option:first').attr('selected','selected');
	// $('#profile_image').prop('files')[0].reset();
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

function save(){
	
	var name = $('[name = "username"]');
	var field = $('[name = "field"]');
	var semester = $('[name = "semester"]');
	var email = $('[name = "email"]');
	var password = $('[name = "password"]');
	var profile = $('[name = "profile"]');

	if(empty_data(name,"username")){
		if(allLetter(name,"username")){
			if(empty_data(field,"field")){
				if(empty_data(semester,"semester")){
					if(empty_data(email,'email')){
						if(email){
							if(empty_data(password,"password")){
								if(password_length(password,8)){
									if(empty_data(profile,'profile')){
										if(check_image_file(profile,"image",400)){

										}else { return false; }
									}else{ return false; }
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
	var other_data = $('#user_registration').serializeArray();
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
			if (data=="true") {
				
				iziToast.success({
		    	    title: 'Success',
		    	    message: 'record can be inserted!!!',
		    	    position: 'topRight'
		    	  });
				$('#add').attr('disabled',false);
				
				table.ajax.reload();
				res();
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