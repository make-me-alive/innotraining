<?php
session_start();
$conn=mysql_connect("localhost","root","password1");
mysql_select_db("tbl_user",$conn);

   if(isset($_SESSION["sid"]))
    {   

      $qry= "  UPDATE `tbl` SET `uniqueid`= '' WHERE `uniqueid`= '".$_SESSION['sid']."'   ";
      $fetch=mysql_query($qry);
     
      session_destroy();
	  $_SESSION["msg"]="successfully logged out";
	  header("location:login.php");
	}

?>