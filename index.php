<?php 
include('header.php')
?>
    <div id="promo">
        <div class="jumbotron">
            <h1>How it works?</h1>
            <p><strong><span style="text-decoration: underline;">Search the internships below and apply for the ones you like &nbsp;!</span></strong><br></p>
            <p><a class="btn btn-primary" role="button" href="#">Learn more</a></p>
        </div>
    </div>
    <div class="container">
        <h1>Availabe Internships:</h1>
        <div id="intern">
		
<?php
           
			
			$sql="SELECT id,employer,title,description,stipend,start_date,end_date FROM internships";
$result=mysqli_query($conn,$sql);
$rows=mysqli_num_rows($result);
if(!$result)
{
	echo'Interships could not be displayed';
}
else
{
	if(mysqli_num_rows($result)==0)
	{
		echo'No internships available  yet';
	}
	else
	{
		echo'<table border="1">
		<tr style="text-align:center;">
	
		</tr>';
		  while($row = mysqli_fetch_assoc($result))
        {   
		?>
 
  <h4><strong>Employer: </strong><?php echo $row['employer']; ?></h4>
		<h4><strong>Title: </strong><?php echo $row['title']; ?></h4>
		<p><strong>Description: </strong><?php echo $row['description']; ?></p>
		<p><strong>Stipend: Rs. </strong><?php echo $row['stipend']; ?></p>
    <p><strong>Start Date: </strong><?php echo $row['start_date']; ?></p>
    <p><strong>End Date: </strong><?php echo $row['end_date']; ?></p>
	<?php 
	if(isset($_SESSION['user_name']))
	{	
		if(($_SESSION['user_level']==0))
		{
		echo'<a role="button" href="student.php" class="btn btn-block btn-success">Apply</a>';
		}
		else
	{
		echo'<p class="btn btn-block btn-success">Only students can apply</p>';
	}
	}
		else
			
		{
			echo'<a role="button" href="signin.php" class="btn btn-block btn-success">Apply</a>';
			
		}
	}
	
	?>
       <?php 
	   }
			
			
		}
		
	

?>
			
		
			
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>