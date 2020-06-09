<?php
session_start();
error_reporting(0);
header('Content-Type: application/json');
require_once("_access.php");
access([1,2,3,4,5,6,7]);
require_once("dbconnection.php");
try{
  $query = "select staff.*,role.name as role_name,branches.name as branch_name,
            date_format(staff.date,'%Y-%m-%d') as date,
            date_format(staff.end_date,'%Y-%m-%d') as end_date
           from staff
           inner join branches on branches.id = staff.branch_id
           inner join role on role.id = staff.role_id
           where staff.id = ?";
  $data = getData($con,$query,[$_SESSION['userid']]);
  $success="1";
} catch(PDOException $ex) {
   $data=["error"=>$ex];
   $success="0";
}
print_r(json_encode(array("success"=>$success,"data"=>$data)));
?>