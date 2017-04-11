<!DOCTYPE html>
<html>
<head>
	<title>User confirmation</title>
</head>
<body>
<?php
	require_once "../model/DBConnect.php";
	$conn = new DBConnection("localhost","newgame","root","root");
	if(isset($_GET['id'])){
		try {
		$stmt = $conn->prepare("UPDATE Users SET Users.users_status=1 WHERE Users.users_id_user=".$_GET['id'].";");
		$stmt->execute();
		echo "Your user has been confirmed, now you can log in on the web.";
		//echo $stmt;
		} catch(PDOException $e) {
		    echo "Error: " . $e->getMessage();
		}
		$conn = null;
		
	}
	else{
		echo "¡Error!, no se ha recibido id de usuario";
	}
?>
</body>
</html>