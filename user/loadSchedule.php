<?php
session_start();

$id= $_SESSION['id'];
// load the database
include('../common/DBconnection.php');
$query="SELECT * FROM `user`WHERE id=$id";
$result= mysql_query($query);
$row = mysql_fetch_array($result);
$majorName=$row[1];
$year=$row[5];
    $query="SELECT * FROM  module f Right JOIN (SELECT * FROM timetable fp ) 
     as fp ON (f.moduleName = fp.moduleName) WHERE `majorName`='$majorName' AND `year`='$year'";

$result= mysql_query($query);
echo "<script type='text/javascript'>";
  while ($row = mysql_fetch_row($result)) {
      for ($i = 4; $i <=  10; $i++) {
          $slot=$i-3;
          if ($row[$i+2]) {
              echo "(document.getElementById(\"d".$row[5]."s".$slot."\")).innerHTML='$row[0]<br><br>Dr.$row[1]';";
          }
      }
  }
echo"</script>";
