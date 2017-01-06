<?php
	require_once('../../includes/initialize.php');
	
?>
<?php
	
	if(isset($_POST['submit'])) {
		$user = new User();
		$user->username = $_POST['email'];
		$user->password = $_POST['password'];
		$user->first_name = '';
		$user->last_name = '';
		if($user->save()) {
			// Success
	    	$session->message("Sign up successfully.");
	    	redirect_to('login.php');
		} else {
			// Failure

	    	

	    	$session->message('HUHU');
	    	redirect_to('login.php');
		}
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign in Page</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<style>
		body{
			margin:50px;
		}
		
	</style>
</head>
<body>
	<div class="container">

      <form class="form-horizontal" method="POST">
	        <fieldset>
	        	<legend>Sign in</legend>
	        	
	        	<div class="form-group">
	        		<label for="email" class="control-label col-sm-3"><strong>Email:</strong></label>
	        		<div class="col-sm-3">	
	        			<input type="text" name="email" id="email" placeholder="Enter your email here:" class="form-control">
	        		</div>
	        	</div>
	        	<div class="form-group">
	        		<label for="password" class="control-label col-sm-3"><strong>Password:</strong></label>
	        		<div class="col-sm-3">
	        			<input type="password" name="password" id="passowrd" placeholder="Enter your password here:" class="form-control">
	        		</div>
	        	</div>
	        	<div class="form-group">
	        		<div class="col-sm-offset-4 col-sm-2">
	        			<input type="submit" name="submit" value="Sign up" />
	        		</div>
	        	</div>
	        </fieldset>
      </form>

    </div>
</body>
</html>