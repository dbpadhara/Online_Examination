function check_email({

});

function save(){
	
	var mobile=$('[name="mobile_number"]').val();
//	alert(mobile);
	$.ajax({
		url : 'forget_pass.erp',
		method : 'POST',
		data : {"mobile_number":mobile},
		success : function(ret){
			if (ret.input) {
				/*swal("Good", "Success Fully", "success");*/
				$('#data').html("mobile_number found").addClass("text-success");
				window.location.href="otp.erp?mobile="+mobile;
				return true;
			}else{
				$('#data').html("mobile_number not found pl enter correct number").addClass("text-danger");
			}
		}
	});
}