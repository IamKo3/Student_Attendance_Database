<?php include("header.php");
include("db.php");

$flag=0;
if(isset($_POST["submit"])) 
		{
	
	$id=$_POST["id"];
	$pass=$_POST["txtpass"];
	$type=$_POST["type"];


			if(!$type)
			{
		$query=mysqli_query($con,"SELECT tid,password,subject FROM teacher");
		while($row=mysqli_fetch_array($query)) 
		{

		$db_t_id=$row["tid"];
		$db_pass=$row["password"];
		$sub=$row["subject"];

		if($id==$db_t_id && $pass==$db_pass) 
		{
			session_start();
			$_SESSION["id"]=$db_t_id;
			$_SESSION["type"]=$type;
			header("Location:home.php?+$id");
		}
		else 
		{
			$flag=-1;
		}
		}
		}

		else
		{
			$query=mysqli_query($con,"SELECT usn,pass FROM attendance");
		while($row=mysqli_fetch_array($query)) 
		{

		$db_s_id=$row["usn"];
		$db_pass=$row["pass"];

		if($id==$db_s_id && $pass==$db_pass) 
		{
			session_start();
			$_SESSION["id"]=$db_s_id;
			$_SESSION["type"]=$type;
			header("Location:student_home.php?+$id");
		}
		else
			$flag=-1;
		
		}
		}

		}//isset

?>


<html>
<head>
	<title>SAD-Login</title>
</head>
<body>

<?php if($flag!=-1){ ?>
<div class="panel panel-default"
style=" margin: auto;
    width: 50%;
    height:49%;
    border: 3px solid green;
    padding: 10px;">
<?php } ?>

<?php if($flag==-1) { ?>
<div class="panel panel-default"
style=" margin: auto;
    width: 50%;
    height:57%;
    border: 3px solid green;
    padding: 10px;">
<?php } ?> 

<div class="panel-heading">
<a class="btn btn-success" href="signup.php">Register</a>

<?php if($flag){?>
<div class="alert alert-success">
<strong style="color:red">Wrong ID or Password!</strong>
</div>
<?php } ?>

</div>

<div class="panel-body" style="">


	<form method="post" action="" >
	<div class="form-group">
	<input type="radio" name="type" value="1" checked> <B>Student</B>
		</div>
		
		<div class="form-group">
		<input type="radio" name="type" value="0"> <B>Teacher</B> </div>
		<div class="form-group">
		<label for="id">Enter ID:</label>
		<input type="text" name="id" required class="form-control"></div>
		
		<div class="form-group">
		<label for="txtpass">Password:</label>
		<input type="password" name="txtpass" required class="form-control"></div>
		
		<div class="form-group" style="padding-left:45%;">
		<input type="submit" name="submit" value="LOGIN" class="btn btn-primary">
	</div>
</form>

</div>
	
  </div> 


















	</body>
</html>