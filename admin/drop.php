<?php
session_start();
$authlevel=$_SESSION['authlevel'];
if ($authlevel==3)
{$step=$_GET['step'];
$id=$_GET['id'];
   if ($step==1)
     {     	print "<center>\n";
     	print "<pre>\n<br /><br /><br /><br /><br /><br />";
     	print "�� ������������� ������ ������� ������������?\n<br /><br />";
     	print "<a href='glav.php?lnk=admin/drop&id=$id&step=2'><b>��</b></a>    <a href='glav.php?lnk=admin/users'><b>���</b></a>\n";
     	print "</pre>\n";
     	print "</center>\n";     	}
   elseif ($step==2)
     {        $id=$_GET['id'];
        $q="DELETE FROM `users` WHERE `id` = $id";
        mysql_query($q) or die (mysql_error());
        print "<center>������������ ������.</center><meta http-equiv='refresh' content='3; url=glav.php?lnk=admin/users'>\n";     	}
   else
     {     	print "<meta http-equiv='refresh' content='0; url=glav.php'>\n";     	}
}
else
{print "<meta http-equiv='refresh' content='0; url=glav.php'>\n";
}
?>