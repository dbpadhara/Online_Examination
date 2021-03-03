
function save(){
	
	var pass=$('#pass').val();
	var confirm_pass=$('#cpass').val();
	
	if(pass==""){
		$('#password').html('required').addClass('text-danger');
		$('#pass').focus();
		return false;
	}
	if(pass!=""){
		$('#password').html('');
	}
	if(confirm_pass==""){
		$('#cpassword').html('required').addClass('text-danger');
		$('#cpass').focus();
		return false;
	}
	if(confirm_pass!=""){
		$('#cpassword').html('');
	}
	if(pass!=confirm_pass){
		$('#cpassword').html('enter the same password').addClass('text-danger');
		$('#cpass').focus();
		return false;
	}
	
	//alert(mobile);
	$.ajax({
		url : 'confirm_pass.db',
		method : 'POST',
		data : {"pass":pass},
		success : function(ret){
			if (ret.input) {
				/*swal("Good", "Success Fully", "success");*/
				$('#data').html("mobile_number found").addClass("text-success");
				window.location.href="login.db";
			}else{
				$('#data').html("OTP is WRONG").addClass("text-danger");
				return false;
//				window.location.href="login.db";
			}
		}
	});
}