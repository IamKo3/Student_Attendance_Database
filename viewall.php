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
<a class="btn btn-info pull-right" href="home.php">Back</a>

<div class="panel-body">
<table class="table table-striped">
<tr>
<th>Serial Number</th>
<th>Dates</th>
</tr>

<?php 

$result=mysqli_query($con,"select distinct adate from ".$a);
$sn=0;

while($row=mysqli_fetch_array($result))
{
	$sn++;
?>

<tr>
<td><?php echo $sn?></td>
<td><?php echo $row['adate']?></td>


<td>
<form action="show.php" method=post>
<input type="hidden" value="<?php echo $row['adate']?>" name="adate">
<input type="submit" value="Show Attendance" class="btn btn-primary">
</form>	
</td>
</tr>
<?php 

} ?>


</table>
<a class="btn btn-info pull-right" href="logout.php">Logout</a>
</div>
	</div>