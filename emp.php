<?php 

session_start();
include_once('dbconnect.php');

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
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav mr-auto">
                        
						<li class="nav-item" role="presentation"><a class="nav-link active" href="https://google.com">About Us</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="signin.php">Hire!</a></li>
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
 
 
<body>
<?php 
include('dbconnect.php');
	$usname=$_SESSION['user_name'];
	$query="SELECT * FROM internships WHERE employer='$usname'";
	$result=mysqli_query($conn,$query);
		
?>

  </div><!-- /.container-fluid -->
</nav>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-4">
		<h2 class="text-center"><strong>Add another internship </strong></h2>
			<form role="form" action="" method="POST">
			<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
			<div class="form-group">
					<label>Employer: </label>
					<input type="text" name="employer" class="form-control" value="<?php echo $usname ?>">
				</div>
				<div class="form-group">
					<label>Title: </label>
					<input type="text" name="title" class="form-control" value="-">
				</div>
				<div class="form-group">
					<label>Description: </label>
					<input type="text" name="description" class="form-control">
				</div>
				<div class="form-group">
					<label>Stipend: </label>
					<input type="text" name="stipend" class="form-control">
				</div>
				<div class="form-group">
					<label>Start Date: </label>
					<input type="text" name="start_date" placeholder="YYYY-MM-DD" class="form-control datepicker">
				</div>
				<div class="form-group">
					<label>End Date: </label>
					<input type="text" name="end_date" placeholder="YYYY-MM-DD" class="form-control datepicker">
				</div>
				<button type="submit" name="loginBtn" class="btn btn-primary btn-block">Add Internship</button>
			
			
			<?php
			if(isset($_POST['title']))
			{
			$p="INSERT INTO internships(employer,title,description,stipend,start_date,end_date)VALUES
		('".mysqli_real_escape_string($conn,$usname)."',
		'".mysqli_real_escape_string($conn,$_POST['title'])."',
		'" . mysqli_real_escape_string($conn,$_POST['description'])."',
		'" . mysqli_real_escape_string($conn,$_POST['stipend'])."',
		'" . mysqli_real_escape_string($conn,$_POST['start_date'])."',
		'" . mysqli_real_escape_string($conn,$_POST['end_date'])."')";
			
	$qu=mysqli_query($conn,$p); 			
	if($qu)
		{
			 echo "<script>alert('Internship added');</script>";
		}
	
			}
			else
			{
				echo 'Fill all fields';//to stop submitting of empt fields on each refresh 
		
			
			}
	
		
		?>
		</div>
		<div class="col-sm-4">
		<h2 class="text-center"><strong>Internships posted </strong></h2><br>
			<?php
	while($row=mysqli_fetch_assoc($result)){

 ?>
	<div class="well bg-info">

		<h4><strong>Employer: </strong><?php echo $row['employer']; ?></h4>
		<h4><strong>Title: </strong><?php echo $row['title']; ?></h4>
		<p><strong>Description: </strong><?php echo $row['description']; ?></p>
		<p><strong>Stipend: Rs. </strong><?php echo $row['stipend']; ?></p>
		<p><strong>Start Date: </strong><?php echo $row['start_date']; ?></p>
		<p><strong>End Date: </strong><?php echo $row['end_date']; ?></p>		

	</div>
	<?php 
	}
	?>
		</div>
		<div class="col-sm-4">
			<h2 class="text-center"><strong>Received Applications </strong></h2>
			<table class="table table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Title</th>
						</tr>
					</thead>
					<tbody>
					<?php 
				
					$call="SELECT * FROM student_applications WHERE employer='$usname'";
					$received=mysqli_query($conn,$call);

					while($rowz=mysqli_fetch_assoc($received)){

					 ?>
					 <tr>
					 	<td><?php echo $rowz['name']; ?></td>
					 	<td><?php echo $rowz['email']; ?></td>
					 	<td><?php echo $rowz['job_title']; ?></td>
					</tr>
					<?php } ?>
					</tbody>
					</table>

		</div>
		</div>
	</div>
</body>
<?php// mysqli_close($conn); ?>
</html>