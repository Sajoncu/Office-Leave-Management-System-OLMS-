

	<?php include('header.php'); ?>
	<?php include('functions.php'); ?>
	
	
	<?php 
	//For deleting student account
	if(isset($_GET['action']) && $_GET['action']=='edit' && isset($_GET['student_id']) && !empty($_GET['student_id'])){
					
		db_connect();
		$student_info  = get_the_student_by_id($_GET['student_id']);
			
		if(!$student_info ){
			echo '<div class="container"> <div class="row"> <div class="col-md-10 col-md-offset-1">
				<p class="btn btn-danger btn-large Registration_Warning"> Sorry, No data found to edit profile</p>		
				<ul class="list-group">
				<li class="Error_List list-group-item"> Please select correct student to edit profile </li>
				</ul>   
				<br><br><p  class="try_again"><a href="admin.php" class="btn btn-primary btn-large btn-next">Login</a></P>
				</div>
				</div>
				</div>';
		
		}else{ ?>

		<div class="container">
    	<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							
							<div class="col-xs-12">
								<a href="#" id="register-form-link">Edit Student</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								
								<form id="register-form" action="update_student_profile.php?student_id=<?php echo $student_info->id;?>" method="post" role="form" >
									
									<div class="form-group">
										<input type="text" name="register-name" id="email" tabindex="1" class="form-control" placeholder="User Name" value="<?php if(!empty($student_info ->name))  echo $student_info ->name; ?>">
									</div>
									<div class="form-group">
										<input type="email" name="register-email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="<?php if(!empty($student_info ->email))  echo $student_info ->email; ?>">
									</div>
									<div class="form-group">
										<input type="password" name="register-password" id="password" tabindex="2" class="form-control" placeholder="Password" value="<?php if(!empty($student_info ->password))  echo $student_info ->password; ?>">
									</div>
									<div class="form-group">
										<input type="password" name="register-confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password" value="<?php if(!empty($student_info ->password))  echo $student_info ->password; ?>">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Submit">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php 	}
			db_close();
			} else {?>
	
	<div class="container"> <div class="row"> <div class="col-md-10 col-md-offset-1">
		<p class="btn btn-danger btn-large Registration_Warning"> Sorry, No data found to edit profile</p>
		
		<ul class="list-group">
		
			
		<li class="Error_List list-group-item"> Please select correct student to edit profile </li>
		
		</ul>
			 
					   
		<br><br><p  class="try_again"><a href="admin.php" class="btn btn-primary btn-large btn-next">Login</a></P>
		</div>
		</div>
		</div>
		
	<?php }	?>
	
	
	<?php include('footer.php');?>
	
	
