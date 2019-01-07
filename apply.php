<?php 
session_start();
include('dbconnect.php');
$employer=$_GET['employer'];
$title=$_GET['title'];
$usname=$_SESSION['user_name'];
$query="SELECT * FROM internships WHERE employer='$employer' AND title='$title'";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
 ?>
 <!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intern</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body style="font-size:20px;">
<?php 
include('dbconnect.php');
?>
    <div>
        <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
            <div class="container"><a class="navbar-brand" href="index.php" style="background-color:#5618d9;color:rgb(255,255,255);">INTERNSHALA</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div
                    class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav mr-auto">
                        <li class="nav-item" role="presentation"><a class="nav-link active" href="https://google.com">About Us</a></li>
   			
              
					
					</ul>
					 <?php	
		
		//$status=session_status();
         //echo$status;
		if(isset($_SESSION['signed_in']))//isset solves undefined session problem
		{
			echo'<span class="navbar-text actions">';
			echo'Hello!! <i><b>'.$_SESSION['user_name'].'</i></b>'."<br>".'Not '.$_SESSION['user_name'].'?'.'<a href="logout.php" class="btn btn-light action-button">Sign out</a>';
		}
		 else
    {
      echo' <span class="navbar-text actions"> <a href="signin.php" class="login">Log In</a>
					<a class="btn btn-light action-button" role="button" href="signup.php">Sign Up</a></span></div';
    }
	
		
					
    
	?>
	</div>
    </nav>
    </div>
<body><div class="jumbotron" style="width:70%; margin:0 auto;">
  
  <p class="text-info" style="font-size: 60px;"> Applying for </p>
  <div class="well well-lg bg-info">
  <p><strong>Employer: </strong><?php echo $row['employer']; ?></p>
    <h4><strong>Title: </strong><?php echo $row['title']; ?></h4>
    <p><strong>Description: </strong><?php echo $row['description']; ?></p>
    <p><strong>Stipend: Rs. </strong><?php echo $row['stipend']; ?></p>
 
</div>
<form  action="" method="post">
<input type="hidden" name="title" value="<?php echo $row['title']; ?>">
  <div class="form-group">
    <label class="col-sm-2 control-label">Name:</label>
    <div class="col-sm-8">
      <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="Name">
    </div>
  </div>
  <br>
   <div class="form-group">
   <br>
    <label class="col-sm-2 control-label">E-Mail:</label>
    <div class="col-sm-8">
      <input type="text" name="email" class="form-control" id="inputEmail3" placeholder="Your e-mail">
    </div>
  </div>
   <div class="form-group">
   <br>
    <label class="col-sm-2 control-label">Employer:</label>
    <div class="col-sm-8">
      <input type="text" name="employer" class="form-control" id="inputEmail3" value="<?php echo $row['employer']; ?>">
    </div>
  </div>
  <br>
  <button class="btn btn-success btn-lg" name="loginBtn" style="position: relative; left:420px;">Apply</button>
</div>

</form>

<?php
			if(isset($_POST['title']))
			{
				$job=$_POST['title'];
				$mail=$_POST['email'];
				$emp=$_POST['employer'];
				
				$req="SELECT id FROM student_applications WHERE job_title='$job' AND email='$mail'";
				$verify=mysqli_query($conn,$req);//to ensure user applies only once 
				if(mysqli_num_rows($verify)==0)
				{
			$p="INSERT INTO student_applications(name,email,employer,job_title)VALUES
			('".mysqli_real_escape_string($conn,$_POST['name'])."',
			'".mysqli_real_escape_string($conn,$_POST['email'])."',
			'" . mysqli_real_escape_string($conn,$emp)."',
			'" . mysqli_real_escape_string($conn,$_POST['title'])."')";
			$qu=mysqli_query($conn,$p); 			
		if($qu)
		{
			 echo "<script>alert('Applied');</script>";
		}
		else
		{
			echo 'Fill all fields';//to stop submitting of empt fields on each refresh 
		
			
		}
			}
			
			else
			{
				echo "<script>alert('You could only apply once!');</script>";
			}
			}
	
	
		
		?>
			
</body>
</html>