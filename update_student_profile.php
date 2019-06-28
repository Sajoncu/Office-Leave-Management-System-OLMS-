

<?php include('header.php'); ?>
<?php include('functions.php'); ?>

<?php

	if(isset($_POST) &&!empty($_POST) && isset($_GET['student_id']) && !empty($_GET['student_id'])){

	$register_name = trim($_POST['register-name']);
	$register_email = trim($_POST['register-email']);
	$register_password = $_POST['register-password'];
	$register_confirm_password = $_POST['register-confirm-password'];

	//Set Error 
	if(empty($register_name) || $register_name==""){
		
		Set_Error('register_name',' Type your name');
	}
	
	if(empty($register_email) || $register_email==""){
		
		Set_Error('registration_email',' Type your email');
	}

	if(empty($register_password) || $register_password==""){
		
		Set_Error('register_password',' Type your password');
	}

	if(empty($register_confirm_password) || $register_confirm_password==""){
		
		Set_Error('register_password',' Re-type password');
	}

	if($register_password != $register_confirm_password){
		
		Set_Error('register_password',' Password did not match');
	}
	
	
	//If user email already exists
		   //db_connect();
		   //$student = query_row_from_student_register_table('email', $register_email);
			//if(isset($student) && !empty($student) && $student->email == $register_email){
			//	Set_Error('register_email',' Email already exists');
			//}
			//db_close();
		
		
		
	//Checking Errors
		if(count($Errors)>0){
		$n=count($Errors);
		print'<div class="container"> <div class="row"> <div class="col-md-6 col-md-offset-3">';
		print '<p class="btn btn-danger btn-large Registration_Warning"> Sorry, profile not edited successfully. Please fulfil the following  requirements : </p>';
		
		print'<ul class="list-group">';
		for($i=0; $i<$n; $i++){
			
		print'<li class="Error_List list-group-item">'. $Errors[$i]. '</li>';
		}
			 print'</ul>';
			 
					   
		print'<br><br><p  class="try_again"><a href="admin.php" class="btn btn-primary btn-large btn-next">'.'Try Again'.'</a></P>';
		print'</div></div></div>';
		}
		
		
		
		//If not error
		if(count($Errors)==0){
			
			db_connect();
			
			$update_user_data = update_row_into_student_register_table($register_name, $register_email, $register_password, $_GET['student_id']);
			
			if($update_user_data){
				
			$n=count($Errors);
			print'<div class="container"> <div class="row"> <div class="col-md-6 col-md-offset-3">';
			print '<p class="btn btn-success btn-large Registration_Warning"> Congratulations, Profile edited successfully </p>';
			print'<ul class="list-group">';	
			print'<li class="Error_List list-group-item">Name - '. $register_name. '</li>';
			print'<li class="Error_List list-group-item">Email - '. $register_email. '</li>';
			print'<li class="Error_List list-group-item">Paswword - '. $register_password. '</li>';
			
			print'</ul>';
				 
						   
			print'<br><br><p  class="try_again"><a href="admin.php" class="btn btn-primary btn-large btn-next">'.'Go Back'.'</a></P>';
			print'</div></div></div>';
		
			}else{
			
			print'<div class="container"> <div class="row"> <div class="col-md-6 col-md-offset-3">';
			print '<p class="btn btn-danger btn-large Registration_Warning"> Sorry, Failed to add student!!! </p>';
			print'<ul class="list-group">';	
			print'<li class="Error_List list-group-item">Name - '. $register_name. '</li>';
			print'<li class="Error_List list-group-item">Email - '. $register_email. '</li>';
			print'<li class="Error_List list-group-item">Paswword - '. $register_password. '</li>';
			
				 print'</ul>';
				 
						   
			print'<br><br><p  class="try_again"><a href="admin.php" class="btn btn-primary btn-large btn-next">'.'Try Again'.'</a></P>';
			print'</div></div></div>';
			
		}
			db_close();
		}


		}
?>

<?php include('footer.php');?>
	