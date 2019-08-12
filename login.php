<?php
ob_start();
include 'connect.php';
$type = mysqli_real_escape_string($con, $_POST["type"]);
$name = mysqli_real_escape_string($con, $_POST["name"]);
$pass = mysqli_real_escape_string($con, $_POST["pass"]);

if ($type === "student") {
		# code...
		$query = "SELECT * FROM student WHERE username='$name' AND password='$pass'";
		
		$result = mysqli_query($con, $query);
		if (mysqli_num_rows($result) == 1) {
			# code...
			$row = $result->fetch_assoc();

			$_SESSION["username"]=$row["username"];
			$_SESSION["Name"]=$row["name"];
			$_SESSION["cc"]=$row["cc"];
			$_SESSION["att"]=$row["att"];
		 	$_SESSION["parId"]=$row["pid"];
		 
			header('Location: profile.php');			
			die();
		
			?>
			
<!--			<script type="text/javascript">
				
				window.location.href="profile.php";
			</script>
-->
		<?php
		}

		else {
			# code...
			$url = 'https://cryptic-refuge-22303.herokuapp.com/getDetail';
			$data = array('userType' => $_POST['type'], 'user' => $_POST['name'],'pass' => $_POST['pass']);
			// use key 'http' even if you send the request to https://...
			$options = array(
			    'http' => array(
			        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			        'method'  => 'POST',
			        'content' => http_build_query($data)
			    )
			);
			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			$arr = json_decode($result, true);
			
			if ($result === FALSE || $arr["name"]=="") { 

				//echo "error";
			 }

			 //echo $arr["name"];  
			 //echo $arr["at"];  
			 //echo $arr["par"];   
			 //echo $arr["parId"];  
			 $n=$arr['name'];
			 $att=$arr['at'];
			 $cc=$arr['cc'];
			 $parId=$arr['parId'];
			 $par=$arr['par'];
			 									 			 
			 $sql="insert into student(username,name,att,cc,password,pid) values('$name','$n','$att','$cc','$pass','$parId')";
			 
			 if(mysqli_query($con,$sql))
			 {
			 	//echo "done";
			 }
			 else
			 {
			 	//echo mysqli_error($con);
			 	die();
			 }

			 $_SESSION["username"]=$name;
			 $_SESSION["Name"]=$n;
			 $_SESSION["cc"]=$cc;
			 $_SESSION["att"]=$att;
			 $_SESSION["parId"]=$parId;
			 
			 header('Location: profile.php');
			 die();
		}

	}
	


	else if ($type === "parent") {
		# code...
		
			# code...
			$url = 'https://cryptic-refuge-22303.herokuapp.com/getDetail';
			$parId=$_POST['name'];
			$data = array('userType' => $_POST['type'], 'user' => $_POST['name'],'pass' => $_POST['pass']);
			// use key 'http' even if you send the request to https://...
			$options = array(
			    'http' => array(
			        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			        'method'  => 'POST',
			        'content' => http_build_query($data)
			    )
			);
			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			$arr = json_decode($result, true);
			
			if ($result === FALSE || $arr["parname"]=="") { 

				//echo "error";
			 }

			 //echo $arr["name"];  
			 //echo $arr["at"];  
			 //echo $arr["par"];   
			 //echo $arr["parId"];  
			 $n=$arr['parentname'];
			 $_SESSION["parId"]=$parId;
			 $_SESSION["parname"]=$n;
			 


			 header('Location: parent.php');
			 die();

	}

	elseif ($type === "Faculty") {
		# code...
		$query = "SELECT * FROM `Staff` WHERE EmpID='".$name."' AND Password='".$pass."'";
		$result = mysqli_query($t, $query);
		if (mysqli_num_rows($result) !== 0) {
			# code...
			$row = $result->fetch_assoc();
			if ($row["Designation"] === "1" || $row["Designation"] === "2") {
				# code...
				echo "Head";
			}
			else {
				echo "Faculty";
			}
			$_SESSION["EmpID"]=$row["EmpID"];
			$_SESSION["Name"]=$row["Name"];
			$_SESSION["Designation"]=$row["Designation"];
			$_SESSION["cc_of"]=$row["cc_of"];
			$_SESSION["mentor_of"]=$row["mentor_of"];
			$_SESSION["HintQ"]=$row["HintQ"];
			$_SESSION["Answer"]=$row["Answer"];
		}
		else {
			# code...
			echo "Failed";
		}

	}	
?>