<?php
include("db.php");
include("header.php");
session_start();
       $i=$_SESSION["id"];
if(!isset($i))header("Location:logout.php");
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

?>


<div class="panel panel-default">
<div class="panel-heading">
<a class="btn btn-success" href="home.php">Home</a>
<a class="btn btn-info pull-right" href="viewall.php">Back</a>

<!--date_default_timezone_set("Asia/Kolkata");-->
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
if($a=="elec")
$result=mysqli_query($con,"select a.id,a.name,a.usn,e.status from attendance a,".$a." e,teacher t where a.id=e.id and t.tid=$i and t.scode=e.pid and adate='$_POST[adate]'");
else
$result=mysqli_query($con,"select a.id,name,usn,status from attendance a,".$a." e where a.id=e.id and adate='$_POST[adate]'");
$count=0;
while($row=mysqli_fetch_array($result))
{
?>
<tr>
<td><?php echo $row['id']?></td>
<td><?php echo $row['name']?></td>
<td><?php echo $row['usn']?></td>
<td><?php echo $row['status']?></td>
<!--<td>
	<input type="radio" name="status[<?php echo $count; ?>]" value="Present">PRESENT
	<input type="radio" name="status[<?php echo $count; ?>]" value="Absent">ABSENT
</td>-->
</tr>
<?php 
$count++;
} ?>

</table>
<a class="btn btn-info pull-right" href="logout.php">Logout</a>
</div>
	</div>