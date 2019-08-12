<?php 

include 'connect.php';


?>
<!DOCTYPE html>
<html>
<head>
	<title>PICT|LMS</title>
	<link rel="shortcut icon" href="assets/images/favicon.png">
	<link rel="stylesheet" href="dist/bootstrap.min.css">
<!-- 	<link rel="stylesheet" type="text/css" href="css/style.css">
 -->	
<!--  <link rel="stylesheet" type="text/css" href="dist/jquery-ui.min.css">
 --><!-- 	<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
 --></head>
<body>
	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-light bg-dark">
		<div class="row">		
		<a class="navbar-brand" id="navbar-title">
			<img src="assets/images/favicon.png" width="30" height="30" alt="P Favicon">
			PICT Leave Management System / Faculty
		</a>
		<a href="logout.php" style="text-decoration:none;position:absolute;right:10px;top:20px;color:white;">Logout</a> 

		</div>

	</nav>
	<!-- End Navbar -->

	<div class="row">
		<div class="col-12 col-md-3" style="height: 90vh">
			<div class="card" style="height:100%">
				<div class="card-header">
					Profile
				</div>
				<div class="card-body">
				<center>
					<img class ="card-img-top" src="assets/images/pict.png" alt="PICT logo" id="pict-logo" style="width:200px;height:200px;">
					<center><p><h3><?php echo $_SESSION["parId"]; ?></h3>
						<h4>Name: <br><?php echo $_SESSION["parname"];?></h4>
						</p>
					</center>
				</center>
				</div>
				<div class="card-footer text-muted">
				</div>
			</div>
		</div>
		<div class="col-12 col-md-9">
			<div class="card">
				<div class="card-header text-center">
					Work-area
				</div>
				<div class="card-body">
				<h2 class="titles">Applications for Approval</h2>
				<?php
						$pid=$_SESSION["parId"];
						$select = "SELECT * from signatory s inner join application a on s.aid=a.aid where s.sid='$pid'";
						$result=mysqli_query($con,$select);
						$i = 1;
						if (mysqli_num_rows($result) > 0) {
							?>

							<table class='table'>
							  <thead class='thead-dark'>
							    <tr>
							      <th scope='col'>#</th>
							      <th scope='col'>Application ID</th>
							      <th scope='col'>Student ID</th>
							      <th scope='col'>Action</th>
							    </tr>
							  </thead>
							  <tbody>

							  <?php
							  $i = 1;
							  while ($row = $result->fetch_assoc()) {
								  	echo "<tr>
									      <td scope='row'>".$i."</td>
									      <td>".$row['aid']."</td>
									      <td>".$row['username']."</td>
									     ";
										  $i++;
							  ?>

		<td><button class="btn btn-success view" value="<?php echo $row['aid']; ?>">View</button></td>
					</tr>

						<?php	  
						}						
						echo "</tbody></table>";
					
						}
						else{
							echo "<p>There are no applications.</p>";
						}
					?>
					<div class="card-footer text-muted">
					</div>
				</div>
			</div>
		</div>

<!-- <div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Leave Application</h4>

</div>
 -->

<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
      
      <div class="modal-footer">
        </div>
    </div>
  </div>
</div>


		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="dist/jquery-ui.min.js"></script>
		<script type="text/javascript">
			$("#dt").datepicker();
			// $("#addDay").click(function(){
			// 	var d = $("#dt").val();
			// 	var dtype = $("#dtype").val();
			// 	if (d !== "" && dtype !=="") {
			// 		$("#dol").html() = $("#dol").html() + d + "- " + dtype + "<br>";
			// 	}
			// 	else
			// 	{
			// 		alert("Select date and time period");
			// 	}
			// });

			function view_app(row)
			{

					var aid=row.aid;

					console.log(aid);	

			}











		</script>

<!-- 		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
 -->		<script src="dist/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/index.js"></script>
		<script src="assets/js/common.js"></script>
		
		<script>
			$('.view').on('click',function(){
			    $('.modal-body').load('getContent.php?id='+$(this).val(),function(){
			        $('#modal1').modal({show:true});
			    });
			});

			
			
		</script>

	</body>
	</html>
