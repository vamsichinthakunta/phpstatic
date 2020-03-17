<?php 

	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$dbname = 'form';

	$conn = @mysqli_connect($host, $user, $pass);

	if(!$conn){
		echo "Not connected to Server";
	}
	if(!@mysqli_select_db($conn, 'form')){
		echo "Database not connected";
	}


	if(isset($_POST['submit'])){
		$Name = $_POST['firstname'];
		$Lname = $_POST['lastname'];
		$mobile = $_POST['mobilenumber'];
		$email = $_POST['email'];
		$zip = $_POST['zip'];
		$dob = $_POST['dob'];
		$brace = implode(',', $_POST['brace']);
	}
	$sql="SELECT * FROM formtable WHERE (mobilenumber = '$mobile' or email='$email')";
    $res=@mysqli_query($conn,$sql);
    if (@mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if ($email==$row['email'])
        {
			echo "Email already exists";
        }elseif($mobile == $row['mobilenumber']){
			echo "mobile number is already used.";
		}exit();
		
	}

	$sql = "INSERT INTO formtable (firstname, lastname, mobilenumber, email, zip, dob, braces) VALUES ('$Name', '$Lname', '$mobile', '$email', '$zip', '$dob', '$brace')";

	if (!@mysqli_query($conn, $sql)) {
		echo "Not Inserted";
	}else{
		echo "Inserted";
	}

?>