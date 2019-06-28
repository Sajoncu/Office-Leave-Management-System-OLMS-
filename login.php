

	<?php include('header.php'); ?>
	<?php include('functions.php'); ?>

	<?php

	if(isset($_POST) &&!empty($_POST)){

	$user_email = trim($_POST['login-email']);
	$user_password = trim($_POST['login-password']);
	
	//Set Error 
	if(empty($user_email) || $user_email==""){
		
		Set_Error('user_email',' Type your email');
	}
	
	if(empty($user_password) || $user_password==""){
		
		Set_Error('user_password',' Type your password');
	}
	
	
				//If not error
		if(count($Errors)==0){
			
			db_connect();
			
			$user = get_the_user($user_email, $user_password);
			
			if($user){	
				session_start();
				$_SESSION['user_id'] = $user->id;
				$_SESSION['user_name'] = $user->name;
				$_SESSION['user_email'] = $user->email;
				$_SESSION['user_type'] = $user->account_type;
				
				//Check the user
				if($_SESSION['user_type'] == 'student'){
				header("Location: student.php");
				die();
				}
				
				//Check the user
				if($_SESSION['user_type'] == 'admin'){
				header("Location: admin.php");
				die();
				}
		
			}else{
		
				Set_Error('user_not_found',' Please enter correct email and password');
			}
			
			db_close();
			}
		
		
			//Checking Errors
		if(count($Errors)>0){
		$n=count($Errors);
		print'<div class="container"> <div class="row"> <div class="col-md-6 col-md-offset-3">';
		print '<p class="btn btn-danger btn-large Registration_Warning"> Sorry, Login failed. Please fulfil the following  requirements : </p>';
		
		print'<ul class="list-group">';
		for($i=0; $i<$n; $i++){
			
		print'<li class="Error_List list-group-item">'. $Errors[$i]. '</li>';
		}
			 print'</ul>';
			 
					   
		print'<br><br><p  class="try_again"><a href="index.php" class="btn btn-primary btn-large btn-next">'.'Try Again'.'</a></P>';
		print'</div></div></div>';
		}
		
	
	 ?>
		
	
	<?php } //End of main if ?> 
	
	<?php include('footer.php');?>
	
	
