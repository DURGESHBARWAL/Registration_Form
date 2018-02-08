<!DOCTYPE html>
<html>
<html lang="en">
<head>
  <title>Task 1</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
  <style> 
   body {background-color: #F5DEB3;}
   </style>
</head>
<body>

<?php
				//Varible declaration and set then to empty
				$firstname = $state = $skill = $firstnameerr = $stateerr = $skillerr = "";
				
					
			if($_SERVER["REQUEST_METHOD"]=="POST"){
				
				  //simple input
					$firstname=test_input($_POST["fullname"]);
					if (!preg_match("/^[a-zA-Z ]*$/",$firstname))
					    $firstnameerr = "Only letters and white space allowed in Full Name"; 
					          
						
				//checkbox handling1

					if(empty($_POST["skill"]))
					{
						$skillerr="U didn't selected any skills";
					}
					else{
						$skill=$_POST["skill"];
					}
				//dropdown
				
					if(empty($_POST["state"])||$_POST["state"]=="Select Your State:"){
							$stateerr="Select State ";
						}else{
							$state=$_POST["state"];
						}
					
	
				//checking the error
				
				if($firstnameerr =="" && $skillerr =="" && $stateerr=="")
				    {
						 
						 include 'task1_config.php';

						$sql = "INSERT INTO info(name,state) 
						VALUES ('$firstname','$state')";
							
	
							
							for ($x=0; $x<sizeof($skill); $x++)
								{
									$sql1 = "INSERT INTO skills(name, skill) 
									VALUES ('$firstname','" . $skill[$x] . "')"; 
									 if($conn->query($sql1)===TRUE){continue;}
								}
							
						if ($conn->query($sql) === TRUE) {
	       						  echo '<div class="card bg-success text-white">';
								  echo '<div class="card-body"><center>New record created successfully</center></div>';
								  echo '</div>';
							
				
						} else {
							      echo '<div class="card bg-danger text-white">';
								  echo '<div class="card-body">Connection Error </div>';
								  echo '</div>';
						}
							$conn->close();	
					}
					
				}
			
			function test_input($data){
				$data=trim($data);
				$data=stripslashes($data);
				$data=htmlspecialchars($data);
				return $data;
			}
			
				
?>
<br>
<br>
<div class="container col-md-offset-5">
<div class="card bg-light text-dark">
  <div class="card-body">
  <h2><Center>Registration Window</center></h2>
  <p><b>Note:</b> All fields are mandatory.</p>

<form name="form1"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   
    <div class="form-group">
			<label for="usr"> Full Name :</label>
			<input type="text" name="fullname" placeholder="Enter your full name" class="form-control" id="usr" required="required">
	    <span class="error"><?php 
		if($firstnameerr!=""){
		echo '<div class="card bg-danger text-white">';
		
        echo  '<div class="card-body">';
		echo $firstnameerr;
		echo '</div>';
		echo '</div>';
		}
		?></span>

	
	</div>

	<div class="form-group">
	<label>Select the skills you have (Select atleast one skill) : </label>
	
	
		<div class="form-check">
			<label class="form-check-label">
				<input type="checkbox" name="skill[]" class="form-check-input" value="SQL">SQL
			</label>
		</div>
		<div class="form-check">
			<label class="form-check-label">
				<input type="checkbox" name="skill[]" class="form-check-input" value="PHP">PHP
			</label>
		</div>
		<div class="form-check">
			<label class="form-check-label">
				<input type="checkbox" name="skill[]" class="form-check-input" value="Boostrap">Bootstrap
			</label>
		</div>
		<span class="error"><?php 
		if($skillerr!=""){
		echo '<div class="card bg-danger text-white">';
		
        echo  '<div class="card-body">';
		echo $skillerr;
		echo '</div>';
		echo '</div>';
		}
		?></span>

	</div>
	
	
	<div class="form-group">
      <label for="sel1">State:</label> 
      <select class="form-control" name="state" id="sel1" required="required">
        <option selected="selected" >Select Your State: </option>
		<option value="M.P.">M.P.</option>
        <option value="U.P.">U.P.</option>
        <option value="Rajasthan">Rajasthan</option>
      </select>
      <br>
	  <span class="error"><?php 
		if($stateerr!=""){
		echo '<div class="card bg-danger text-white">';
		
        echo  '<div class="card-body">';
		echo $stateerr;
		echo '</div>';
		echo '</div>';
		}
		?></span>

    </div>
	<center><button type="submit" class="btn btn-dark">Submit</button></center>
  </form>
</div>
</div>
</div>

</body>
</html>