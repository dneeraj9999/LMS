<?php 

include 'connect.php';

if(isset($_POST['submit']))
{

	$username=$_SESSION['username'];
	$cc=$_SESSION['cc'];

	$roll=$_POST['roll'];
	$sd=$_POST['sd'];
	$ed=$_POST['ed'];
	$reason=$_POST['reason'];
	$parId=$_SESSION["parId"];

	$unique=mysqli_query($con,"SELECT random_num FROM ( SELECT FLOOR(RAND() * 99999) AS random_num) AS numbers_mst_plus_1 WHERE random_num NOT IN (SELECT aid FROM application WHERE aid IS NOT NULL) LIMIT 1");

	$row=mysqli_fetch_assoc($unique);
	$rand=$row['random_num'];
	
	$sql="insert into application values ('$rand','$username','$sd','$ed','$reason',1,'$roll')";

	if(mysqli_query($con,$sql))
	{
	

	foreach($_POST['signatory'] as $selected)
	{
		if($selected=="parent")
		{
		$query="insert into signatory values('$parId','$rand',1)";
		mysqli_query($con,$query);

		}
		else if ($selected=="cc") {

			$query="insert into signatory values('$cc','$rand',1)";
			mysqli_query($con,$query);

		}
		else if ($selected=="hod") {
			$id="";
			if((preg_match("/C2K[0-9]+/",$row['username'])) {
				$id=2;
			}
			if((preg_match("/I2K[0-9]+/",$row['username'])) {
				$id=3;
			}
			if((preg_match("/E2K[0-9]+/",$row['username'])) {
				$id=4;
			}
			$query="insert into signatory values($id,'$rand',1)";
			mysqli_query($con,$query);

		}
		else if ($selected=="principal") {

			$query="insert into signatory values(1,'$rand',1)";
			mysqli_query($con,$query);

		}

	//	echo "<script>console.log(".$selected.");</script>";
	}
	
	header('Location:profile.php');
	}
	else
	{
		echo "insert error";
	}



}


?>
