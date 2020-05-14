<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'qwer123');
define('DB_DATABASE', 'students');
$conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
if ( !$conn ) { 
    die("Connection failed: " . mysqli_connect_error()); 
} 
$from= isset($_POST['from']) ? $_POST['from'] : null;
$message= isset($_POST['message']) ? $_POST['message'] :null;
$result=array();
date_default_timezone_set("Asia/Calcutta");
$date1 = date("Y-m-d H:i:s");

if(!empty($message) && !empty($from)){
    $stmt="INSERT INTO `users`(`message`, `from`, `created`) VALUES ('".$message."','".$from."','".$date1."')";
    $result['send_status']= $conn->query($stmt);
 }

$start= isset($_GET['start']) ? intval($_GET['start']) : 0;
$items= $conn->query("select * from `users` where `id` > ". $start);
while($row= $items->fetch_assoc()){
    $result['items'][] = $row;
}
    $conn->close();
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
 
    echo json_encode($result);
?>
