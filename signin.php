<?php 
include 'dbconnect.php';
session_start();
		
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="assets1/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets1/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
    <link rel="stylesheet" href="assets1/css/Lightbox-Gallery.css">
    <link rel="stylesheet" href="assets1/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets1/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets1/css/styles.css">
</head>

<body>
<?php
if($_SERVER['REQUEST_METHOD']!='POST')
{
	echo'
    <div class="photo-gallery"></div>
    <div class="login-clean">
        <form method="post">
            <h2 class="sr-only">SIgn-up Form</h2>
            <div class="illustration"><i class="icon ion-ios-person"></i></div>
			
            <div class="form-group">
			
			<input class="form-control" type="text" name="user_name" placeholder="User name"><br>
			<input class="form-control" type="password" name="user_pass" placeholder="Password"><br>
			</div>
            <input type="radio" name="radio" value="1">Employer<br>
			<input type="radio" name="radio" value="0">Student
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Log In</button></div>
        </form>
    </div>
    <script src="assets1/js/jquery.min.js"></script>
    <script src="assets1/bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>';
}
else
{
	//$emp=$_POST['radio'];
		//echo $emp;

		$p="SELECT * FROM login WHERE
		username='". mysqli_real_escape_string($conn,$_POST['user_name'])."'
		AND password='".sha1($_POST['user_pass'])."'";				
		$result=mysqli_query($conn,$p);
		$rows=mysqli_num_rows($result);
		if(!$result)
		{
			echo 'Something went wrong while signing in !! Try again later.';
		}
		else
		{
			if(mysqli_num_rows($result)==0)
			{
			echo'Username or password is incorrect !! '	;
				
			}
			else{
				$_SESSION['signed_in']=true;
				 while($row = mysqli_fetch_assoc($result))
                    {
                        $_SESSION['user_id']    = $row['id'];
                        $_SESSION['user_name']  = $row['username'];
                        $_SESSION['user_level'] = $row['type'];
                    }
					if($_SESSION['user_level']==1)
					{
						echo'Welcome,'.$_SESSION['user_name'].'<a href="emp.php"> Post jobs/internships here!</a>.';
			
					}
			if($_SESSION['user_level']==0)
			{
				echo'<span class="navbar-text actions">';
				echo'Welcome,'.$_SESSION['user_name'].'<a href="student.php">Apply for internships here! </a>.';
			}
			}
			
			}
		//ALTER TABLE tablename AUTO_INCREMENT = 1 for starting user_id from 1 
	}

	?>
</body>
</html>