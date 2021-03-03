<?php

	include_once './admin/config/dbConnection.php';

	session_start();

	$req = $_REQUEST['action'];

	// $con -> getConnect();

	switch ($req) {

		case 'checkEmail':

			$email = $_POST['email'];

			// echo $email;

			$qry = "select email from user_registration where email='$email'";
			$result = mysqli_query($con,$qry);

			if(mysqli_num_rows($result)>0){
				echo json_encode("true");
			}else{
				echo json_encode("false");
			}
			break;

		case 'user_registration':
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
		        move_uploaded_file($_FILES['file']['tmp_name'],'./uploads/'.$_FILES['file']['name']);
		    }

		    // $table_name="user_registration";
		    if($id == 0){ 
				$file_name=$_FILES['file']['name'];
				$query = "insert into user_registration(user_name,field_id,semester,email,password,profile_pic) values('$username',$field_id,$semester,'$email','$password','$file_name')";
				// echo $query;
				if(mysqli_query($con,$query)){
					$data="true";
				}else{
					$data="false";
				}		    	
		    }else{

		    }
			echo json_encode($data);
			break;

		case 'Login':

			$username = $_POST['username'];
			$password = $_POST['password'];
			// echo $username ." password".$password;
			$query = "select * from user_registration where user_name='$username'";
			$result=mysqli_query($con,$query);
				if(mysqli_num_rows($result)>0){
					$query1 = "select * from user_registration where user_name='$username' and password='$password'";
					$result1=mysqli_query($con,$query1);
					if(mysqli_num_rows($result1)>0){
						
						$query2="select u.user_name,u.user_id,f.field_name,f.field_id from user_registration u,field f where user_name='$username' and password='$password' and f.field_id=u.field_id and status=0";
						$result2=mysqli_query($con,$query2);
							if(mysqli_num_rows($result2)>0){
								if($row=mysqli_fetch_array($result2))
								{	
									
									$_SESSION['user_name']=$row['user_name'];
									$_SESSION['user_id']=$row['user_id'];
									$_SESSION['field_id']=$row['field_id'];
									$_SESSION['field_name']=$row['field_name'];
									// echo $_SESSION['user']."<br>";
									// echo $_SESSION['userid'];
									// $arr = array("username"=>"true","password"=>"true","username1"=>$_SESSION['username'],"userid"=>$_SESSION['userid']);
									$arr = array("username"=>"true","password"=>"true","status"=>"true");
									echo json_encode($arr);			
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

		case 'getExam':
			$json=array();

			$field_id = $_SESSION['field_id']; 

			$date = date("Y-m-d");
			$qry="select exam_title,exam_id,semester from exam_master where field_id=$field_id and exam_date=$date and active_flag=0 and status=0";

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

		case 'getField':
			$json=array();

			$qry="select field_id,field_name from field where active_flag=0";

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

		case 'getQuestion':
			$json=array();

			$exam_id = $_POST['exam_id'];

			$qry="SELECT question_id,question,option1,option2,option3,option4 from question WHERE exam_id=$exam_id AND active_flag=0";

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

		case 'saveQuestionAnswer':
			$max = $_POST['max'];
			$user_id = $_POST['user_id'];
			$exam_id = $_POST['exam_id'];

			$question_id = array($max);
			$answer = array($max);

			$json = array();

			for ($i=1; $i <= $max; $i++) { 
				$question_id[$i] = $_POST['question'.$i];
				$answer[$i] = $_POST['answer'.$i];


				$qry = "insert into user_exam_answer(user_id,exam_id,question_id,answer) values($user_id,$exam_id,$question_id[$i],'$answer[$i]')";
				if(mysqli_query($con,$qry)){
					// return 1;
				}else{
					$arr = array("status"=>"false");
					echo json_encode($arr);
				}
			}
			$arr = array("status"=>"true");	
			echo json_encode($arr);
			break;	

		case 'addExamStatus':
			$exam_id = $_POST['exam_id'];
			$user_id = $_POST['user_id'];

			// $arr = array("exam_id"=>$exam_id,"user_id"=>$user_id);

			$qry = "select status from user_exam_status where exam_id=$exam_id and user_id=$user_id";

			$res=mysqli_query($con,$qry);
			if(mysqli_num_rows($res)>0){
				$arr = array("status"=>"exist");
				echo json_encode($arr);
			}else{
				$qry1="insert into user_exam_status(exam_id,user_id) values($exam_id,$user_id)";
				if(mysqli_query($con,$qry1)){
					$arr = array("status"=>"true");
					$_SESSION['exam_id'] = $exam_id;
					echo json_encode($arr);
				}else{
					$arr = array("status"=>"false");
					echo json_encode($arr);
				}
			}
			break;

		case 'webCamSnap':
			$user_name=$_SESSION['user_name'];
			$current_date=date("Y-m-d");
			$upload_dir = "assets/uploads/students/";
			if(is_dir($upload_dir)){
				if(!is_dir("$upload_dir/$user_name/$current_date")){
					mkdir("$upload_dir/$user_name/$current_date",0777,true);
					$upload_dir="$upload_dir/$user_name/$current_date/";
				}else{
					$upload_dir="$upload_dir/$user_name/$current_date/";
				}
			}

			// echo  json_encode("directory created:".$upload_dir);
			$img = $_POST['web_cam_canvas'];
			$img = str_replace('data:image/png;base64,', '', $img);
			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);
			$file = $upload_dir . uniqid() . ".png";
			$success = file_put_contents($file, $data);
			$uploaded="success";
			echo json_encode("true");
			break;	

		case 'updateUserExamStatus':
			$exam_id = $_POST['exam_id'];
			$user_id = $_POST['user_id'];

			$json = array();

			$qry = "UPDATE user_exam_status AS ues SET wrong_answer = 
					(SELECT COUNT(q.exam_id) AS wrong_answer FROM question q,user_exam_answer uea WHERE q.answer!=uea.answer AND q.question_id=uea.question_id AND q.exam_id=$exam_id AND uea.user_id=$user_id),
					ues.correct_answer=(
					SELECT COUNT(q.exam_id) AS correct_answer FROM question q,user_exam_answer uea WHERE q.answer=uea.answer AND q.question_id=uea.question_id AND q.exam_id=$exam_id AND uea.user_id=$user_id),
					ues.total_question=(SELECT COUNT(question_id) FROM question WHERE exam_id=$exam_id)";
			if(mysqli_query($con,$qry)){
				$qry = "select total_question,correct_answer,wrong_answer from user_exam_status where exam_id=$exam_id and user_id=$user_id";
				$result = mysqli_query($con,$qry);
				if(mysqli_num_rows($result)>0){
					if($row=mysqli_fetch_array($result)){
						$json['data'][]=$row;	
					}
				}
				echo json_encode($json);
			}else{
				echo json_encode("false");
			}		
					
			break;	

		default:
			# code...
			break;
	}

function insert_user_answer($user_id,$exam_id,$question_id,$answer){
	$qry = "insert into user_exam_answer(user_id,exam_id,question_id,answer) values($user_id,$exam_id,$question_id,'$answer')";
	if(mysqli_query($con,$qry)){
		return 1;
	}else{
		return 0;
	}
}
// UPDATE user_exam_status AS ues SET wrong_answer = 
// (SELECT COUNT(q.exam_id) AS wrong_answer FROM question q,user_exam_answer uea WHERE q.answer!=uea.answer AND q.question_id=uea.question_id AND q.exam_id=uea.exam_id AND uea.user_id=1),
// ues.correct_answer=(
// SELECT COUNT(q.exam_id) AS correct_answer FROM question q,user_exam_answer uea WHERE q.answer=uea.answer AND q.question_id=uea.question_id AND q.exam_id=uea.exam_id AND uea.user_id=1),
// ues.total_question=(SELECT COUNT(question_id) FROM question WHERE exam_id=1);


//update user_exam_status  
// SELECT COUNT(q.exam_id) AS wrong_answer FROM question q,user_exam_answer uea WHERE q.answer!=uea.answer AND q.question_id=uea.question_id AND q.exam_id=1 AND uea.user_id=1;
// SELECT COUNT(q.exam_id) AS correct_answer FROM question q,user_exam_answer uea WHERE q.answer=uea.answer AND q.question_id=uea.question_id AND q.exam_id=1 AND uea.user_id=1;
// SELECT COUNT(question_id) AS total_question FROM question WHERE exam_id=1;

// SELECT COUNT(uea.question_id) AS wrong_answer FROM question q,user_exam_answer uea WHERE uea.answer=q.answer AND q.question_id=uea.question_id AND uea.exam_id=1  AND  uea.user_id=1;
?>