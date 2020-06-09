<?php
session_start();
header('Content-Type: application/json');
require_once("dbconnection.php");
$id = $_REQUEST['id'];
try{
  $query = "select *,date_format(end_date,'%Y-%m-%d') as end_date from staff where id = ?";
  $data = getData($con,$query,[$id]);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
echo (json_encode(array("success"=>$success,"data"=>$data)));
?>