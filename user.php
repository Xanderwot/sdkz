<?php
session_start();
error_reporting(0);
$uid=$_GET['uid'];
if($uid=="")
 {   $uid=$_SESSION['id'];
 }
$authlevel=$_SESSION['authlevel'];
$reason=$_GET['reason'];
$css="class='shapka'";
  if($authlevel==3)
  {  	print "<br /><br /><center>Информация о пользователе</center>";  	$w=mysql_query("SELECT * FROM `users` WHERE `id` = '$uid'");
  	print "<br /><table align='center' valign='midle' cellpaddind='7' width='70%'>\n";
  	while($row=mysql_fetch_array($w))
  	  {  	    {print "
  	    <tr $css>\n
  	    <td><center>e-mail</center></td>\n
  	    <td><center>$row[1]</center></td>\n
  	    </tr>\n
  	    <tr $css>\n
  	    <td><center>Имя</center></td>\n
  	    <td><center>$row[3]</center></td>\n
  	    </tr>\n
  	    <tr $css>\n
  	    <td><center>Фамилия</center></td>\n
  	    <td><center>$row[4]</center></td>\n
  	    </tr>\n
  	    <tr $css>\n
  	    <td><center>Группа</center></td>\n
  	    <td><center>$row[5]</center></td>\n
  	    </tr>\n
  	    <tr $css>\n
  	    <td colspan='2'><center><a href='glav.php?lnk=admin/edit&id=$uid&step=1'>Редактировать</a></center></td>\n
  	    </tr>\n
  	    </table>
  	    ";}
  	  }
  }
  else
  {     print "<br /><br /><center>Информация о пользователе</center>";
  	 $w=mysql_query("SELECT * FROM `users` WHERE `id` = '$uid'");
  	 print "<br /><table align='center' valign='midle' cellpaddind='7' width='70%'>\n";
  	 while($row=mysql_fetch_array($w))
  	  {
  	    {print "
  	    <tr $css>\n
  	    <td><center>e-mail</center></td>\n
  	    <td><center>$row[1]</center></td>\n
  	    </tr>\n
  	    <tr $css>\n
  	    <td><center>Имя</center></td>\n
  	    <td><center>$row[3]</center></td>\n
  	    </tr>\n
  	    <tr $css>\n
  	    <td><center>Фамилия</center></td>\n
  	    <td><center>$row[4]</center></td>\n
  	    </tr>\n
  	    <tr $css>\n
  	    <td><center>Группа</center></td>\n
  	    <td><center>$row[5]</center></td>\n
  	    </tr>\n
  	    </table>
  	    ";}
  	  }
  }
?>