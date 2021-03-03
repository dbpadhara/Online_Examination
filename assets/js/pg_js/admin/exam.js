var table='';

window.onload=function()
{
	table = $('#sample').DataTable({
		  dom: 'Bfrtip',
		  buttons: [
		    'copy', 'excel', 'csv', 'pdf', 'print'
		  ], ajax : "controller.php?action=getExam",
           	columns : [ {
           		"data" : "exam_id"
           	},{
           		"data" : "exam_title"
           	},{
           		"data" : "semester"
           	},{
           		"data" : "field_id"
           	},{
           		"data" : "total_question"
           	},{
           		"render" : function(data,type,JsonResultRow,meta){	
 	            			if(JsonResultRow.bifercation==0){
	            				return '<button type="button" id="bifferstatus" class="btn btn-primary">Add Question</button>';
	            			}else{
	            				return '<button type="button" id="bifferstatus" class="btn btn-primary">Add Question</button>';
	            			}
            		}
           	},
           	// {
           	// 	"render" : function(data,type,JsonResultRow,meta){	
 	          //   			if(JsonResultRow.question_file==null | JsonResultRow.question_file==""){
	           //  				return '<button type="button" id="addFile" class="btn btn-success">add File</button>';
	           //  			}else{
	           //  				return '<button type="button" id="addFile" class="btn btn-warning">FileName</button>';
	           //  			}
            // 		}
           	// },
           	{
           		"data" : "exam_date"
           	},{
           		"render" : function(data,type,JsonResultRow,meta){	
 	            			if(JsonResultRow.status==0){
	            				return '<button type="button" id="status" class="btn btn-danger">Block</button>';
	            			}else{
	            				return '<button type="button" id="status" class="btn btn-success">Active</button>';
	            			}
            		}
           	},{
           		"data" : " "
           	} ],
           	columnDefs : [
           			{
           				"targets" : -1,
           				"data" : null,
           				"defaultContent" :'<div class="dropdown"> <button class="btn btn-primary dropdown-toggle" type="button" id="about-us" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Action </button> <div class="dropdown-menu" aria-labelledby="about-us"><a class="dropdown-item" id="add_excel_file">Add Excel file</a> <a class="dropdown-item" id="update" data-toggle="modal" data-target="#add_form" >Edit</a> <a class="dropdown-item" id="delete">Delete</a> </div>'
           			},
           			{
           				"targets" : [0],
           				"visible" : false,
           				"searchable" : false
           			}
           	],
           	"order" : [ [ 0, "desc" ] ],
           });

	//update exam data
	$('#sample tbody').on( 'click', '#update', function () { 
		
		var  data = table.row($(this).parents('tr')).data();
		$('[name = "id"]').val(data["exam_id"]);
		$('[name = "exam_title"]').val(data["exam_title"]);
		$('[name = "semester"]').val(data["semester"]);
		$('[name = "field"]').val(data["field_id"]);
		$('[name = "total_question"]').val(data["total_question"]);
		$('[name = "exam_date"]').val(data["exam_date"]);
	});

	//update exam status for exam can be yet or not
	$('#sample tbody').on('click','#status',function(){

		var data = table.row($(this).parents('tr')).data();
		let id=data['exam_id'];
		let status=data['status'];
		// alert(id+" "+status);

			$.ajax({
			url : 'controller.php',
			method : 'POST',
			data : {"action":"updateExamStatus","id":id, "status":status},
			success : function(ret){
					let data=JSON.parse(ret);
					// console.log("update exam status"+data);
						if (data) {
							
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
		});//click event finished

	// bifurcate the question
	$('#sample tbody').on( 'click', '#bifferstatus', function () { 
		
		let data = table.row($(this).parents('tr')).data();

		// console.log(data);
		let exam_id = data["exam_id"];
		let tot_question = data["total_question"];

		
		$('input[name = "exam_id"]').val(exam_id);		
		$('input[name = "tot_question"]').val(tot_question);
		$('input[name = "read_title"]').val(data["exam_title"]);

		$('#read_total_question').val(tot_question);

		//check and update
		show1();

		//show the question table
		get_question(exam_id);

		//get and check the biffer status and question
		get_question_count(tot_question,exam_id);
	});
	

	$('#sample tbody').on('click','#add_excel_file',function(){
		var data = table.row($(this).parents('tr')).data();
		console.log(data);
		var id=data['exam_id']; 

		$.ajax({
			url : 'controller.php',
			method : 'POST',
			data : { 'action':'setSession','variable' : 'examid', 'value' : id},
			success : function(ret){
				var data = JSON.parse(ret);
				if(data=="true"){

					window.location.href="./upload_question_excel.php";
				}
			}
		});
		// window.location.href="./upload_question_excel.php?exam_id="+id+"&tot_question="+data['total_question'];

		// $('[name = "excel_exam_id"]').val(data['exam_id']);
		// $('#read_Excel').modal('show');
	});

	//delete exam data
	$('#sample tbody').on( 'click', '#delete', function () { 
		  var  data = table.row($(this).parents('tr')).data();
		  console.log(data);
		  if(confirm("Are you sure.?")){
		  		$.ajax({
	            		type:"POST",
    		  			url: "controller.php",
            		  	data:{'action':'deleteExam','id':data["exam_id"]},
            		  	dataType : "JSON",
            		  	success:function reload(ret){
            		  	let data = JSON.parse(ret);
            			  	if (data) {
            					iziToast.success({
            			    	    title: 'Success',
            			    	    message: 'record can be deleted!!!',
            			    	    position: 'topRight'
            			    	  });
            					table.ajax.reload();
            				}else{
            					iziToast.error({
            			    	    title: 'error',
            			    	    message: 'exam cannot deleted!!!',
            			    	    position: 'topRight'
            			    	  });
            				} 
            		  }
	        		});
		  }else{
		  	iziToast.warning({
	    	    title: 'warning',
	    	    message: 'Exam cannot deleted!!!',
	    	    position: 'topRight'
	    	  });
		  }
	});	
}






function save(){

	var exam_title = $('[name = "exam_title"]');
	var semester = $('[name = "semester"]');
	var field = $('[name = "field"]');
	var total_question = $('[name = "total_question"]');
	var exam_date = $('[name = "exam_date"]');

	if(empty_data(exam_title,'exam title')){
		if(empty_data(semester,'semester')){
			if(empty_data(field,'field')){
				if(empty_data(total_question,'total question')){
					if(check_num_length(total_question,100)){
						if(empty_data(exam_date,'exam date')){
							if(date_less_current(exam_date)){
								// alert(exam_date.val());
							}else{ return false; }
						}else{ return false; }	
					}else{ return false; }
				}else{ return false; }
			}else{ return false; }
		}else{ return false; }
	}else{ return false; }

	$('#add').attr('disabled',true);
	$.ajax({
		url : 'controller.php',
		method : 'POST',
		data : $('#exam_form').serialize(),
		success : function(ret){
			let data=JSON.parse(ret);
				console.log(data);
			
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

function check_addRow(){
	let data=document.getElementsByClassName('question').length;
	
	let remain = $('input[name = "remaining_question"]').val();
	// console.log("question"+data);
	

	// alert("row"+data+"remain"+remain);
	if(data == remain | data > remain){
		$('#add_row_button').attr('disabled',true);
	}else{
		$('#add_row_button').attr('disabled',false);
	}	
}

var count = 1;
var arr=[];
function addRow(){

	var row = document.getElementById("add_row"); 
	var html = [
				'<td>',
					'<label>'+count+'</label>',
				'</td>',
				'<td class="col-sm-2">',
					'<textarea type="text" class="form-control question" cols=4 rows=2 name="question[]" id="question'+count+'" placeholder="enter Question"></textarea>',
				'</td>',
				'<td class="col-sm-2">',
					'<input type="text" class="form-control"  name="option1[]" id="option1'+count+'" placeholder="enter option1">',
				'</td>',
				'<td class="col-sm-2">',
					'<input type="text" class="form-control"  name="option2[]" id="option2'+count+'" placeholder="enter option2">',
				'</td>',
				'<td class="col-sm-2">',
					'<input type="text" class="form-control"  name="option3[]" id="option3'+count+'" placeholder="enter option3">',
				'</td>',
				'<td class="col-sm-2">',
					'<input type="text" class="form-control"  name="option4[]" id="option4'+count+'" placeholder="enter option4">',
				'</td>',
				'<td class="col-sm-2">',
					'<input type="text" class="form-control"  name="answer[]" id="answer'+count+'" placeholder="enter answer">',
				'</td>',
				'<td>',
					'<button type="button" class="btn btn-danger" onclick="deleteRow(',count,')">delete</button>',
				'</td>'
				].join('');
	var tr = document.createElement("tr");
	tr.innerHTML = html;
	tr.id = "rowId" + count;
	arr.push(count);
	count++;
	row.append(tr);
	check_addRow();
}

function deleteRow(id){
	let rowId = document.getElementById("add_row");
	var id = document.getElementById("rowId"+id);
	// console.log(id);
	// console.log(arr);
	// for(var i=0;i<arr.length;i++){
	// 	if(arr[i]==id){
	// 		arr[i]=0;
	// 	}
	// }
	// console.log(arr);
	rowId.removeChild(id);
	check_addRow();
}


function save1(){

	var tbody=$('#add_row');

	if (tbody.children().length == 0) {
		iziToast.error({
		    title: 'Add row!',
		    message: 'please click on add row button',
		    position: 'topRight',
		});
		$('#ad_row_btn').html('Click the add row button').addClass("text-danger");
		return false;
	}

	if($('#ad_row_btn').html()!=""){
		$('#ad_row_btn').html('');
	}

	// var arr_length = $('[name = "question[]"]').length;

	// alert(arr_length);

	// arr.forEach(element => console.log(element));		



	$('#add').attr('disabled',true);
	$.ajax({
		url : 'controller.php',
		method : 'POST',
		data : $('#question_form').serialize(),
		success : function(ret){
			let data=JSON.parse(ret);
				console.log(data);
			
			if (data) {				
				iziToast.success({
		    	    title: 'Success',
		    	    message: 'record can be inserted!!!',
		    	    position: 'topRight'
		    	  });
				$('#add').attr('disabled',false);
				$('#add_question').modal('hide');
				// table.ajax.reload();
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

var table1='';
function get_question(exam_id){
	$('#sample1').dataTable().fnDestroy();
	table1=$('#sample1').DataTable({
		  dom: 'Bfrtip',
		  buttons: [
		    'copy', 'excel', 'csv', 'pdf', 'print'
		  ], ajax : {
		  	url : "controller.php?action=getQuestion&exam_id="+exam_id+"",
		  	method : "GET",
		  	// dataSrc:console.log(dataSrc)
		  },
           	columns : [{
           		"data" : "question_id"
           	},{
           		"data" : "question"
           	},{
           		"data" : "option1"
           	},{
           		"data" : "option2"
           	},{
           		"data" : "option3"
           	},{
           		"data" : "option4"
           	},{
           		"data" : "answer"
           	},{
           		"data" : "exam_id"
           	},{
           		"data" : " "
           	} ],
           	columnDefs : [
           			{
           				"targets" : -1,
           				"data" : null,
           				"defaultContent" :'<div class="dropdown"> <button class="btn btn-primary dropdown-toggle" type="button" id="about-us" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Action </button> <div class="dropdown-menu" aria-labelledby="about-us"> <a class="dropdown-item" id="update1">Edit</a> <a class="dropdown-item delete1" id="delete1">Delete</a> </div>'
           			},
           			{
           				"targets" : [0],
           				"visible" : false,
           				"searchable" : false
           			}
           	],
           	"order" : [ [ 0, "desc" ] ],
           });

	$('#sample1 tbody').on('click','#update1',function(){
		var data = table1.row($(this).parents('tr')).data();
		console.log(data);
		
		$('#add_question').modal('hide');
		$('#update_question').modal('show');

		$('#update_exam_id').val(data['exam_id']);
		$('#update_question_id').val(data['question_id']);
		$('[name = "question"]').val(data['question']);
		$('[name = "option1"]').val(data['option1']);
		$('[name = "option2"]').val(data['option2']);
		$('[name = "option3"]').val(data['option3']);
		$('[name = "option4"]').val(data['option4']);
		$('[name = "answer"]').val(data['answer']);
		
	});

	//delete question
	$('#sample1 tbody').on( 'click', '#delete1', function () { 
		  var  data = table1.row($(this).parents('tr')).data();
		  // alert(data['user_id']);
		  console.log(data);
		  if(confirm("Are you sure.?")){
		  		$.ajax({
            		type:"POST",
            		url: "controller.php",
            		data:{'action':'deleteQuestion','id':data["question_id"]},
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
        					table1.ajax.reload();
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

function save2(){

	$('#add2').attr('disabled',true);
	$.ajax({
		url : 'controller.php',
		method : 'POST',
		data : $('#update_question_form').serialize(),
		success : function(ret){
			let data=JSON.parse(ret);
				console.log(data);
			
			if (data) {				
				iziToast.success({
		    	    title: 'Success',
		    	    message: 'record can be updated!!!',
		    	    position: 'topRight'
		    	  });
				$('#add2').attr('disabled',false);
				table1.ajax.reload();
				$('#add_question').modal('show');
				res2();
			}else{
				iziToast.error({
		    	    title: 'error',
		    	    message: 'record cannot updated!!!',
		    	    position: 'topRight'
		    	  });
				res();
			}
		}
	});
}



function get_question_count(tot_question,exam_id){
	$.ajax({
		url : 'controller.php',
		method : 'POST',
		data : {'action':'questionCount','exam_id':exam_id},
		success : function(ret){
			let data=JSON.parse(ret);
				console.log("question count:"+data);
			
			if(data == tot_question){
				$("#add_row_button").attr('disabled',true);
				$("#save_question").attr('disabled',true);
				$('[name = "remaining_question"]').val(0);
				//change the status of bifercation
				// $.ajax({
				// 	url:'controller.php',
				// 	method:'POST',
				// 	data:{'action':'bifferStatus','exam_id':exam_id,'status':data['bifercation']},
				// 	success:function(ret){
				// 		var data=JSON.parse(ret);
				// 		console.log("bifferstatus"+data);
				// 	}
				// });
			}else if(data < tot_question){
				let remaining_question = tot_question - data;	
			$('[name = "remaining_question"]').val(remaining_question);
			}
			else{

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


function res(){
	$('#add_form').modal('hide');
	$('#exam_id').val(0);
	$('#exam_form')[0].reset();
}

function res1(){
	$('#add_question').modal('hide');
	$('#question_id').val(0);
	$('#question_form')[0].reset();
	$('input[name = "exam_id"]').val('');		
	$('input[name = "tot_question"]').val('');
	$('input[name = "read_title"]').val('');
	count=1;
	arr=[];
	$('#read_total_question').val('');
}

function res2(){
	$('#update_question_form')[0].reset();
	$('#update_question').modal('hide');
	$('#add_question').modal('show');
}

function show(){
	$('#add_form').modal('show');
	$('[name="exam_title"]').focus();
}

function show1(){
	$('#add_row').html('');
	$('#add_row_button').attr('disabled',false);
	$('#add_question').modal('show');
}