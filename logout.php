

	<?php include('header.php'); ?>
	<?php include('functions.php'); ?>

	<?php
			session_start();
			session_unset();
			session_destroy();
			Header("Location:index.php");

	?>
				
	<?php include('footer.php');?>
	
	
