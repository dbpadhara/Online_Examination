window.onload=function(){

	$.ajax({
		url:"controller.php",
		method:"POST",
		data:{"action":"getProfile","id":$('[name="emp_id"]').val()},
		success:function(ret){
			var data = JSON.parse(ret);
			// console.log(data);
			console.log(data['user_image']);
			$('[name = "email"]').val(data['email']);
			$('[name = "mobile_number"]').val(data['mobile_number']);
			$('[name = "user_name"]').val(data['user_name']);
			$('[name = "employee_name"]').val(data['employee_name']);
			$('[name = "role"]').val(data['role_name']);
			$('[name = "password"]').val(data['password']);
			$('#user_image').attr("src","../assets/uploads/employee/"+data['user_image']);
		}
	})
	$('#add').hide();
}

function edit(){
	$('input[type="text"]').attr('readonly',false);
	// $('#add').show();
}

function save(){
	// $.ajax({
	// 	url:"controller.php",
	// 	method:"POST",
	// 	data:{"ac"}
	// });
}