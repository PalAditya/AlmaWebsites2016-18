<!DOCTYPE html><body>
<?php  
       $servername = "localhost";  
       $username = "root";  
       $password = "";  
       $conn = mysql_connect ($servername , $username , $password) or die("unable to connect to host");  
       $sql = mysql_select_db ('testing',$conn) or die("unable to connect to database"); 
	   echo $conn;
	   echo "</br>";
	   echo $sql;
	   echo "</br>";
?>
<?php
// define variables and set to empty values
$name = $email = $mobno = $ns =$sa=$state=$pword=$pword2= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $email=test_input($_POST["email"]);
  $mobno= test_input($_POST["mobno"]);
  $ns=test_input($_POST["ns"]);
  $sa=test_input($_POST["sa"]);
  $state=test_input($_POST["state"]);
  $pword=test_input($_POST["pword"]);
  $pword2=test_input($_POST["pword2"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<?php/*
#echo <h2>Your Input: </h2>
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $mobno;
echo "<br>";
echo $ns;
echo "<br>";
echo $sa;
echo "<br>";
echo $state;
echo "<br>";
echo $pword;
echo "<br>";
echo $pword2;
*/?>
<?php
if($pword==$pword2)
{
	$sql3 = "INSERT INTO Teacher (Name,email,mobno,school,sa,state,pass) VALUES ('$name', '$email', '$mobno','$ns','$sa','$state','$pword')";
  echo $sql3;
  if (mysql_query($sql3,$conn) === TRUE)
  {
		echo "New record created successfully";
		$message="Thank You for registering. We will get back to you soon.";
		echo "<script type='text/javascript'>;alert('$message');window.location.href='Exp.html';</script>";
  }
  else
  {
		 $message="This email already exists in database. Proceed to log in.";
		echo "<script type='text/javascript'>alert('$message');window.location.href='login.html';</script>";
  }
		
}
else
{
	header("location:signup.html");
}
?>
</body></html>