<!DOCTYPE HTML><body>
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
echo "WTF";
$name =$pword=$spword="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $pword=test_input($_POST["pword"]);
  echo $pword;
  $spword=test_input($_POST["spword"]);
  echo "</br>";
  echo $spword;
  $sql3='SELECT email FROM Teacher WHERE pass="$pword"';
  $val=mysql_query($sql3,$conn);
  if($val)
  {
	  echo $val;
	  echo "</br>";
	  echo $name;
	  if($val==$name)
	  {
		  echo "Cool";
	  }
	  else
	  {

		  $message="Atleast one of the fields don't match. Please check your id and passwords.";
		echo "<script type='text/javascript'>alert('$message');window.location.href='login.html';</script>";
	  }
  }
  else
  {
	  echo "Connection Lost!";
  }
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
</body>
</HTML>