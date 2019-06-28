
<?php  

		//For Form Validation//
			$Errors= array();
			$Errors_Field= array();
			//global $conn;
			  
			
			
		function Set_Error($FieldName, $ErrStr){
			  global $Errors_Field,$Errors; 
			  $Error_Field[$FieldName]=1;
			  $Errors[]=$ErrStr;
			
		}


		function Check_Error($FieldName){
			   global $Errors_Field,$Errors;
			   if (isset($Error_Field[$FieldName])){
			
			return true;
			}
		return false;

		}

		//FOR DB Connection
		function db_connect(){
			$host="localhost";
			$user="root";
			$pass="root";
			$DB="olms";

			$MC=mysql_connect($host, $user, $pass) or die('Error !!!  Unable to Connect !!!!!..........');
			mysql_select_db($DB);
			
		}

		//FOR DB Closing
		function db_close(){
			
			mysql_close();
		}

		//For inserting data into student_register table

		function insert_row_into_student_register_table($name, $email, $password, $account_type){
			
			$insert_user_data = "INSERT INTO student_registration(name, email, password, account_type) VALUES ('$name', '$email', '$password', '$account_type')";
			$Query_insert_user_data = mysql_query($insert_user_data) or die(mysql_error("Failed to insert data"));
			return $Query_insert_user_data;
		}

		//For querying data from student_register table

		function query_row_from_student_register_table($field_name, $field_value){
			
			$user_data_sql = "SELECT * FROM student_registration WHERE $field_name='$field_value'";
			$query_user_data_sql = mysql_query($user_data_sql) or die(mysql_error()); 
			$obj = @mysql_fetch_object($query_user_data_sql);
			return $obj;
		}
		
		
		//For inserting data into student_register table

		function insert_row_into_application_table($application_id, $application_subject, $application_description, $application_status, $user_email){
			
			$insert_app_data = "INSERT INTO application(app_id, app_sub, app_desc, status, user_email) VALUES ('$application_id', '$application_subject', '$application_description', '$application_status', '$user_email')";
			$Query_insert_app_data = mysql_query($insert_app_data) or die(mysql_error("Failed to insert data"));
			return $Query_insert_app_data;
		}
		
		
		//For querying data from application table

		function query_row_from_application_table($field_name, $field_value){
			
			$app_data_sql = "SELECT * FROM application WHERE $field_name='$field_value'";
			$query_app_data_sql = mysql_query($app_data_sql) or die(mysql_error()); 
			$obj = @mysql_fetch_object($query_app_data_sql);
			return $obj;
		}
		
		//For querying all application from application table

		function query_all_application(){
			
			$app_data_sql = "SELECT * FROM application ";
			$query_app_data_sql = mysql_query($app_data_sql) or die(mysql_error()); 
			return $query_app_data_sql;
		}
		
		//For querying all application by student email from application table
		function query_all_application_by_email($student_email){
			
			$app_data_sql = "SELECT * FROM application WHERE user_email='$student_email'";
			$query_app_data_sql = mysql_query($app_data_sql) or die(mysql_error()); 
			return $query_app_data_sql;
		}
		
		
		//For querying all user from student_registration table

		function get_the_user($user_email, $user_password){
			
			$user_data_sql = "SELECT * FROM student_registration WHERE email='$user_email' AND password='$user_password'";
			$query_user_data_sql = mysql_query($user_data_sql) or die(mysql_error()); 
			if($obj = @mysql_fetch_object($query_user_data_sql)){
				return $obj;
			}
			return false;
		}
		
		
		//For updating application status on application

		function update_application_status($application_id, $updated_status){
			
			$app_data_sql = "UPDATE application SET status='$updated_status' WHERE app_id='$application_id'";
			$query_app_data_sql = mysql_query($app_data_sql) or die(mysql_error()); 
			return $query_app_data_sql;
		}
		
		
		//For getting all student from student_registration table

		function get_all_student(){
			
			$std_data_sql = "SELECT * FROM student_registration WHERE account_type='student'";
			$query_std_data_sql = mysql_query($std_data_sql) or die(mysql_error()); 
			return $query_std_data_sql;
		}
		
		
		//For getting all student from student_registration table

		function get_the_student_by_id($student_id){
			
			$std_data_sql = "SELECT * FROM student_registration WHERE id='$student_id' && account_type='student'";
			$query_std_data_sql = mysql_query($std_data_sql) or die(mysql_error()); 
			if($obj = @mysql_fetch_object($query_std_data_sql)){
				return $obj;
			}
			
			return false;
		}
		
		
		//For getting all student from student_registration table

		function delete_the_student($student_id){
			
			$std_data_sql = "DELETE FROM student_registration WHERE id='$student_id'";
			$query_std_data_sql = mysql_query($std_data_sql) or die(mysql_error()); 
			return $query_std_data_sql;
		}
		
		
		//For updating data into student_register table

		function update_row_into_student_register_table($name, $email, $password, $id){
			
			$insert_user_data = "UPDATE student_registration SET name='$name', email='$email', password='$password' WHERE id='$id'";
			$Query_insert_user_data = mysql_query($insert_user_data) or die(mysql_error("Failed to insert data"));
			return $Query_insert_user_data;
		}


?>