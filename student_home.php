<?php
include("db.php");
include("header.php");
session_start();
       $i=$_SESSION["id"];
if(!isset($i))header("Location:logout.php");
$name=mysqli_fetch_array(mysqli_query($con,"select name from attendance where usn='$i'"));

?>


<div class="panel panel-default">
<div class="panel-heading">
<a class="btn btn-success" href="home.php">Home</a>
<a class="btn btn-info pull-right" href="viewall.php">Back</a>
<h2><div class="well text-center"><?php echo $name['name']."(".$i.")" ?></div></h2>
<!--date_default_timezone_set("Asia/Kolkata");-->
<div class="panel-body">
<form action="home.php" method="post">
<table class="table table-striped">
<tr>
<th>Serial Number</th>
<th>Subject Name</th>
<th>Classes Held</th>
<th>Present</th>
<th>Percentage</th>
</tr>
<?php 

$result=mysqli_query($con,"select t.subject from teacher t,attendance a where a.usn='$i' and (a.pe=t.scode or t.tid<1226)");
$count=0;
while($row=mysqli_fetch_array($result))
{
?>
<tr>
<?php 
if($row['subject']=='OS')
	$a="att1";
else if($row['subject']=='DBMS')
	$a="dbms";
else if($row['subject']=='CN')
	$a="cn";
else if($row['subject']=='CNS')
	$a="cns";
else if($row['subject']=='FLAT')
	$a="flat";
else 
	$a="elec";

if($a!="elec")
{
	$x=mysqli_query($con,"select count(distinct adate) as c from ".$a);
$classes=mysqli_fetch_array($x);
$y=mysqli_query($con,"select count(status) as p from ".$a." where id=(select id from attendance where usn='$i') and status='Present'");
$present=mysqli_fetch_array($y);
}
else
{
	$classes=mysqli_fetch_array(mysqli_query($con,"select count(distinct adate) as c from elec where pid = (select scode from teacher where subject='$row[subject]')"));
$present=mysqli_fetch_array(mysqli_query($con,"select count(status) as p from elec where id=(select id from attendance where usn='$i') and pid=(select scode from teacher where subject='$row[subject]') and status='Present'"));	
}

?>
<td><?php echo $count+1?></td>
<td><?php echo $row['subject']?></td>
<td><?php echo $classes['c']?></td>
<td><?php echo $present['p']?></td>
<td><?php echo (int)($present['p']*100/$classes['c'])."%" ?></td>
</tr>



<?php 
$count++;
} ?>

</table>
<a class="btn btn-info pull-right" href="logout.php">Logout</a>
</div>
	</div>