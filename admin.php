

	<?php include('header.php'); ?>
	<?php include('functions.php'); ?>

	<?php 
	
	session_start();
	if(!isset($_SESSION['user_name']) || empty($_SESSION['user_name'])){ ?>
		
		<div class="container"> <div class="row"> <div class="col-md-6 col-md-offset-3">
		<p class="btn btn-danger btn-large Registration_Warning"> Sorry, Login failed. Please fulfil the following  requirements : </p>
		<ul class="list-group">
		<li class="Error_List list-group-item">Please Login </li>
		</ul>
		<br><br><p  class="try_again"><a href="index.php" class="btn btn-primary btn-large btn-next">Login</a></P>
		</div></div></div>
	
	<?php } else{

			//For changing application status
			if(isset($_GET['action']) && isset($_GET['app_id']) && !empty($_GET['action']) && !empty($_GET['app_id'])){
					
				db_connect();
				$update_status  = update_application_status($_GET['app_id'], $_GET['action']);
				if(!$update_status){
						echo '<p class="btn btn-danger btn-large Registration_Warning"> Sorry, Failed to update application status </p>';
				}	
				db_close();
			}
			
			
			//For deleting student account
			if(isset($_GET['action'])=='delete' && isset($_GET['student_id']) && !empty($_GET['action']) && !empty($_GET['student_id'])){
					
				db_connect();
				$update_status  = delete_the_student($_GET['student_id']);
				if(!$update_status){
						echo '<p class="btn btn-danger btn-large Registration_Warning"> Sorry, Failed to delete student </p>';
				}	
				db_close();
			}
	
	?>
	
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
						<p class="btn btn-success btn-large Registration_Warning"><a href="admin.php"><?php echo $_SESSION['user_name']; ?> </a> | <a href="logout.php">Logout</a> </p>
				</div>
			</div>
		</div>			
	
	<div class="container">
    	<div class="row">
			<div class="col-md-10 col-md-offset-1">			
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							
							<div class="col-xs-6 col-md-6">
								<a href="#" class="active" id="application-list-link">Application List</a>
							</div>
							<div class="col-xs-6 col-md-6">
								<a href="#" id="application-form-link">Student List</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
							
								<div class="table-container" id="application-list">
								<table class="table table-hover">
								
								<tr class="info">
								<td>ID</td>
								<td>Subject</td>
								<td>Description</td>
								<td>Student Email</td>
								<td>Status</td>
								<td>Action</td>
								</tr>
								
								<?php 
								db_connect();
								$all_application = query_all_application();
								$mysql_num_of_rows = mysql_num_rows($all_application);
								if($mysql_num_of_rows == 0 ){
								echo '<tr class="danger"> <td>No Application</td> <td>No Application</td> <td>No Application</td> <td>No Application</td></tr>';
								}

								while ($obj = @mysql_fetch_object($all_application)){?>
									
								<tr class="<?php if(strtolower ($obj->status)=='accepted') echo 'success'; elseif(strtolower ($obj->status)=='rejected') echo'danger'; else{ echo 'warning';}?>">
								<td><?php echo $obj->app_id;?></td>
								<td><?php echo $obj->app_sub; ?></td>
								<td><?php echo $obj->app_desc; ?></td>
								<td><?php echo $obj->user_email; ?></td>
								<td><?php echo $obj->status; ?></td>
								<td>
								<a href="admin.php?action=rejected&&app_id=<?php echo $obj->app_id; ?>"><span class="glyphicon glyphicon-remove" title="Reject"></span> </a> 
								<a href="admin.php?action=pending&&app_id=<?php echo $obj->app_id; ?>"><span class="glyphicon glyphicon-save" title="Pending"></span> </a> 
								<a href="admin.php?action=accepted&&app_id=<?php echo $obj->app_id; ?>"><span class="glyphicon glyphicon-ok" title="Accept"></span> </a> 
								
								</td>
								</tr>
								
								<?php }
								db_close();
								?>

								</table>
								
								
								</div>
								
								<div class="table-container" id="application-form" style="display: none;">

								<div class="table-div">
								<table class="table table-hover">
								
								<tr class="active">
								<td>Name</td>
								<td>Email</td>
								<td>Password</td>
								<td>Action</td>
								</tr>
								
								<?php 
								db_connect();
								$all_student = get_all_student();
								$mysql_num_of_rows_for_student = mysql_num_rows($all_student);
								if($mysql_num_of_rows_for_student == 0 ){
								echo '<tr class="danger"> <td>No Student</td> <td>No Student</td> <td>No Student</td></tr>';
								}

								while ($std = @mysql_fetch_object($all_student)){?>
									
								<tr class="success">
								<td><?php echo $std->name;?></td>
								<td><?php echo $std->email; ?></td>
								<td><?php echo $std->password; ?></td>
								<td>
								<a href="admin.php?action=delete&&student_id=<?php echo $std->id; ?>"><span class="glyphicon glyphicon-remove" title="Delete"></span> </a> 
								<a href="edit_student.php?action=edit&&student_id=<?php echo $std->id; ?>"><span class="glyphicon glyphicon-pencil" title="Edit"></span> </a> 
								</td>
								</tr>
								
								<?php }
								db_close();
								?>

								</table>
								

								</div>
								
								
							<div class="">
							<div class="col-xs-6 col-xs-offset-3">
								<a href="#" id="add-student-link" class="btn btn-success btn-large Registration_Warning"><span class="glyphicon glyphicon-plus"></span>Add Student</a>
							</div>
						</div>
						
						
				<div class="col-md-6 col-md-offset-3 add-student-container" style="display: none;">
				<div class="panel panel-login">
					
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
							
								
								<form id="register-form" action="admin_checkout.php" method="post" role="form">
									
									<div class="form-group">
										<input type="text" name="register-name" id="email" tabindex="1" class="form-control" placeholder="User Name" value="">
									</div>
									<div class="form-group">
										<input type="email" name="register-email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
									</div>
									<div class="form-group">
										<input type="password" name="register-password" id="password" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group">
										<input type="password" name="register-confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Add Student">
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
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php } ?>
	
	
	<?php include('footer.php');?>
	
	
