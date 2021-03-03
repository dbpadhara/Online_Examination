var table='';

window.onload=function()
{
	table =$('#sample').DataTable({
		  dom: 'Bfrtip',
		  buttons: [
		    'copy', 'excel', 'csv', 'pdf', 'print'
		  ], ajax : "controller.php?action=getField",
           	columns : [ {
           		"data" : "field_id"
           	},{
           		"data" : "field_name"
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
		$('[name = "id"]').val(data["field_id"]);
		$('[name = "field_name"]').val(data["field_name"]);
	});
	
	$('#sample tbody').on( 'click', '#delete', function () { 
		  var  data = table.row($(this).parents('tr')).data();
		  // alert(data['user_id']);
		  if(confirm("Are you sure.?")){
		  		$.ajax({
	            		type:"POST",
	            		  url: "controller.php",
	            		  data:{'action':'deleteField','id':data["field_id"]},
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
	$('#add_form').modal('hide');
	$('#field_id').val(0);
	$('#field_form')[0].reset();
	
}

function show(){
	$('#add_form').modal('show');
	$('#field_id').val(0);
	$('[name="field"]').focus();
}


function save(){
	
	
	var field_name=$('[name = "field_name"]');
	
	if(empty_data(field_name,"field name")){
		if(allLetter(field_name,"field name")){
		}else{ return false; }
	}else{ return false; }
	
	$('#add').attr('disabled',true);
	$.ajax({
		url : 'controller.php',
		method : 'POST',
		data : $('#field_form').serialize(),
		success : function(ret){
			let data=JSON.parse(ret);
				console.log(ret);
			
			if (data) {				
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