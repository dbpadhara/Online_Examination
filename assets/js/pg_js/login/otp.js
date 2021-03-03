var otpvalue;

setTimeout(function(){
	otpvalue=$('#otpvalue').val();
	$('#otpvalue').remove();
},500);


function save(){
	
	var mobile=$('#partitioned').val();
	console.log(otpvalue);
	if (mobile == otpvalue) {
		iziToast.success({
			  title: 'Success !',
			  message: 'Good job !',
			  position: 'topRight'
			});
	}
	//alert(mobile);
	$.ajax({
		url : 'forget_pass.db',
		method : 'POST',
		data : {"mobile_number":mobile},
		success : function(ret){
			if (ret.input) {
				/*swal("Good", "Success Fully", "success");*/
				$('#data').html("mobile_number found").addClass("text-success");
				window.location.href="otp.db";
			}else{
				$('#data').html("OTP is WRONG").addClass("text-danger");
				window.location.href="confirm_pass.db";
			}
		}
	});
}