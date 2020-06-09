<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("../script/_access.php");
access([1,2,5,3,4]);
require_once("../script/dbconnection.php");

if($_SESSION['user_details']['role_id'] == 1 || $_SESSION['user_details']['role_id'] == 3 || $_SESSION['user_details']['role_id'] == 2){
  $sql = "select sum(if(status = 1,money, - money )) as balance, max(date_Format(date,'%y-%m-%d')) as date from balance group by date_Format(date,'%y-%m-%d') order by date_Format(date,'%y-%m-%d') DESC";

}else{
  $sql =  "select sum(if(status = 1,money, - money )) as balance, max(date_Format(date,'%y-%m-%d')) as date from branch_balance
           where branch_balance.branch_id = '".$_SESSION['user_details']['branch_id']."'
           group by date_Format(date,'%y-%m-%d') order by date_Format(date,'%y-%m-%d') DESC";

}
$data =  getData($con,$sql);
echo json_encode([$sql,'data'=>$data]);
?>