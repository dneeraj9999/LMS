<!DOCTYPE html>
<html>
<head>
	<title>PICT|LMS</title>
	<link rel="shortcut icon" href="assets/images/favicon.png">
	<link rel="stylesheet" href="dist/bootstrap.min.css">
	<link rel="stylesheet" href="dist/theme.css">
		
	 <link rel="stylesheet" type="text/css" href="dist/jquery-ui.min.css">
<!-- 	 <link rel="stylesheet" type="text/css" href="css/main.css">
			<link rel="stylesheet" type="text/css" href="css/new.css">
 -->
 <!--      <link rel="stylesheet" href="css/style2.css">
 -->	 
 	 <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> 
 	 	  --><link rel='stylesheet' href='css/materialize.min.css'>

     <link rel="stylesheet" href="css/style3.css">

	<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
</head>
<body>

	<?php
			
			include 'connect.php';

	?>

	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-light bg-dark">
		<div class="row">
			<a class="navbar-brand" id="navbar-title" href="" style="color: white;">
				<img src="assets/images/favicon.png" width="30" height="30" alt="P Favicon">
				PICT Leave Management System / Student
			</a>
			<a class="btn" href="logout.php" style="text-decoration:none;position:absolute;right:10px;top:20px;color:white;">Logout</a> 

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
					<center><p><h3><?php echo $_SESSION["Name"]; ?></h3>
						<h5>Student</h5></p>
						<p>ID: <?php echo $_SESSION["username"]; ?></p>
					</center>
				</center>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-9">
			<div class="card">
				<div class="card-header text-center">
					Work-area
				</div>
				<div class="card-body">
					<div class="row">
						<button class="btn btn-success">
						Your Class Co-ordinator is <?php echo $_SESSION["cc"];?>
						</button>
						</div>	
					</div>
					<br>
					<h2 class="titles">Application Status</h2>


					<?php
						$select = "SELECT * FROM application as sa JOIN `student` as s on s.username = sa.username where s.username='".$_SESSION["username"]."'";
						$result = mysqli_query($con, $select);
						if (mysqli_num_rows($result) > 0) {
							# code...
							echo "
							<table class='table'>
							  <thead class='thead-dark'>
							    <tr>
							      <th scope='col'>#</th>
							      <th scope='col'>Application ID</th>
							      <th scope='col'>Start date</th>
							      <th scope='col'>End date</th>
							      <th scope='col'>Status</th>
							      <th scope='col'>Generate PDF</th>
							    </tr>
							  </thead>
							  <tbody>";
							  $i = 1;
							  while ($row = $result->fetch_assoc()) {
							  	# code...
							  	echo "<tr>
								      <th scope='row'>".$i."</th>
								      <td>".$row['aid']."</td>
								      <td>".$row['sd']."</td>
								      <td>".$row['ed']."</td>
								      <td>".$row['status']."</td>
  								      ";
  								      $i++;



  								     ?> 
		
								<td><button class="btn btn-success" onclick='gen_pdf(<?php echo json_encode($row); ?>)'>Generate PDF</button></td>
								</tr>
					<?php
									  
							  }
							  echo "</tbody></table>";

						}
						else{
							echo "<p>There are no applications.</p>";
						}
					?>
						<!-- Button trigger modal -->
						<p>
					<button data-target="modal1" class="btn modal-trigger">Apply Now</button>
					</p>

						<!-- Modal -->
<div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Leave Application</h4>

      <div class="row">
        <form class="col s12" action="insertapplication.php" method="post">
          <!-- <div class="row modal-form-row">
            <div class="input-field col s12">
              <input id="image_url" type="text" class="validate">
              <label for="image_url">Image URL</label>
            </div>
          </div> -->
          <div class="row">
            <div class="input-field col s12">
              <input value="<?php echo $_SESSION['Name']; ?>"  readonly="true" id="image_title" type="text">
              <label for="name">Name of the student</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="image_title" type="number" name="roll">
              <label for="image_title">Roll Number</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input type="text" class="datepicker" name="sd">
              <label for="image_title">Start Date</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input type="text" class="datepicker" name="ed">
              <label for="image_title">End Date</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input  value="<?php echo $_SESSION['att']; ?>" name="pass" id="pass" readonly="true" type="text">
              <label for="pass">Attendance</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              Signatories
              <br><br>
              <p>
			<label>
                <input type="checkbox" name="signatory[]" value="cc" checked="checked" />
                <span>CC</span>
              </label>
            
            </p>

            <p>
              <label>
                <input type="checkbox" name="signatory[]" value="parent" />
                <span>Parent</span>
              </label>
              </p>
              <p>
              <label>
                <input type="checkbox" name="signatory[]" value="hod" />
                <span>HOD</span>
              </label>
              </p>
            <p>
              <label>
                <input type="checkbox" name="signatory[]" value="principal" />
                <span>Principal</span>
              </label>
              </p>

            </p>
            </div>
          </div>       
		  </table>	
          <div class="row">
            <div class="input-field col s12">
              <textarea id="reasons" name="reason" type="text" class="materialize-textarea"></textarea>
              <label for="reasons">Reasons for leave</label>
            </div>
          </div>             
           <button class=" modal-action modal-close waves-effect waves-green btn-flat btn btn-primary"  type="submit" name="submit">Submit</button>
  
        </form>
      </div>
    </div>
    <hr>
  <!--   <div class="modal-footer">
  </div>
     --></div>
		<script src="js/jspdf.min.js"></script>
		<script src="js/qrious.min.js"></script>
		<script src="js/jspdf.plugin.autotable.min.js"></script>

		<script type="text/javascript">
			
			function gen_pdf(id)
			{
				   var qr = new QRious({
  								value: 'localhost/lms-new/apps-urls?id='+id.aid
								  });
				      			
//				var app=JSON.parse(id);  
				 var qr = qr.toDataURL();
      			//var logo = 'data:image/jpeg;base64,'+ Base64.encode('../../assets/images/pict.png');

				var doc = new jsPDF();

				

				doc.setFontSize(20);
				doc.setFont("times");
				doc.addImage(qr, 'JPEG', 150, 250, 40, 40);
			//	doc.addImage(logo, 'JPEG', 15, 15, 40, 40);


				doc.text("PUNE INSTITUTE OF \nCOMPUTER TECHNOLOGY, Pune- 411043",60, 25);
				doc.setFontSize(18);
				doc.text("Application ID:"+id.aid,30, 75);
				doc.text("Reg. ID No:"+id.username,30, 90);
				doc.text("Name of the Student:"+id.name,30, 105);
				doc.text("RollNo: "+id['roll'],30, 120);
				doc.text("Attendance: "+id.att,30, 135);
				doc.text("Reasons for leave:"+id['reason'],30, 150);
				doc.text("Duration in dates: "+id['sd']+" to "+id['ed'],30, 165);
				
				//var options={pagesplit: true};
			    doc.autoTable({html: '#my-table',startY:190});

//			   	var fired_button = $(this).val();
//			   	console.log(fired_button);
/*
				 doc.autoTable({
				        head: [['Name', 'Email', 'Country']],
				        body: [
				            ['David', 'david@example.com', 'Sweden'],
				            ['Castille', 'castille@example.com', 'Norway']
				        ]
				    }, {
    startY: 60,
    styles: {
      overflow: 'linebreak',
      fontSize: 50,
      rowHeight: 60,
      columnWidth: 'wrap'
    },
    columnStyles: {
      1: {columnWidth: 'auto'}
    }
  });
	*/			    

				
				doc.output('dataurlnewwindow');
			}

		</script>
		<script type="text/javascript" src="js/index.js"></script>
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="dist/jquery-ui.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		<script src="dist/bootstrap.min.js"></script>
		  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>

		<script type="text/javascript">
			
			$("#datepicker-from").datepicker({

			beforeShowDay: $.datepicker.noWeekends,
			minDate: 0

		});

	$("#datepicker-to").datepicker({

		beforeShowDay: $.datepicker.noWeekends,
		maxDate: 6,
		minDate: 0

	});


		</script>
	</body>
	    <script  src="js/index1.js"></script>

	</html>