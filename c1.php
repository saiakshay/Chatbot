<!DOCTYPE html>
<html>
<title>CHATBOT</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", Arial, Helvetica, sans-serif}
</style>
<body class="w3-light-grey">

<!-- Navigation Bar -->
<div class="w3-bar w3-white w3-large">
<img src="https://cegepgim.koha.ccsr.qc.ca/opac-tmpl/bootstrap/images/cegeps/gaspe_img_logo_cegep.png" width="100%">
 </div>
<!-- Header -->
<header class="w3-display-container w3-content" style="max-width:1500px;">
  <img class="w3-image" src="https://images.radio-canada.ca/q_auto,w_1250/v1/ici-info/16x9/campus-cegep-gaspesie-montreal.JPG" alt="The Hotel" style="min-width:1000px" width="1500" height="800">
  <div class="w3-display-left w3-padding w3-col l6 m8">
    <div class="w3-container w3-red">
      <h2><i class="fa fa-drupal w3-margin-right"></i>Chatbot</h2>
    </div>
    <div class="w3-container w3-white w3-padding-16">
      <form action="c1.php" method ="post" target="_blank">
        <div class="w3-row-padding" style="margin:0 -16px;">
          <div class="w3-half w3-margin-bottom">
            <label><i class="fa fa-male"></i> User Name</label>
            <input class="w3-input w3-border" type="text" placeholder="username" name="Email" required>
          </div>
        </div>
        <div class="w3-row-padding" style="margin:8px -16px;">
          <div class="w3-half w3-margin-bottom">
            <label><i class="fa fa-500px"></i> Password</label>
            <input class="w3-input w3-border" type="password" placeholder="Password" name="pass" required>
          </div>
        </div>
        <button class="w3-button w3-dark-grey" type="submit" name="log">Log <i class="fa fa-linkedin w3-margin-right"></i> </button>
        <button class="w3-button w3-dark-grey" type="submit" name="sign">Sign <i class="	fa fa-hand-o-up w3-margin-right"></i> </button>
        <button class="w3-button w3-dark-grey" type="submit" name="admin">Admin </button>

	  </form>
    </div>
  </div>
</header>
</body>
<?php
   $servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbr";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = $conn->real_escape_string($_POST['Email']);
      $mypassword = $conn->real_escape_string($_POST['pass']); 
      if (isset($_POST['admin'])) {
       
	   $sql = "SELECT * FROM admin WHERE username = '$myusername' and password = '$mypassword'";
      $result = $conn->query($sql);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
      if ($result->num_rows > 0) {
         header("location: http://localhost/phpmyadmin/db_structure.php?server=1&db=dbr");
      }else {
         $error = "Your Login Name or Password is invalid";
		 echo $error;
      }
    }else{
	  if (isset($_POST['sign'])) {
       
	   $sql = "INSERT INTO login (username,password) VALUES ('".$myusername."','".$mypassword."')";
	   $conn->query($sql);
	   $sql = "DELETE FROM login WHERE username = ''";
	   	   $conn->query($sql);

		echo "Thanks we will update soon.";
    }
      $sql = "SELECT * FROM login WHERE username = '$myusername' and password = '$mypassword'";
      $result = $conn->query($sql);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
      if ($result->num_rows > 0) {
         header("location: qwerty.php");
      }else {
         $error = "Your Login Name or Password is invalid";
		 echo $error;
      }
	}
   }
?>
</html>
