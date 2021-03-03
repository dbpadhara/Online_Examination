//$('#loginform').submit(function(){
//	check();
//});

function check(){
	
	var username=$('[name="username"]').val();
	var password=$('[name="password"]').val();
	
	if(username!=""){
		if(password!=""){
			
		}else{ 
			$('#pass').html('Enter Password').addClass('text-danger ');
			$('[name="password"]').focus();
			return false; 
		}
	}else{ 
		$('#uname').html('Enter Username').addClass('text-danger');
		$('[name="username"]').focus();
		return false; 
		}
	
	$('#save').attr('disabled',true);
	$.ajax({
		url : 'controller.php',
		method : 'POST',
		data : $('#loginform').serialize(),
		success : function(ret){
			$('#save').attr('disabled',false);
			var data = JSON.parse(ret);
			// console.log(data.status);
			// console.log(data);
			if (data.username=="true") {
				// console.log(data.username);
				$('#uname').html('Username is valid').addClass('text-green');
				if(data.password=="true"){
					// console.log(data.password);
					$('#pass').html('Password is success').addClass('text-green');
					if(data.status=="true"){
						// console.log(data.status);
						$('#status').html('welcome to online Examination').addClass('text-green');
						window.location.href="./index.php";
					}else{
						$('#status').html('your account can be blocked called to admin').addClass('text-danger');	
					}
				}else{
					$('#pass').html('Password is invalid').addClass('text-danger');
					$('[name="password"]').focus();
				}
			}else{
				$('#uname').html('Username is invalid').addClass('text-danger');
				$('[name="username"]').focus();
			}
		}
	});
}