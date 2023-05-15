<?php  include 'conn/conn.php';
$link=getDb();
session_start();
if(isset($_SESSION['logged_in'])){
  if($_SESSION['logged_in']==0){
    header("Location: login.php");
  }
}
else header("Location: login.php");
?>