<?php

$fname = $email = $lname = $school = $state = $city = $phone = $std = $kota = $nameErr = "";

$required = array("first_name", "last_name",  "email", "school", "state", "city", "phone", "std", "kota");
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $error = false;
  foreach($required as $field) {
    if (empty($_POST[$field])) {
      $error = true;
    }
  }

  if ($error) {
    echo "All fields are required. You are being redirected";
    echo "<script>setTimeout(\"location.href = 'index.html';\",1500);</script>";
  } else {
    echo "Proceed...";
    $fname = test_input($_POST["first_name"]);
    $lname =  test_input($_POST["last_name"]);
    $email = test_input($_POST["email"]);
    $school = test_input($_POST["school"]);
    $state = test_input($_POST["state"]);
    $city = test_input($_POST["city"]);
    $phone = test_input($_POST["phone"]);
    $std = test_input($_POST["std"]);
    $kota = test_input($_POST["kota"]);
    $to_email = $email;
    $subject = "Spardha 2019 registrations";
    $section = 'A';
    if($std=="Class 9th-10th"){
      $section = 'B';
    }elseif ($std=="Class 11th and 12th (PCM)") {
      $section='C';
    }elseif ($std=="Class 11th and 12th (PCB)") {
      # code...
      $section = 'D';
    }
    //echo $section;

    $host = "localhost";  
    $username = "h4fl4y0pgibr";  
    $password="aLma!@#$%^&*(0"; 
    $dbName = "Spardha";
     
    $conn = new mysqli($host, $username, $password, $dbName);
     
    if ($conn->connect_error){
      echo "connectionfailed1";
      die("Connection failed: " . $conn->connect_error);
      
    }
    
	$sqlrollno="SELECT * FROM Spardhatest";
	$rowcount = "";
	if ($result=mysqli_query($conn,$sqlrollno))
  	{
  		// Return the number of rows in result set
  		$rowcount=mysqli_num_rows($result);
  		echo $rowcount;
//  		printf("Result set has %d rows.\n",$rowcount);
  	}
    $rollno = ""; 
    $val1 = $rowcount + 1;
    if($val1<=9){
      $rollno = 'AF19SP000'.$val1;
    }else if($val1 <= 99){
      $rollno = 'AF19SP00'.$val1;
    }else{
        $rollno = 'AF19SP0'.$val1;  
    }
    //echo $rollno;

    $msg = "Greetings!\nYou  have successfully registered for Alma Fiesta and IIT Bhubaneswar organised annual National Talent Hunt Competitive exam: Spardha and following are your registration details for the same:\n1) Name: ".$fname." ".$lname." \n2) Registered Email id: ".$email."\n3) School: ".$school."\n4) Location: ".$city.", ".$state."\n5) Phone Number: ".$phone."\n 6) Section: ".$std."\n\n\tYour roll number for Spardha is: ".$rollno.". You are supposed to use this roll number for the exam and results. For any further queries you can mail at publicrelations@almafiesta.com";
    $headers = "From: noreply@almafiesta.com";

    $sql="INSERT INTO Spardhatest (rollno, fname, lname, email, school, state, city, phone, std, kota) VALUES ('".$rollno."', '".$fname."', '".$lname."', '".$email."', '".$school."', '".$state."', '".$city."', '".$phone."', '".$section."','".$kota."')";

    if(!$result = $conn->query($sql)){
      die('There was an error running the query [' . $conn->error . ']');
      echo "connectionfailed2";
    }else{

      mail($to_email,$subject,$msg,$headers);
      echo  "<script type='text/javascript'>alert('All the values were saved successfully. You will be contacted through email')
    window.location = '../index.html';
    </script>";

    }
   
    


  }

}

function test_input($data) {
  if (empty($data)) {
      $nameErr = $nameErr.$a;
      $err = "";
  }else {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
  }
  return $data;
}

function getPassword() {
    try {
        $db = new PDO("mysql:host=localhost;charset=utf8", "h4fl4y0pgibr", "aLma!@#$%^&*(0");
        $username = $_POST["txtUsername"];
        $cmd = $db->prepare("
            SELECT Password FROM `tblusers` WHERE Username = :username;
        ");
        return $cmd;
    } catch (Exception $e) { echo $e->getMessage(); return; }
}


?>
