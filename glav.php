<?php
session_start();
header("Content-Type: text/html;charset=windows-1251");
if($_SESSION['id']=="")
{	header('location: login.php');
}
else
{$lnk=$_GET['lnk'];
if($lnk=="")
{  $lnk="glavnaya.php";
}
else
{  $lnk.=".php";
  if(! file_exists($lnk))
   {   	 $lnk="glavnaya.php";
   }
  else
   {   	 //none
   }
}
include("config.php");
print "<html>\n";
print "<head>\n";
print "<script language='javascript' src='scripts/script.js'></script>";
print "<link rel='stylesheet' href='style/style.css' type='text/css'>\n";
print "<title>TestProg</title>\n";
print "</head>\n";
print "<body>\n";
print "<div id='logo'></div>\n";
print "<div id='left'>";
include("leftmenu.php");
print "</div>\n";
print "<div id='center'>";
include($lnk);
print "</div>\n";
print "</body>\n";
print "</html>\n";
}
?>
