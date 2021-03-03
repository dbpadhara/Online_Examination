var table='';
window.onload=function()
{
	table =$('#sample').DataTable({
		  dom: 'Bfrtip',
		  buttons: [
		    'copy', 'csv', 'excel', 'pdf', 'print'
		  ], ajax : "controller.php?action=getEmployee",
            	columns : [ {
            		"data" : "employee_id"
            	},{
            		"data" : "employee_name"
            	},{
            		"data" : "role_id"
            	},{
            		"data" : "user_name"
            	},{
            		"data" : "password"
            	},{
            		"render": function (data, type, JsonResultRow, meta) {//mimage using for database model vastu
                        return '<img style = "height:100px;width:100px" src="../assets/uploads/employee/'+JsonResultRow.user_image+'">';
                    }
            	},{
            		"data" : "email"
            	},{
            		"data" : "mobile_number"
            	},{
            		"data" : " "
            	} ],
            	columnDefs : [
            			{
            				"targets" : -1,
            				"data" : null,
            				"defaultContent" :'<div class="dropdown"> <button class="btn btn-primary dropdown-toggle" type="button" id="about-us" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Action </button> <div class="dropdown-menu" aria-labelledby="about-us"> <a class="dropdown-item update1" id="update" data-toggle="modal" data-target="#add_form" >Edit</a> <a class="dropdown-item delete" id="delete">Delete</a> </div>'
            			},
            			{
            				"targets" : [0],
            				"visible" : false,
            				"searchable" : false
            			}
            	],
            	"order" : [ [ 0, "desc" ] ],
            });

	$('#sample tbody').on( 'click', '#update', function () { 
		var  data = table.row($(this).parents('tr')).data();
		// console.log(data);

		$('[name = "id"]').val(data["employee_id"]);
		$('[name = "username"]').val(data["user_name"]);
		$('[name = "password"]').val(data["password"]);
		$('[name = "empname"]').val(data["employee_name"]);
		$('[name = "email"]').val(data["email"]);
		$('[name = "mobile_number"]').val(data["mobile_number"]);
	});
	
	$('#sample tbody').on( 'click', '#delete', function () { 
		  var  data = table.row($(this).parents('tr')).data();
		  // alert(data['user_id']);
		  console.log(data);
		  if(confirm("Are you sure.?")){
		  		$.ajax({
            		type:"POST",
            		url: "controller.php",
            		data:{'action':'deleteEmployee','id':data["employee_id"]},
            		dataType : "JSON",
            		success:function reload(ret){
            		  	let data = JSON.parse(ret);
            		  	console.log(data);
        			  	if (data) {
        					
        					iziToast.success({
        			    	    title: 'Success',
        			    	    message: 'Question can be deleted!!!',
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
            		}
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

//set image source from 
//remove image source
function remo(){
	$("#user_image").val("");
	$('#view').attr("src","");
}


getdata();
function getdata() {
	$.ajax({
		url:'controller.php',
		method:'POST',
		data: {'action':'getRole'},
		success:function(ret){

			var data = JSON.parse(ret);
			$('#role_id').html('');
  			
  			var optionf = $('<option/>');
			optionf.attr('value',"").text("select Role");
			$('#role_id').append(optionf);
  			
			var obj=data.data;
			$(obj).each(function()
			{
				var option = $('<option />');
				option.attr('value', this.role_id).text(this.role_name);           
				$('#role_id').append(option);
         	});
		}
	});
}

function res(){
	$('#employee_form')[0].reset();
	$('#view').attr('src','');
	$('#add_form').modal('hide');
}


function save(){
	var username = $('[name = "username"]');
	var password = $('[name = "password"]');
	var empname = $('[name = "empname"]');
	var emp_email = $('[name = "email"]');
	var mobile_number = $('[name = "mobile_number"]');
	var role_id = $('[name = "role"]');
	var profile = $('[name = "profile"]');
	
	// alert(mobile.val());

	if(empty_data(username,"User name")){
		if(empty_data(username,"User name")){
			if(password_length(password,8)){
				if(empty_data(empname,"employee name")){
					if(empty_data(emp_email,"email")){
						if(email(emp_email)){
							if(empty_data(mobile_number,"mobile number")){
								if(check_mobile(mobile_number)){
									if(empty_data(role_id,"Role")){
										if(empty_data(profile,"profile")){
											if(check_image_file(profile,"image",400)){

											}else{ return false; }
										}else{ return false; }
									}else{ return false; }
								}else{ return false; }
							}else{ return false; }
						}else{ return false; }
					}else{ return false; }
				}else{ return false; }
			}else{ return false; }	
		}else { return false; }
	}else{ return false; }

	// return false;
	
	$('#submit').attr('disabled',true);	
	var form_data = new FormData();
	
	var file_data = $('#profile_image').prop('files')[0];
	var other_data = $('#employee_form').serializeArray();
	$.each(other_data , function(key ,input) {
		form_data.append(input.name , input.value);
		console.log(input.name+ " "+ input.value);
	});
	
	form_data.append('file',file_data);
	
	$.ajax({
		url : 'controller.php',
		method : 'POST',
		cache : false,
		contentType : false,
		processData : false,
		data : form_data,
		dataType : "JSON", 
		success : function(res){
			var data = JSON.parse(res);
			console.log(data);
			if (data){
				iziToast.success({
		    	    title: 'Success',
		    	    message: 'record can be inserted!!!',
		    	    position: 'topRight'
		    	  });
				$('#submit').attr('disabled',false);
				table.ajax.reload();
				$('#employee_form')[0].reset();
				$('#employee_id').val(0);
				$('#view').attr('src','');
				$('#add_form').modal('hide');
			}else{
				iziToast.error({
		    	    title: 'Error',
		    	    message: 'record cannot inserted!!!',
		    	    position: 'topRight'
		    	  });
				$('#employee_form')[0].reset();
				$('#employee_id').val(0);
				$('#view').attr('src','');
				$('#add_form').modal('hide');
			}
		}
	});
}

