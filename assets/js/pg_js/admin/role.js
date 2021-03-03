var table='';

window.onload=function()
{
	table =$('#sample').DataTable({
		  dom: 'Bfrtip',
		  buttons: [
		    'copy', 'excel', 'csv', 'pdf', 'print'
		  ], ajax : "controller.php?action=getRole",
            	columns : [ {
            		"data" : "role_id"
            	},{
            		"data" : "role_name"
            	},{
            		"data" : " "
            	} ],
            	columnDefs : [
            			{
            				"targets" : -1,
            				"data" : null,
            				"defaultContent" :'<div class="dropdown"> <button class="btn btn-primary dropdown-toggle" type="button" id="about-us" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Action </button> <div class="dropdown-menu" aria-labelledby="about-us"> <a class="dropdown-item update1" id="update" data-toggle="modal" data-target="#add_form" >Edit</a> <a class="dropdown-item delete1" id="delete">Delete</a> </div>'
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
		$('[name = "id"]').val(data["role_id"]);
		$('[name = "role_name"]').val(data["role_name"]);
	});
	
	$('#sample tbody').on( 'click', '#delete', function () { 
	  	var  data = table.row($(this).parents('tr')).data();
	  	// alert(data['user_id']);
	  	console.log(data);
	  	if(confirm("Are you sure.?")){
	  		$.ajax({
        		type:"POST",
        		url: "controller.php",
        		data:{'action':'deleteRole','id':data["role_id"]},
        		dataType : "JSON",
        		success:function reload(ret){
        		  	let data = JSON.parse(ret);
        		  	console.log(data);
    			  	if (data) {
    					iziToast.success({
    			    	    title: 'Success',
    			    	    message: 'Role can be deleted!!!',
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
	    	    message: 'record cannot deleted!!!',
	    	    position: 'topRight'
	    	});
		  }
	});	
	
}
function res(){
	$('#role_id').val(0);
	$('#role_form')[0].reset();
	$('#add_form').modal('hide');
}


function save(){
	
	
	var role_name=$('[name = "role_name"]');
	
	if(empty_data(role_name,"Role name")){
		if(allLetter(role_name,"role name")){
		}else{ return false; }
	}else{ return false; }
	
	$('#add').attr('disabled',true);
	$.ajax({
		url : 'controller.php',
		method : 'POST',
		data : $('#role_form').serialize(),
		success : function(ret){
			var data = JSON.parse(ret);
			if (data){
				
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