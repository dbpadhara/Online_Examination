// function can return total question and number of question inserted 
window.onload = function(){
	getQuestionCount();
}

function getQuestionCount(){

	$.ajax({
		url:'controller.php',
		method:'POST',
		data:{'action':'getTotQuestion','exam_id':$('#examid').val()},
		success:function(ret){										
			var data = JSON.parse(ret);
			// console.log(data.data);
			var obj = data.data;
			if(data!=""){
				$('[name = "exam_title"]').val(obj["exam_title"]);
				$('[name = "total_question"]').val(obj["total_question"]);
				var remaining = obj["total_question"]-obj['question'];
				$('[name = "remaining"]').val(remaining);
			}else{

			}
		}
	});
}

function saveExcel() {
	var file = $('[name = "question_file"]');

	if(empty_data(file,'Excel file')){
		if(check_image_file(file,"excel",1000)){

		}else { return false; }
	}else{ return false; }

	var form_data = new FormData();
	
	var file_data = $('#question_file').prop('files')[0];
	var other_data = $('#excel_form').serializeArray();
	$.each(other_data , function(key ,input) {
		form_data.append(input.name , input.value);
		console.log(input.name ,":", input.value);
	});

	console.log(file_data);
	form_data.append('file',file_data);

	// var file = $('#question_file').prop('files')[0];
	// console.log(file);
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
			if (data.flag=="true") {
				
				console.log(data.File_name);
				// alert(data.file_name);
				$('[name = "path"]').val(data.File_name);

				$('#read_file_btn').attr('disabled',false);
				iziToast.success({
		    	    title: 'Success',
		    	    message: 'file can be inserted!!!',
		    	    position: 'topRight'
		    	  });
				
				// table.ajax.reload();
				res();
			}else{
				iziToast.error({
		    	    title: 'error',
		    	    message: 'file cannot inserted!!!',
		    	    position: 'topRight'
		    	  });
				res();
			}
		}
	});
}


function read_excel(){
	var path = $('[name = "path"]').val();
	// alert(path);
	$('#read_file_btn').attr('disabled',true);	
	$.ajax({
		url:"controller.php",
		method:"POST",
		data:{"action" : "readExcelFile","file_path":path},
		success:function(ret){
			var data = JSON.parse(ret);
			// console.log(data.data);
			var i=1;
			$('#submit_question').attr('disabled',false);

			var limit = $('[name = "remaining"]').val();

			var obj =data.data;
			$(obj).each(function(){
				if(i<=limit){
					// console.log("question :"+this[1]+" option1:"+this[2]);
					addRow(this[1],this[2],this[3],this[4],this[5],this[6]);
				}
				break;
				i++;//use for the number of question add
			});
			// console.log(data.data[0][0]);
		}
	});
}


var count = 1;
function addRow(question,option1,option2,option3,option4,answer){

	var row = document.getElementById("add_row"); 
	var html = [
				'<td>',
					'<label>'+count+'</label>',
				'</td>',
				'<td class="col-sm-2">',
					'<textarea type="text" readonly="readonly" class="form-control question" cols=4 rows=2 name="question[]" id="question'+count+'">'+question+'</textarea>',
				'</td>',
				'<td class="col-sm-2">',
					'<input type="text" class="form-control"  name="option1[]" readonly="readonly" value="'+option1+'">',
				'</td>',
				'<td class="col-sm-2">',
					'<input type="text" class="form-control"  name="option2[]" readonly="readonly" value="'+option2+'">',
				'</td>',
				'<td class="col-sm-2">',
					'<input type="text" class="form-control"  name="option3[]" readonly="readonly" value="'+option3+'">',
				'</td>',
				'<td class="col-sm-2">',
					'<input type="text" class="form-control"  name="option4[]" readonly="readonly" value="'+option4+'">',
				'</td>',
				'<td class="col-sm-2">',
					'<input type="text" class="form-control"  name="answer[]" readonly="readonly" value="'+answer+'">',
				'</td>',
				'<td>',
					'<button type="button" class="btn btn-danger" onclick="deleteRow(',count,')">delete</button>',
				'</td>'
				].join('');
	var tr = document.createElement("tr");
	tr.innerHTML = html;
	tr.id = "rowId" + count;
	count++;
	row.append(tr);
}


function save(){

	$('#submit_question').attr('disabled',true);
	$.ajax({
		url : 'controller.php',
		method : 'POST',
		data : $('#question_form').serialize(),
		success : function(ret){
			let data=JSON.parse(ret);
				console.log(data);
			
			if (data=="true") {

				iziToast.success({
		    	    title: 'Success',
		    	    message: 'record can be inserted!!!',
		    	    position: 'topRight'
		    	  });
				$('#submit_question').attr('disabled',false);
				
				$('#add_row').html('');
				// getQuestionCount();
				window.location.href="";
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

//set image source from 
//remove image source

function remo(){
	$("#question_file").val("");
}


function res() {
	$('#excel_form')[0].reset();
	$('[name = "examid"]').val(0);
}