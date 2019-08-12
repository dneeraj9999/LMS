<?php 
include 'connect.php';
$aid= $_POST['aid'];
$pid = $_POST['sid'];

$sql = "update signatory set status=2 where aid='$aid' and sid='$pid'";
$result=mysqli_query($con,$sql);
if($result) {
	echo "Application Approved";
}
else
 echo "Error".mysqli_error($con);

 ?>