<?php
session_start();include("./includes/include.php");
$authlevel=$_SESSION['authlevel'];
if ($authlevel==3)
{
print "<div align=\"center\">\n";
print "Список зарегистрированных пользователей.\n";
print "</div><br />\n";
$query="SELECT * FROM `users`";
$t1=mysql_query($query);
$n=mysql_num_rows($t1);
print "<div align=\"center\">\n";
   if ($n==0)
   {
   print "Пользователей в системе не обнаружено\n";
   	}
   else
   {   print "<table align='center' valign='midle' cellpadding='7' width='70%'>\n";
   print "<tr class='tr'>\n";
   print "<td><center>  ID  </center></td>\n";
   print "<td><center>  Имя  </center></td>\n";
   print "<td><center>  Фамилия  </center></td>\n";
   print "<td><center>  Группа  </center></td>\n";
   print "</tr>\n";
        while($row=mysql_fetch_array($t1))
        {        $creator=$row[0];        if ($creator==1)
        {        print "<tr class='tr' $styletr>\n";
        print "<td><center>  $row[0]  </center></td>\n";
        print "<td><center>  $row[3]  </center></td>\n";
        print "<td><center>  $row[4]  </center></td>\n";
        print "<td><center>  $row[5]  </center></td>\n";
        print "<td><a href='glav.php?lnk=admin/edit&id=$row[0]&step=1'>Редактировать</a></td>\n";
        print "</tr> \n";
        }
        else
        {        print "<tr class='tr' $styletr>\n";
        print "<td><center>  $row[0]  </center></td>\n";
        print "<td><center>  $row[3]  </center></td>\n";
        print "<td><center>  $row[4]  </center></td>\n";
        print "<td><center>  $row[5]  </center></td>\n";
        print "<td><a href='glav.php?lnk=admin/edit&id=$row[0]&step=1'>Редактировать</a></td>\n";
        print "<td><a href='glav.php?lnk=admin/drop&id=$row[0]&step=1'>Удалить</a></td>\n";
        print "</tr> \n";        	}
        }
   print "<th colspan='6'><center><a href='glav.php?lnk=admin/adduser&step=1'>Добавить пользователя</a></center></th>\n";
   print "</table> \n";
   }
}
else
{print "<meta http-equiv='refresh' content='0; url=glav.php'>\n";
}
print "</div>\n";
?>