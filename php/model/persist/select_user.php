<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



require_once "../DBConnect.php";
$conn = new DBConnection("localhost","newgame","root","root");
$username = $_GET['username'];
$password = $_GET['password'];

try {
		$stmt = $conn->prepare("SELECT Users.users_username FROM Users WHERE Users.users_username='".$username."' AND Users.users_password='".$password."'");
		$stmt->execute();
		$user = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$records = array("records" => $user);
		echo unicode_decode(json_encode($records));

	} catch(PDOException $e) {
		    echo "Error: " . $e->getMessage();
		}
		$conn = null;
function replace_unicode_escape_sequence($match) {
    return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
}
function unicode_decode($str) {
    return preg_replace_callback('/\\\\u([0-9a-f]{4})/i', 'replace_unicode_escape_sequence', $str);
}
?>