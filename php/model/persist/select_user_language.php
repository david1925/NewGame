<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



require_once "../DBConnect.php";
$conn = new DBConnection("localhost","newgame","root","root");

try {
		$stmt = $conn->prepare("SELECT Users.users_language FROM Users WHERE Users.users_id_user=1;");
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