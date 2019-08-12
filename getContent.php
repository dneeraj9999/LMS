<!DOCTYPE html>
<html>
<head>
	<title></title>
<link rel="stylesheet" href="dist/bootstrap.min.css">
<!-- 	<link rel="stylesheet" href="dist/theme.css">
 -->		
<!-- 	 <link rel="stylesheet" type="text/css" href="dist/jquery-ui.min.css">
 -->
<!-- 	<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
 -->
</head>
<body>
		<?php 
			include 'connect.php';
			$id= $_GET['id'];
			$sql="select * from application where aid='$id'";
			$result=mysqli_query($con,$sql);
			$row=mysqli_fetch_assoc($result);

		 ?>	
      <!-- <div class="row">
        <form class="col s12" action="insertapplication.php" method="post">
          <div class="row modal-form-row">
            <div class="input-field col s12">
              <input id="image_url" type="text" class="validate">
              <label for="image_url">Image URL</label>
            </div>
          </div>
          <div class="row">
            <label for="name">Name of the student</label>
            <div class="input-field col s12">
              <input value="<?php echo $row['username'] ?>"  readonly="true" id="image_title" type="text">
            </div>
          </div>
      
          <div class="row">
      
          <div class="input-field col s12">
             <label for="image_title">Roll Number</label>
      			 <input id="image_title" type="number" value="<?php echo $row['roll']; ?>" name="roll">
            </div>
          </div>
          
          <div class="row">
              <label for="image_title">Start Date</label>
            <div class="input-field col s12">
              <input type="text" class="datepicker" value="<?php echo $row['sd']; ?>" name="sd">
            </div>
          </div>
          <div class="row">
                        <label for="image_title">End Date</label>
      
            <div class="input-field col s12">
              <input type="text" class="datepicker" value="<?php echo $row['ed']; ?>" name="ed">
            </div>
          </div>
          
          <div class="row">
                        <label for="reasons">Reasons for leave</label>
      
            <div class="input-field col s12">
              <textarea id="reasons" name="reason" type="text" value="<?php echo $row['reason']; ?>" class="materialize-textarea"></textarea>
            </div>
          </div>             
           <button class=" modal-action modal-close waves-effect waves-green btn-flat btn btn-primary"  type="button" name="submit">Approve</button>
         <button class=" modal-action modal-close waves-effect waves-green btn-flat btn btn-primary"  type="submit" name="button">Disapprove</button>
        
        </form>
      </div>
          </div>
       -->

  <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Name:</label>
            <input type="text" class="form-control" value="<?php echo $row['username']; ?>" id="recipient-name" readonly>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Roll no:</label>
             <input type="text" class="form-control" value="<?php echo $row['roll']; ?>" id="roll" readonly/>         
             </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Start Date:</label>
            <input type="text" class="form-control" value="<?php echo $row['sd']; ?>" id="sd" readonly>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">End Date:</label>
            <input type="text" class="form-control" value="<?php echo $row['ed']; ?>" id="ed" readonly>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Reasons for Leave:</label>
            <input type="text" class="form-control" value="<?php echo $row['reason']; ?>" id="reason" readonly>
          </div>
          <button type="button" id="approve" value="<?php echo $row['aid'].",".$_SESSION['parId']; ?>" class="btn btn-primary">Approve</button>
        <button type="button" id="disapprove" value="<?php echo $row['aid'].",".$_SESSION['parId']; ?>"class="btn btn-secondary">Disapprove</button>
      
      </form>
		
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="dist/jquery-ui.min.js"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		<script src="dist/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/index.js"></script>
		<script src="assets/js/common.js"></script>

		<script type="text/javascript">
			$("#approve").click(function(){

			  var x=$(this).val().split(",");

			  var jsonString={ aid : x[0], sid : x[1]};	
			  $.ajax(
			  	{
			  		type: "POST",
        			data: jsonString,
			  		url: "changestatus.php", 
			  		success: function(result){
					alert(result);
				 }});
			});
		
			$("#disapprove").click(function(){
			  var x=$(this).val().split(",");

			  var jsonString={ aid : x[0], sid : x[1]};	
			  $.ajax(
			  	{
			  		type: "POST",
        			data: jsonString,
			  		url: "changestatusdis.php", 
			  		success: function(result){
					alert(result);
				 }});
			});			
		</script>
</body>
</html>