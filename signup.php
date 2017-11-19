<?php
include("header.php");
include ("db.php");

	
	
$flag=0;
	if(isset($_POST["submit"])) 
	{	
		$pe=$_POST["sel"];
		$fname=$_POST["fname"];
		$lname=$_POST["lname"];
		$name=$fname." ".$lname;
	$id=$_POST["id"];
	$email=$_POST["txtemail"];
	$pass=$_POST["txtpass"];
	$repass=$_POST["retxtpass"];

	if($pass!=$repass){header("Location:signup.php");}

	else $query=mysqli_query($con,"INSERT INTO attendance (name,usn,email,pass,pe) VALUES('$name','$id','$email','$pass',$pe)");
		
		if($query)$flag=1;
		
				
}
		
	

		

?>


<!DOCTYPE html>
<html>
<head>
	<title>SAD | SignUp</title>

	<style>



#hover-shadow:hover {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
}
#pass1:hover {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
}
#pass2:hover {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
}

</style>
</head>



<body>

<!--
	<form method="post" action="signup.php">
		<input type="radio" name="user" value="1" checked> Student
		<input type="radio" name="user" value="0"> Teacher<br>
		<input type="submit" name="submit">
	</form>
-->


		

<?php if($flag){?>
<div class="alert alert-success">
<strong>Success!</strong>Attendance Data Successfully Added.
</div>
<?php } ?>

<div class="panel panel-default"
style="margin: auto;
    width: 50%;
    height:88.6%;
    border: 3px solid green;
    padding: 10px;">

<div class="panel-heading" style="padding-left:87%;">
<a class="btn btn-success" href="login.php">LOGIN</a>

</div>

<div class="panel-body" style="">

<form action="" method="post">
<div class="form-group">
<label for="id">Enter USN</label>
<input id="hover-shadow" type="text" name="id" maxlength="10" minlength="10" placeholder="Enter your USN!" class="form-control" required >
</div>

<div class="form-group">
<label for="id">Enter First Name</label>
<input id="hover-shadow" type="text" name="fname" required placeholder="Eg:Jon" class="form-control">
</div>

<div class="form-group">
<label for="id">Enter Last Name</label>
<input id="hover-shadow" type="text" name="lname" required placeholder="Eg:Snow" class="form-control">
</div>

<div class="form-group">
<label for="id">Enter Email</label>
<input id="hover-shadow" type="email" name="txtemail"  placeholder="Eg: example@random.com" class="form-control">
</div>

<div class="form-group">
<label for="id">Enter Password</label>
<input id="pass1" type="password" maxlength="8" name="txtpass" required placeholder="Enter a 8 character password." class="form-control">
</div>

<div class="form-group">
<label for="id">Re-enter Password</label>
<input id="pass2" type="password" maxlength="8" name="retxtpass" required placeholder="Retype your password." class="form-control">
</div>


<div class="form-group">
<label for="sel">PE</label>
<select class="form-control" name="sel">
  <option value="1">Web Technology</option>
  <option value="2">OpenGL</option>
  <option value="3">Embedded System</option>
  <option value="4">UNIX</option>
  <option value="5">OOMD</option>
</select>
</div>


<div class="form-group">
<br>
<input type="submit" name="submit" value="Register" class="btn btn-primary" onclick="myFunction()">
&nbsp&nbsp<input type="checkbox" checked="checked" >Remember me
</div>
</form>

</div>
	
  </div>
  <script>
  	 function myFunction() {
        var pass1 = document.getElementById("pass1").value;
        var pass2 = document.getElementById("pass2").value;
        if (pass1!=(pass2)) {
            alert("Passwords Do not match");
            }
      
        
    }

  </script>>
	</body>
</html>