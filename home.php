<?php
include("db.php");
include("header.php");
$flag=0;

session_start();
$i=$_SESSION["id"];
if(!isset($i))header("Location:logout.php");
$name=mysqli_fetch_array(mysqli_query($con,"select name from teacher where tid='$i'"));
if($i==1221)
		$a="att1";
		if($i==1222)
		$a="dbms";
	    if($i==1223)
		$a="cn";
		if($i==1224)
		$a="cns";
		if($i==1225)
		$a="flat";
		if($i==1226||$i==1227||$i==1228||$i==1229||$i==1230)
		$a="elec";
$row=mysqli_fetch_array(mysqli_query($con,"select scode from teacher where tid=$i"));
if(isset($_POST['submit']))
{
	$date=date("Y-m-d");
	$rec=mysqli_query($con,"select * from ".$a." where adate='$date'");
	$n=mysqli_num_rows($rec);
	
if($n)
{
foreach ($_POST['status'] as $key=>$status) 
	{
		$id=$_POST['id'][$key];
		$date=date("Y-m-d");
		
		
		
		if($a!="elec")
		$result=mysqli_query($con,"update ".$a." set status='$status',adate='$date' where adate='$date'");
		else
		{
		
		$result=mysqli_query($con,"update elec set status='$status',adate='$date' where adate='$date' and pid='$row[scode]'");
		}
		if($result)$flag=2;	
	
	}
}

else
{
	foreach ($_POST['status'] as $key=>$status) 
	{
		$id=$_POST['id'][$key];
		$date=date("Y-m-d");
		
		
		
		if($a!="elec")
		$result=mysqli_query($con,"insert into ".$a."(id,status,adate)values('$id','$status','$date')");
		else
		{
		
		$result=mysqli_query($con,"insert into ".$a."(id,pid,status,adate)values('$id','$row[scode]','$status','$date')");
		}
		if($result)$flag=1;	
	
	}
}
	
}
?>


<div class="panel panel-default">
<div class="panel-heading">
<a class="btn btn-success" href="home.php">Home</a>
<a class="btn btn-info pull-right" href="viewall.php">View All</a>

<?php if($flag==1){?>
<div class="alert alert-success">
<strong>Success!</strong>
</div>

<?php } ?>

<?php if($flag==2){?>
<div class="alert alert-success">
<strong>Updated!</strong>
</div>

<?php } ?>

<!--date_default_timezone_set("Asia/Kolkata");-->
<h2><div class="well text-center"><?php echo $name['name']?></div></h2><br>
<h3><div class="well text-center">Date:<?php echo date("d-m-Y");?></div></h3>
<div class="panel-body">
<form action="home.php" method="post">
<table class="table table-striped">
<tr>
<th>Serial Number</th>
<th>Student Name</th>
<th>USN</th>
<th>Attendance</th>
</tr>
<?php 
if($a!="elec")
$result=mysqli_query($con,"select * from attendance");
else
{
	$row=mysqli_fetch_array(mysqli_query($con,"select scode from teacher where tid=$i"));
	$result=mysqli_query($con,"select * from attendance where pe=$row[scode]");
}
$count=0;
while($row=mysqli_fetch_array($result))
{
?>
<tr>
<td><?php echo $row['id']?>
	<input type="hidden" value="<?php echo $row['id']?>"  name="id[]">
</td>
<td><?php echo $row['name']?></td>
<td><?php echo $row['usn']?></td>
<td>
	<input type="radio" name="status[<?php echo $count; ?>]" value="Present">PRESENT
	<input type="radio" name="status[<?php echo $count; ?>]" value="Absent">ABSENT
</td>
</tr>
<?php 
$count++;
} ?>

</table>
<input type="submit" name="submit" value="Submit" class="btn btn-primary">
</form>
<a class="btn btn-info pull-right" href="logout.php">Logout</a>
</div>

	</div>