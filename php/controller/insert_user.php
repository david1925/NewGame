<!DOCTYPE html>
<html>
<head>
	<title>Insert user</title>
</head>
<body>
<?php
	require_once "../model/DBConnect.php";
	$conn = new DBConnection("localhost","newgame","root","root");
	if(isset($_POST['insert_user'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$password = md5($password);
	try{
		$stmt = $conn->prepare("INSERT INTO Users (users_username,users_password,users_email,users_public_profile,users_status) VALUES (:username, :password, :email, '1','0')");
	  	$stmt->bindParam("username", $username);
      	$stmt->bindParam("password", $password);
      	$stmt->bindParam("email", $email);
      	// Execute the INSERT
      	$stmt->execute();

	  	$stmt2 = $conn->prepare("SELECT Users.users_id_user FROM Users ORDER BY Users.users_id_user DESC LIMIT 1");
      	// Execute the INSERT
      	$stmt2->execute();
      	$users = $stmt2->fetchAll(PDO::FETCH_ASSOC);

      	header("Location: register_mailing.php?id=".$users[0]["users_id_user"]."&name=".$name."&username=".$username."&email=".$email."");	
	}catch(PDOException $e){
		echo $e;
	}
	

	}
?>
</body>
</html>