<?php 
include 'dbconnect.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="assets2/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets2/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
    <link rel="stylesheet" href="assets2/css/Lightbox-Gallery.css">
    <link rel="stylesheet" href="assets2/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets2/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets2/css/styles.css">
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
			<input class="form-control" type="text" name="name" placeholder="Name"><br>
			<input class="form-control" type="text" name="user_name" placeholder="User name"><br>
			<input class="form-control" type="password" name="user_pass" placeholder="Password"><br>
			
			<input class="form-control" type="password" name="user_pass_check" placeholder="Re-enter password"><br>
			<input class="form-control" type="email" name="user_email" placeholder="Email"><br>
			</div>
            <input type="radio" name="radio" value="1">Employer<br>
			<input type="radio" name="radio" value="0">Student
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Log In</button></div>
        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>';
}
else
{
	$errors=array();
	$i=0;
	//username check
	if(isset($_POST['user_name']))
	{
		if(!ctype_alnum($_POST['user_name']))
		{
			$errors[$i]="The username can only contain letters,digits and not special characters.";
			
				$i++;
			
			
		}	
		
	}
	else
	{
		$errors[$i]="Can't be left empty";
		$i++;
	}
	//password check
	if(isset($_POST['user_pass']))
	{
		if($_POST['user_pass']!=$_POST['user_pass_check'])
		{
			$errors[$i]="PASSWORDS DON'T MATCH";
			$i++;
		}
	}
	if(empty($_POST['user_pass']))
	{
		$errors[$i]="PASSWORD FIELD CAN'T BE LEFT EMPTY";
		$i++;
	}
	
	if(!empty($errors))
	{
		echo "TOTAL ERRORS:".$i."<br>"."<br>";
		echo'Correct following errors before continuing';
		echo'<ul>';
		for($i=0;$i<count($errors);$i++)
		{
			echo"<li>";
			echo $errors[$i];
			echo"</li>";
			echo "<br>";
		}
		
		echo'Click here for re entering the correct information <a href=signup/signup.php>BACK TO SIGN-UP PAGE</a>';
		echo'</ul>';
	}
	else
	{
		//$emp=$_POST['radio'];
		//echo $emp;
		$p="INSERT INTO login(name,username,password,email,type)VALUES
		('".mysqli_real_escape_string($conn,$_POST['name'])."','".mysqli_real_escape_string($conn,$_POST['user_name'])."',
		'".sha1($_POST['user_pass'])."',
		'" . mysqli_real_escape_string($conn,$_POST['user_email'])." ',
		'".$_POST['radio']."')";
				
	$qu=mysqli_query($conn,$p); 


		if(!$qu)
		{
			echo"SOMETHING WENT WRONG !!!  TRY AGAIN .";
		}
		else
		{
			echo'<h1 style="color:red;text-align:center;">'."SIGNED UP SUCESSFULLY".'</h1>';
		echo'<h3 style="color:green;text-align:center;">'."LOGIN HERE AND START SEARCHING <a href='signin.php'>~LOGIN~</a>";
		}
		//ALTER TABLE tablename AUTO_INCREMENT = 1 for starting user_id from 1 
	}
	
	
}

	?>
</body>
</html>