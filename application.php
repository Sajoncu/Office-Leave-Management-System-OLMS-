

<?php include('header.php'); ?>
<?php include('functions.php'); ?>

<?php
	
	session_start();
	if(isset($_POST) && !empty($_POST) && isset($_SESSION['user_type']) && !empty($_SESSION['user_type']) && $_SESSION['user_type']=='student'){

	$application_id = trim($_POST['application-id']);
	$application_subject = trim($_POST['application-subject']);
	$application_description = trim($_POST['application-description']);

	//Set Error 
	if(empty($application_id) || $application_id==""){
		
		Set_Error('application_id',' Type application number');
	}
	
	if(empty($application_subject) || $application_subject==""){
		
		Set_Error('application_subject',' Type application subject');
	}

	if(empty($application_description) || $application_description==""){
		
		Set_Error('application_description',' Type application description');
	}

	
	
	//If user email already exists
			db_connect();
			$application = query_row_from_application_table('app_id', $application_id);
			if(isset($application) && !empty($application) && $application->app_id == $application_id){
				Set_Error('application_id',' Application ID already exists');
			}
			db_close();
		
		
		
	//Checking Errors
		if(count($Errors)>0){
			$n=count($Errors);
			print'<div class="container"> <div class="row"> <div class="col-md-6 col-md-offset-3">';
			print '<p class="btn btn-danger btn-large Registration_Warning"> Sorry, Application not submitted . Please fulfil the following  requirements : </p>';
			
			print'<ul class="list-group">';
			for($i=0; $i<$n; $i++){
				
			print'<li class="Error_List list-group-item">'. $Errors[$i]. '</li>';
			}
				 print'</ul>';
				 
						   
			print'<br><br><p  class="try_again"><a href="student.php" class="btn btn-primary btn-large btn-next">'.'Try Again'.'</a></P>';
			print'</div></div></div>';
		}
		
		
		
		//If not error
		if(count($Errors)==0){
			
			db_connect();
			
			$insert_user_data = insert_row_into_application_table($application_id, $application_subject, $application_description, "Pending", $_SESSION['user_email']);
			
			if($insert_user_data){
				
			$n=count($Errors);
			print'<div class="container"> <div class="row"> <div class="col-md-6 col-md-offset-3">';
			print '<p class="btn btn-success btn-large Registration_Warning"> Congratulations, your application has been  submitted with following info : </p>';
			print'<ul class="list-group">';	
			print'<li class="Error_List list-group-item">Application no - '. $application_id. '</li>';
			print'<li class="Error_List list-group-item">Application subject - '. $application_subject. '</li>';
			print'<li class="Error_List list-group-item">Application description - '. $application_description. '</li>';
			print'<li class="Error_List list-group-item">Status - Pending</li>';
			
			print'</ul>';
				 
						   
			print'<br><br><p  class="btn-try-again"><a href="student.php" class="btn btn-primary btn-large btn-next">'.'Back to application'.'</a></P>';
			print'</div></div></div>';
		
			}else{
			
			print'<div class="container"> <div class="row"> <div class="col-md-6 col-md-offset-3">';
			print '<p class="btn btn-danger btn-large Registration_Warning"> Sorry, Failed to submit application !!! </p>';
			print'<ul class="list-group">';	
			print'<li class="Error_List list-group-item">Name - '. $application_id. '</li>';
			print'<li class="Error_List list-group-item">Email - '. $application_subject. '</li>';
			print'<li class="Error_List list-group-item">Paswword - '. $application_description. '</li>';
			
				 print'</ul>';
				 
						   
			print'<br><br><p  class="try_again"><a href="student.php" class="btn btn-primary btn-large btn-next">'.'Try Again'.'</a></P>';
			print'</div></div></div>';
			
		}
			db_close();
		}


		} else{ ?> 
			
			<div class="container"> <div class="row"> <div class="col-md-6 col-md-offset-3">
		<p class="btn btn-danger btn-large Registration_Warning"> Sorry, Login failed. Please fulfil the following  requirements : </p>
		<ul class="list-group">
		<li class="Error_List list-group-item">Please Login </li>
		</ul>
		<br><br><p  class="try_again"><a href="index.php" class="btn btn-primary btn-large btn-next">Login</a></P>
		</div></div></div>
		
		<?php }
?>

<?php include('footer.php');?>
	