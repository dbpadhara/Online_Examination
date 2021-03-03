window.onload=function(){
	var user_id=$('[name = "user_id"]').val();
	var exam_id=$('[name = "exam_id"]').val();
	$.ajax({
		url:"controller.php",
		method:"post",
		data:{'action':'updateUserExamStatus','exam_id':exam_id,'user_id':user_id},
		success:function(ret){
			var data = JSON.parse(ret);
			console.log(data);
			// alert(data);
			var obj = data.data;

			$(obj).each(function(){
				console.log("correct answer:"+this['correct_answer']);
				console.log("wrong answer:"+this['wrong_answer']);
				console.log("total question:"+this['total_question']);
				$('[name = "correct_answer"]').val(this['correct_answer']);
				$('[name = "wrong_answer"]').val(this['wrong_answer']);
				$('[name = "total_question"]').val(this['total_question']);
			});
			// console.log(obj);
			// console.log(data['correct_answer']);			
		}
	})
}