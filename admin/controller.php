<?php
	include_once './config/dbConnection.php';
		
	include_once './XL_Reader_Class/SimpleXLSX.php';

	session_start();

	$req = $_REQUEST['action'];

	switch ($req) {

	 	case 'getUsers':
	 		
	 		// $json = array();
			// $table_name=$_GET["model"];
			$json=array();
			$qry="select * from user_registration where active_flag=0";

			$data="";
			if($result=mysqli_query($con,$qry)){

				if(mysqli_num_rows($result)>0){
					while ($row=mysqli_fetch_array($result)) {
					// $data+=$row;
						// echo $row;
						$json["data"][]=$row;
					}
				}
			}
			// $myjson = json_encode($json);
			echo json_encode($json);
	 		break;

	 	case 'updateStatus':
	 		$id = $_POST['id'];
	 		$status = $_POST['status'];

	 		if($status==0){
	 			$status=1;
	 		}else{
	 			$status=0;
	 		}

	 		$query="update user_registration set status=$status where user_id=$id";
	 		if(mysqli_query($con,$query)){
	 			echo json_encode("true");
	 		}else{
	 			echo json_encode("false");
	 		}
	 		break;

	 	case 'updateExamStatus':
	 		$id = $_POST['id'];
	 		$status = $_POST['status'];

	 		if($status==0){
	 			$status=1;
	 		}else{
	 			$status=0;
	 		}

	 		$query="update exam_master set status=$status where exam_id=$id";
	 		if(mysqli_query($con,$query)){
	 			echo json_encode("true");
	 		}else{
	 			echo json_encode("false");
	 		}
	 		break;

	 	case 'bifferStatus':
	 		
	 		$status = $_POST['status'];
	 		$exam_id = $_POST['exam_id'];
	 		if($status==0){
	 			$status=1;
	 		}else{
	 			$status=0;
	 		}

	 		$qry = "update exam_master set bifercation=$status where exam_id=$exam_id";
	 		if(mysqli_query($con,$qry)){
	 			echo json_encode("true");
	 		}else{
	 			echo json_encode("false");
	 		}
	 		break;	
	 		
	 	case 'addUser':
	 		$id = $_POST['id'];
			$username = $_POST['username'];
			$field_id = $_POST['field'];
			$semester = $_POST['semester'];
			$email = $_POST['email'];
			$password = $_POST['password'];			

			// echo $username;

			if ( 0 < $_FILES['file']['error'] ) {
		        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
		    }
		    else {
		    	 // echo $_FILES['file']['name'];
		        move_uploaded_file($_FILES['file']['tmp_name'],'../assets/uploads/'.$_FILES['file']['name']);
		    }

		    // $table_name="user_registration";
		    if($id == 0){ 

				$file_name=$_FILES['file']['name']; //get file name

				$query = "insert into user_registration(user_name,field_id,semester,email,password,profile_pic) values('$username',$field_id,$semester,'$email','$password','$file_name')";
				// echo $query;
						    	
		    }else{
		    	$file_name=$_FILES['file']['name']; //get file name
				$query = "update user_registration set user_name='$username',field_id=$field_id,semester=$semester,email='$email',password='$password',profile_pic='$file_name' where user_id=$id";
		    }

	    	if(mysqli_query($con,$query)){
				$data="true";
			}else{
				$data="false";
			}
		    
			echo json_encode($data);
	 		break;

	 	case 'deleteUser':
	 		$user_id = $_POST['id'];

	 		$qry = "update user_registration set active_flag=1 where user_id=$user_id";
	 		
	 		if(mysqli_query($con,$qry)){
	 			echo json_encode("true");
	 		}else{
	 			echo json_encode("false");
	 		}

	 		break;

	 	case 'getField':
			// $table_name=$_GET["model"];
			$json=array();

			$qry="select * from field where active_flag=0";
			// $qry="select COUNT(q.exam_id) as correct FROM question q,user_exam_answer uea WHERE q.answer=uea.answer AND q.exam_id=uea.exam_id";

			$data="";
			if($result=mysqli_query($con,$qry)){

				if(mysqli_num_rows($result)>0){
					// $row=mysqli_fetch_array($result);
					// echo json_encode($row);
					while ($row=mysqli_fetch_array($result)) {
					
						$json["data"][]=$row;
					}
				}
			}
			// $myjson = json_encode($json);
			echo json_encode($json);
	 			break;
	 				
	 	case 'addField':
	 		$field_id = $_POST['id'];
	 		$field_name = $_POST['field_name'];


	 		$created_by_id = $_SESSION['employee_id'];
	 		// $updated_by_id=1;

	 		if($field_id == 0){
	 			$qry = "insert into field(field_name,created_by_id) values('$field_name',$created_by_id)";
	 		}else{
	 			$qry = "update field set field_name='$field_name' where field_id=$field_id";
	 		}
	 		// echo $qry;
	 		if(mysqli_query($con,$qry))
	 		{
	 			echo json_encode("true");
	 		}else{
	 			echo json_encode("false");
	 		}
	 		break;	

	 	case 'deleteField':
	 		
	 		$field_id=$_POST['id'];

	 		$qry = "update field set active_flag=1 where field_id=$field_id";

	 		if(mysqli_query($con,$qry)){
	 			echo json_encode("true");
	 		}else{
	 			echo json_encode("false");
	 		}

	 		break;	

	 	case 'addExam':
	 		$exam_id = $_POST['id'];
	 		$exam_title = $_POST['exam_title'];
	 		$semester = $_POST['semester'];
	 		$field_id = $_POST['field'];
	 		$total_question = $_POST['total_question'];
	 		$exam_date = $_POST['exam_date'];
	 				// date("Y-m-d");
	 		// echo $exam_date;

	 		// $exam_date = date('YYYY-mm-DD',$date);
	 		// echo $formateddate;
	 		$created_by_id = $_SESSION['employee_id'];

	 		if($exam_id == 0){
	 			$qry = "insert into exam_master(exam_title,semester,field_id,total_question,exam_date,created_by_id) values('$exam_title',$semester,$field_id,$total_question,'$exam_date',$created_by_id)";
	 		}else{
	 			$qry = "update exam_master set exam_title='$exam_title',semester=$semester,field_id=$field_id,total_question=$total_question,exam_date='$exam_date' where exam_id=$exam_id";
	 		}
	 		if(mysqli_query($con,$qry)){
	 			echo json_encode("true");
	 		}else{
	 			echo json_encode("false");
	 		}

	 		break;	
	 	
	 	case 'getExam': 	
	 		$json=array();

			$qry="select * from exam_master where active_flag=0";
	 		
			// $json = getData("exam_master");
			
			// echo $json;

			// $data="";
			if($result=mysqli_query($con,$qry)){

				if(mysqli_num_rows($result)>0){
					while ($row=mysqli_fetch_array($result)) {
					// $data+=$row;
						// echo $row;
						$json["data"][]=$row;
					}
				}
			}
			// $myjson = json_encode($json);
			echo json_encode($json);
	 			break;	

	 	case 'deleteExam':

	 		$exam_id = $_POST['id'];

	 		$flag;
	 		$qry = "update question set active_flag=1 where exam_id=$exam_id";
	 		if(mysqli_query($con,$qry)){
	 			$qry1="update exam_master set active_flag=1 where exam_id=$exam_id";
	 			if(mysqli_query($con,$qry1)){
					$flag="true";	 				
	 			}else{
	 				$flag="false";
	 			}
	 		}else{
	 			$flag="false";
	 		}

	 		echo json_encode($flag);
	 		break;

	 	case 'getQuestion':

	 		$exam_id = $_GET['exam_id'];

	 		$json=array();

			$qry="select * from question where exam_id=$exam_id and active_flag=0";


			if($result=mysqli_query($con,$qry)){

				if(mysqli_num_rows($result)>0){
					while ($row=mysqli_fetch_array($result)) {
					// $data+=$row;
						// echo $row;
						$json["data"][]=$row;
					}
				}
				$josn["data"][]="";
			}
			// $myjson = json_encode($json);
			echo json_encode($json);
	 		break;

	 	case 'addQuestion':

	 		$json = array();

	 		$id = $_POST['id'];
	 		$exam_id = $_POST['exam_id'];
	 		$question = $_POST['question'];
	 		$option1 = $_POST['option1'];
	 		$option2 = $_POST['option2'];
	 		$option3 = $_POST['option3'];
	 		$option4 = $_POST['option4'];
	 		$answer = $_POST['answer'];

	 		$created_by_id = $_SESSION['employee_id'];
	 		$flag;
	 		for ($i=0; $i <	count($question) ; $i++) { 
	 			// echo  "Question: " $question[$i]; 
	 			// $json["data"][] =  $question[$i] . " option 1 ".$option1[$i]." option2 ".$option2[$i]." option3 ".$option3[$i]." option4 ".$option4[$i];
	 			$qry = "insert into question(question,option1,option2,option3,option4,answer,exam_id,created_by_id) values('$question[$i]','$option1[$i]','$option2[$i]','$option3[$i]','$option4[$i]','$answer[$i]',$exam_id,$created_by_id)";
	 			if(mysqli_query($con,$qry)){
	 				$flag="true";	
	 			}else{
	 				$flag="false";
	 			}
	 		}

	 		echo json_encode($flag);
	 			break;	

	 	case 'addExcel':

	 		$exam_id = $_POST['examid'];	

	 		if ( 0 < $_FILES['file']['error'] ) {
		        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
		        $file_name ="false";
		        $arr = array('flag' => "false", "file_name" => "false" );
		    }
		    else {
		    	$file_name=$_FILES['file']['name'];
		    	 // echo $_FILES['file']['name'];
		    	$flag="true";
		        move_uploaded_file($_FILES['file']['tmp_name'],'../assets/uploads/exam_file/'.$_FILES['file']['name']);
		    	$arr = array("flag" => $flag ,"File_name" =>"../assets/uploads/exam_file/".$file_name);
		    }

		    echo json_encode($arr);

	 		break;

	 	case 'readExcelFile':
	 		$path = $_POST['file_path'];	
	 		$i=0;
	 		// echo $path;
		    $json = array();
		    if($xlsx = SimpleXLSX::parse($path)){
		    	foreach ($xlsx->rows() as $exceldata) {
		    		if($i==0){

		    		}else{
		    			// echo "Question ".$exceldata[0]." option1 ".$exceldata[1]." option2 ".$exceldata[2]." option3 ".$exceldata[3]." option4 ".$exceldata[4]." answer".$exceldata[5];
		    			// $flag = "true";
		    			$json['data'][] = $exceldata;
		    		}
		    		$i++;	
		    	}
		    }

		    echo json_encode($json);
	 		break;	

	 	case 'setSession':
	 		$session_var = $_POST['variable'];
	 		$value = $_POST['value'];
	 		$_SESSION[$session_var]=$value;
	 		echo json_encode("true");
	 		break;

	 	case 'updateQuestion':
	 		$exam_id = $_POST['update_exam_id'];
	 		$question_id = $_POST['update_question_id'];
	 		$question = $_POST['question'];
	 		$option1 = $_POST['option1'];
	 		$option2 = $_POST['option2'];
	 		$option3 = $_POST['option3'];
	 		$option4 = $_POST['option4'];
	 		$answer = $_POST['answer'];	

	 		$flag;
	 		$qry = "update question set exam_id=$exam_id,question='$question',option1='$option1',option2='$option2',option3='$option3',option4='$option4',answer='$answer' where question_id=$question_id";
	 		if(mysqli_query($con,$qry)){
	 			$flag="true";
	 		}else{
	 			$flag="false";
	 		}
	 		echo json_encode($flag);
	 		break;		

	 	case 'deleteQuestion':
	 		$question_id = $_POST['id'];

	 		$qry = "update question set active_flag=1 where question_id=$question_id";

	 		$flag;
	 		if(mysqli_query($con,$qry)){
	 			$flag="true";
	 		}else{
	 			$flag="false";
	 		}
			echo json_encode($flag);
	 		break;	
	 		
	 	case 'questionCount':
	 		
	 		$exam_id = $_POST["exam_id"];

	 		$json = array();

	 		$qry = "select count(question_id) as total from question where exam_id=$exam_id and active_flag=0";

	 		$res = mysqli_query($con,$qry);	

	 		if(mysqli_num_rows($res)>0){
	 			if($row = mysqli_fetch_array($res)){
	 				echo $row["total"];
	 			}	
	 		}
	 		break;

	 	case 'getTotQuestion':
	 		$exam_id = $_POST["exam_id"];

	 		$json = array();

	 		$qry = "select 
	 				count(q.question_id) as question, e.total_question as total_question, e.exam_title as exam_title 
	 				from question q, exam_master e 
	 				where 
	 				q.exam_id = $exam_id and e.exam_id = $exam_id and q.active_flag = 0 and e.active_flag = 0";

	 		$res = mysqli_query($con,$qry);	

	 		if(mysqli_num_rows($res)>0){
	 			if($row = mysqli_fetch_array($res)){
					$json['data'] = $row;	 				
	 			}	
	 		}

	 		echo json_encode($json);
	 		break;	
	 		
	 	case 'getUserExamStatus':

		 	$json=array();

		 	$qry="select u.user_id as user_id, u.user_name as user_name, f.field_name as field_name,
			 				u.semester as semester, ues.correct_answer as correct_answer, 
			 				ues.wrong_answer as wrong_answer, ues.total_question as total_question,
			 				e.exam_title as exam_title,e.exam_id as exam_id 
			 				from 
			 				user_registration u, field f, user_exam_status ues, exam_master e
			 				where 
			 				u.user_id=ues.user_id and u.field_id=f.field_id and e.exam_id=ues.exam_id";

			if($result=mysqli_query($con,$qry)){

				if(mysqli_num_rows($result)>0){
					while ($row=mysqli_fetch_array($result)) {

						$json["data"][]=$row;
					}
				}
			}
			// $myjson = json_encode($json);
			echo json_encode($json);
	
	 		break;	

	 	case 'getReportQuestion':
	 		
	 		$json=array();

			$user_id=$_GET['user_id'];
	 		$exam_id=$_GET['exam_id'];


	 		$qry="select q.question AS question,q.answer AS correct_answer,uea.answer AS user_answer 
					FROM 
					question q, user_exam_answer uea 
					WHERE 
					q.exam_id = $exam_id 
					AND 
					q.question_id = uea.question_id
					AND
					uea.user_id=$user_id
					";

	 		if($result=mysqli_query($con,$qry)){

				if(mysqli_num_rows($result)>0){
					while ($row=mysqli_fetch_array($result)) {

						$json["data"][]=$row;
					}
				}
			}

			echo json_encode($json);

	 		break;	

	 	case 'checkLogin':
	 		$username = $_POST['username'];
			$password = $_POST['password'];

			$query = "select * from employee where user_name='$username'";
			$result=mysqli_query($con,$query);
				if(mysqli_num_rows($result)>0){
					$query1 = "select * from employee where user_name='$username' and password='$password'";
					$result1=mysqli_query($con,$query1);
					if(mysqli_num_rows($result1)>0){
						
						$query2="select * from employee where user_name='$username' and password='$password' and status=0";
						$result2=mysqli_query($con,$query2);
							if(mysqli_num_rows($result2)>0){
								if($row=mysqli_fetch_array($result2))
								{	
									
									$_SESSION['emp_name']=$row['user_name'];
									$_SESSION['employee_id']=$row['employee_id'];
									$_SESSION['user_image']=$row['user_image'];
									$_SESSION['role_id']=$row['role_id'];
									// echo $_SESSION['user']."<br>";
									// echo $_SESSION['userid'];
									// $arr = array("username"=>"true","password"=>"true","username1"=>$_SESSION['username'],"userid"=>$_SESSION['userid']);
									$arr = array("username"=>"true","password"=>"true","status"=>"true");
									echo json_encode($arr);
									// header("Location:index.php");			
								}
							}else{
								$arr = array("username"=>"true","password"=>"true","status"=>"false");
								echo json_encode($arr);
							}
					}else{
						$arr = array("username"=>"true","password"=>"false");
						// echo "username is correct password is wrong";
						echo json_encode($arr);
					}
				}else{
					$arr = array("username"=>"false");
						// echo "username is correct password is wrong";
					echo json_encode($arr);
					// echo "user not found crete new user"
				}
	 		break;

	 	case 'logout':
	 		session_destroy();
	 		$arr = array("status"=>"true");
			echo json_encode($arr);
	 		
	 		break;
	
		case 'addRole':
			

			$created_by_id = $_SESSION['employee_id'];
			$role_id = $_POST['id'];
			$role_name = $_POST['role_name'];

			if($role_id==0){
				$qry = "insert into role(role_name,created_by_id) values('$role_name',$created_by_id)";				
			}else{
				$qry = "update role set role_name='$role_name' where role_id=$role_id";
			}
			if(mysqli_query($con,$qry)){
				$data = "true";
			}else{
				$data = "false";
			}

			echo json_encode($data);

			break;

		case 'getRole':
			$json = array();

			$qry = "select role_id,role_name from role where active_flag=0";

			if($result=mysqli_query($con,$qry)){

				if(mysqli_num_rows($result)>0){
					while ($row=mysqli_fetch_array($result)) {

						$json["data"][]=$row;
					}
				}
			}

			echo json_encode($json);
			break;

		case 'deleteRole':
			
			$role_id = $_POST['id'];

			$qry = "UPDATE role set active_flag=1 where role_id=$role_id";

			if(mysqli_query($con,$qry)){
				echo json_encode("true");
			}else{
				echo json_encode("false");
			}	
			break;	
			
		case 'addEmployee':
			
			$created_by_id = $_SESSION['employee_id'];
			
			$employee_id = $_POST['id'];
			
			$user_name = $_POST['username'];
			$password = $_POST['password'];
			$employee_name = $_POST['empname'];
			$email = $_POST['email'];
			$mobile_number = $_POST['mobile_number'];
			$role_id = $_POST['role'];


			if ( 0 < $_FILES['file']['error'] ) {
		        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
		    }
		    else {
		    	// echo $_FILES['file']['name'];
		        move_uploaded_file($_FILES['file']['tmp_name'],'../assets/uploads/employee/'.$_FILES['file']['name']);
		    }

		    // $table_name="user_registration";
		    if($employee_id == 0){ 

				$file_name=$_FILES['file']['name']; //get file name

				$query = "insert into employee(
				employee_name, role_id, user_name, password, email, mobile_number, user_image, created_by_id
				) 
				values(
				'$employee_name', $role_id, '$user_name', '$password', '$email', '$mobile_number', '$file_name',
				$created_by_id)";
				// echo $query;
						    	
		    }else{
		    	$file_name=$_FILES['file']['name']; //get file name
				$query = "update employee set employee_name='$employee_name', role_id=$role_id, user_name='$user_name', password='$password', email='$email', mobile_number='$mobile_number', user_image='$file_name'
				 	where 
				 	employee_id=$employee_id";
		    }

	    	if(mysqli_query($con,$query)){
				$data="true";
			}else{
				$data="false";
			}
		    
			echo json_encode($data);
			
			break;	
		
		case 'getEmployee':
			$json = array();

			$qry = "select * from employee where active_flag=0";

			if($result=mysqli_query($con,$qry)){

				if(mysqli_num_rows($result)>0){
					while ($row=mysqli_fetch_array($result)) {

						$json["data"][]=$row;
					}
				}
			}

			echo json_encode($json);
			break;

		case 'deleteEmployee':
			
			$employee_id = $_POST['id'];

			$qry = "UPDATE employee set active_flag=1 where employee_id=$employee_id";

			if(mysqli_query($con,$qry)){
				echo json_encode("true");
			}else{
				echo json_encode("false");
			}	
			break;	

		case 'getProfile':
			
			$employee_id=$_POST['id'];

			$json = array();


			$qry="select e.employee_id,e.employee_name,e.user_name,e.password,e.email,e.mobile_number,e.user_image,r.role_name from employee e,role r where e.employee_id=$employee_id and r.role_id=e.role_id";

			$result = mysqli_query($con,$qry);

			if(mysqli_num_rows($result)>0){
				if($row=mysqli_fetch_array($result)){
					$json['data'][]=$row;
				}
			}

			echo json_encode($row);
			break;	

	 	default:
	 		# code...
	 		break;
	 		
	 } 


	 // function getData($table_name){
		//  	$json = array();
		//  	echo $table_name;
		//  	$qry = "select * from '$table_name' where active_flag=0";

		// 	if($result=mysqli_query($con,$qry)){

		// 		if(mysqli_num_rows($result)>0){
		// 			while ($row=mysqli_fetch_array($result)) {
		// 			// $data+=$row;
		// 				// echo $row;
		// 				$json["data"][]=$row;
		// 			}
		// 		}
		// 	}
		// 	// $myjson = json_encode($json);
		// 	return $json;
	 // }

	 // "update user_exam_status SET correct_answer=(SELECT COUNT(q.exam_id) FROM question q,user_exam_answer uea WHERE q.answer=uea.answer AND q.exam_id=uea.exam_id) WHERE user_id=1";
// "UPDATE user_exam_status SET total_question=$num WHERE exam_id=1 AND user_id=1";
?>