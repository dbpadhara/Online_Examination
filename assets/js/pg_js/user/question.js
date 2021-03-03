window.onload=function(){
	// alert("hello");
	// $.ajax({
	// 	url : 'controller.php',
	// 	method : 'POST',
	// 	data : {'action':'getQuestion','exam_id':$('[name = "exam_id"]').val()},
	// 	success : function(res){
	// 		let data=JSON.parse(res);
	// 		console.log(data.data.length);

	// 		var obj = data.data;
	// 		$(obj).each(function(){
	// 			add_question(this.question_id,this.question,this.option1,this.option2,this.option3,this.option4)	
	// 		});
	// 	}
	// });
}

var number=1;
function add_question(question_id,question,option1,option2,option3,option4){
	console.log(question_id+question+option1+option2+option3+option4);
	var row=document.getElementById("add_question");
	var html=['<div class="form-group" style="font-size: 20px">',
					'<input type="hidden" name="question'+number+'" value='+question_id+'>',
					'<div>',
							'<p class="form-control-plain-text"> '+number+'. '+question+'</p>',
					'</div>',
						
					'<div class="form-check">',
						'<label class="form-check-label">',
							'<input type="radio" class="form-check-input" id="answer'+number+'" name="answer'+number+'" value="'+option1+'" >',
							''+option1+'',
						'</label>',
					'</div>',
					'<div class="form-check">',
						'<label class="form-check-label">',
							'<input type="radio" class="form-check-input" name="answer'+number+'" value="'+option2+'">',
							''+option2+'',
						'</label>',
					'</div>',
					'<div class="form-check">',
						'<label class="form-check-label">',
							'<input type="radio" class="form-check-input" name="answer'+number+'" value="'+option3+'">',
							''+option3+'',
						'</label>',
					'</div>',
					'<div class="form-check">',
						'<label class="form-check-label">',
							'<input type="radio" class="form-check-input" name="answer'+number+'" value="'+option4+'">',
							''+option4+'',
						'</label>',
					'</div>',

					'<span id="question'+number+'"></span>',	
				'</div>'].join('');
	let div = document.createElement("div");
	div.innerHTML = html;
	row.append(div);
	number++;
}

function save(){

	$('#submit').attr('disabled',true);
	let tot_question = $('#tot_question').val();

	for(let i = 1;i <= tot_question; i++){

		let answer = $('[name = "answer'+i+'"]:checked');
		// console.log(answer.length);
		if(answer.length==0){
			$('#question'+i).html("please select the Question "+i+" Answer").addClass('text-danger');
			// $('#answer'+i).focus();
			$('input[type="answer'+i+'"]:first').focus();
			$('#submit').attr('disabled',false);
			iziToast.warning({
				title : 'select answer',
				message : 'select Question for answer:'+i+'',
				position : 'topRight'
			});
			// alert("select Question of "+i+" Answer");
			return false;
		}else{
			$('#question'+i).html('');
		}
	}

	// alert("total question"+tot_question);

	$.ajax({
		url : 'controller.php',
		method : 'POST',
		data : $('#question_form').serialize(),
		success : function(ret){

			let data=JSON.parse(ret);
				console.log(data);

			if (data.status=="true") {				
				iziToast.success({
		    	    title: 'Success',
		    	    message: 'your exam can be completed!!!',
		    	    position: 'topRight'
		    	  });
				$('#submit').attr('disabled',false);
				window.location.href = "result.php";
				// logout();
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

function res(){
	$('#question_form')[0].reset();
}