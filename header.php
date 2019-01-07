<?php 

session_start();
 ?>
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
                        
					               <?php
						if(isset($_SESSION['signed_in']))//isset solves undefined session problem
		{
			
			if($_SESSION['user_level']==1)
			{
				echo'<li class="nav-item" role="presentation"><a class="nav-link" href="emp.php">Post a job!</a></li>';
			}
			else
		{
			echo'<li class="nav-item" role="presentation"><a class="nav-link" href="signin.php">Hire!</a></li>';
		}
		}
		
						
		?>	
					
                    
					
					
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