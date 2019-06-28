

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
	
	?>
	
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
						<p class="btn btn-success btn-large Registration_Warning"><?php echo $_SESSION['user_name']; ?> | <a href="logout.php">Logout</a> </p>
				</div>
			</div>
		</div>			
	
	<div class="container">
    	<div class="row">
			<div class="col-md-10 col-md-offset-1">			
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							
							<div class="col-xs-6">
								<a href="#" class="active" id="application-list-link">Application List</a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="application-form-link">New Application</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
							
								<div class="table-container" id="application-list">
								<table class="table table-hover">
								
								<tr class="active">
								<td>ID</td>
								<td>Subject</td>
								<td>Description</td>
								<td>Status</td>
								</tr>
								
								<?php 
								db_connect();
								$all_application = query_all_application_by_email($_SESSION['user_email']);
								$mysql_num_of_rows = mysql_num_rows($all_application);
								if($mysql_num_of_rows == 0 ){
								echo '<tr class="danger"> <td>No Application</td> <td>No Application</td> <td>No Application</td> <td>No Application</td></tr>';
								}

								while ($obj = @mysql_fetch_object($all_application)){?>
									
								<tr class="<?php if(strtolower ($obj->status)=='accepted') echo 'success'; elseif(strtolower ($obj->status)=='rejected') echo'danger'; else{ echo 'warning';}?>">
								<td><?php echo $obj->app_id;?></td>
								<td><?php echo $obj->app_sub; ?></td>
								<td><?php echo $obj->app_desc; ?></td>
								<td><?php echo $obj->status; ?></td>
								</tr>
								
								<?php }
								db_close();
								?>

								</table>
								</div>
								
								
								<form id="application-form" action="application.php" method="post" role="form" style="display: none;">
									
									<div class="form-group">
										<input type="text" name="application-id" id="application-no" tabindex="1" class="form-control" placeholder="ID" value="">
									</div>
									<div class="form-group">
										<input type="text" name="application-subject" id="application-subject" tabindex="1" class="form-control" placeholder="Subject" value="">
									</div>
									
									<div class="form-group">
										<textarea name="application-description" id="application-description" tabindex="2" class="form-control" rows ="5" placeholder="Description"> </textarea>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="application-submit" id="application-submit" tabindex="4" class="form-control btn btn-register" value="Submit">
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
	
	<?php } ?>
	
	
	<?php include('footer.php');?>
	
	
