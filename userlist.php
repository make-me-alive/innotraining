<?php
session_start();

   if(!isset($_SESSION["sid"]))
   header('location:login.php');

   require_once 'connection.php';

   if(isset($_SESSION["sid"]))
   {   
     if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1400))
     header("location:logout.php");

     $sid=$_SESSION["sid"];
     $qry="SELECT role_id FROM  `tbl` WHERE  `uniqueid` =  '$sid' ";
     $fetch=mysql_query($qry);
     $res=mysql_fetch_assoc($fetch);
     if($res["role_id"] !== '1' && $res["role_id"] !== '2' )
     header('location:login.php');
   }

   if(isset($_GET["submit"]))
   {
        $name=$_GET["search"];
        $qry="SELECT *  FROM `tbl` WHERE `name` LIKE '%$name%'";
        $raw=mysql_query($qry);

        $check="SELECT *  FROM `tbl` WHERE `name` LIKE '%$name%'";
        $resource=mysql_query($check);     
        if(mysql_fetch_array($resource) == null)
        {     
         header('url=userlist.php');
         $msg="name not found";
        }
    }
       
    $name=$_GET["search"];
    if($name == null)
    {
      $qry="SELECT * FROM `tbl` WHERE email !='"." "."' and name is not null";
      $raw=mysql_query($qry);
    }


    if (!empty($_GET['submit-changes']))
    {   
        $qry= "UPDATE `tbl` SET `role_id`='0' WHERE `role_id` = '2'";
        $fetch=mysql_query($qry);

        if(isset($_GET["admin"]))
        {  
            $chkname = $_GET['admin'];
            foreach ($chkname as $key=>$value)
            {
                $qry= "SELECT `name`,`role_id` FROM `tbl` WHERE `id` = '$value'";
                $fetch=mysql_query($qry);
                $res=mysql_fetch_assoc($fetch);
                if($res['role_id'] == 0 )
                {
                  
                  $qry= "UPDATE `tbl` SET `role_id`='2' WHERE `id` = '$value'"; 
                  $fetch=mysql_query($qry);
                 
                }
                else
                {
                  $qry= "UPDATE `tbl` SET `role_id`='0' WHERE `id` = '$value'"; 
                  $fetch=mysql_query($qry);

                }

            }
            
        }
    }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="1380;url=logout.php" />
<link rel="stylesheet" type="text/css" href="style-sheet.css">
<title>ADMIN-panel</title>
</head>
<table id="header" width="100%"><tr><td onclick="window.location.href='registration.php'" id="logologin"></td> 
<td><a id="padanchor" href="logout.php">LOGOUT</a></td></tr></table>
<body>

<form  name="checkfrm" action="userlist.php" method="GET">
 <div class="padding">
 <tr>
<td><input type="text"  name="search"  id="search" placeholder="search by name" ></td>
<td><input id="button1" class="tran" type="submit" name="submit" value="search" ></td><br /> 
</tr>
</div>
 <td><?php echo $msg; ?> </td>

  <table id="userlist" width="80%">
  <tr> 
    <td id="shiftname">Name</td>
    <td id="shiftemail">Email</td>
    <td id="shiftblank">&nbsp</td>
    <td class="shiftbox">&nbsp</td>
  </tr>
   <?php
   $count=0;
   while($res=mysql_fetch_assoc($raw))
    { 
   ?>
 <tr>
<td id="shiftname"> <div class="bottom"> <?php echo $res["name"];?> </div> </td> 
<td id="shiftemail"> <div class="bottom"><?php echo $res["email"];?> </div> </td>
 <td id="shiftblank"><?php $show=$uid=$user[$count++]=$res["id"];  ?>
 <a  id="viewdesign" href='viewuser.php?user=<?php echo $uid; ?>'> <?php echo View; ?> </a></td>
 
 <td class="shiftbox"><input type="checkbox" id="checkbox" name="admin[]"  
     <?php $qry= "SELECT role_id FROM `tbl` WHERE `id` = '$uid'";$fetch=mysql_query($qry);
     $res=mysql_fetch_assoc($fetch); if($res['role_id'] == 2 ) echo "checked='checked'"; ?>
     value="<?php echo $show; ?>" > make/remove admin</td>
 </tr>
  <?php
    }
   ?>
</table> 
<form method="GET">
<td><input id="button2" type="submit" name="submit-changes" value="SAVE CHANGES" ></td><br />
</form>
</form>
</body>
</html>