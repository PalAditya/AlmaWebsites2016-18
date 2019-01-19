<?php  
       $servername = "166.62.8.2";  
       $username = "alma18int";  
       $password="teamAlma@18";   
       $conn = mysql_connect ($servername , $username , $password) or die("unable to connect to host");  
       $sql = mysql_select_db ('alma18int',$conn) or die("unable to connect to database"); 
	   //echo $conn;
	   //echo "</br>";
	   //echo $sql;
	   //echo "</br>";
?>
<?php
// define variables and set to empty values
$name = $email = $phone = $city =$gender=$college=$message="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $email=test_input($_POST["email"]);
  $phone= test_input($_POST["phone"]);
  $college=test_input($_POST["college"]);
  $city=test_input($_POST["city"]);
  $gender=test_input($_POST["gender"]);
  $message=test_input($_POST["message"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<?php
  $sql3 = "INSERT INTO aghaaz19 (name,email,phone,college,city,gender,message) VALUES ('$name', '$email', '$phone','$college','$city','$gender','$message')";
  //echo $sql3;
  if (mysql_query($sql3,$conn) == TRUE)
  {
		echo "<script type='text/javascript'>;window.location.href='/index.html'</script>";
  }
  else
  {
	$message="Oops, the server seems to be too busy. Our bad. Please try again.";
	echo "<script type='text/javascript'>;alert('$message');window.location.href='/index.html';</script>";
  }
?>