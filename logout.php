<?php
session_start();

require_once 'connection.php';

   if(isset($_SESSION["sid"])) {   

   $qry= "  UPDATE `tbl` SET `uniqueid`= '',`timeid`= '' WHERE `uniqueid`= '".$_SESSION['sid']."'   ";
   $fetch=mysql_query($qry);
 
   session_destroy();
   $_SESSION["msg"]="successfully logged out";
   header("location:login.php");
   }
   else
   header("location:login.php");

?>