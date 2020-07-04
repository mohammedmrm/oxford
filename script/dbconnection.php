<?php
try{

$con = new PDO('mysql:host=localhost;dbname=ox', "root",
"", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"));
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException  $e ){
 echo "Error: ".$e;
}
function getData($db,$query,$parm = []) {
  $stmt = $db->prepare($query);
  $stmt->execute($parm);
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $rows;
}
function setData($db,$query,$parm = []) {
  $stmt = $db->prepare($query);
  $stmt->execute($parm);
  $count = $stmt->rowCount();
  return $count;
}
function setDataWithLastID($db,$query,$parm = []) {
  $stmt = $db->prepare($query);
  $stmt->execute($parm);
  $rows = $db->lastInsertId();
  return $rows;
}
function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
    return $d && $d->format($format) === $date;
}
?>