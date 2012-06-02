<?php
session_start();
$authlevel=$_SESSION['authlevel'];
$step=$_GET['step'];
if ($authlevel==3)
{if ($step==1)
{$select[1]="";
$select[2]="";
$select[3]="";
$select[4]="";
$select1[1]="";
$select1[2]="";
$select1[3]="";
$css="class='shapka'";$id=$_GET['id'];
$query="SELECT * FROM `users` WHERE `id` = '$id'";
$t1=mysql_query($query) or die(mysql_error());
while($row=mysql_fetch_array($t1))
   {      //Странная функция на первый взгляд, но полезная у-у-ух!!!))
    $ulev=$row[6];   	$ppp=$row[5];
   	if ($ppp=="Администраторы")
   	   $select[1]="SELECTED";
   	elseif ($ppp=="Преподаватели")
   	   $select[2]="SELECTED";
   	else
   	   {$select[3]="SELECTED";
   	    $select[4]="$row[5]";}
   	$ppp=$row[6];
   	if ($ppp=="3")
   	   $select1[1]="SELECTED";
   	elseif ($ppp=="2")
   	   $select1[2]="SELECTED";
   	else
   	   $select1[3]="SELECTED";   	{print "<br /><br /><center>Редактирование данных пользователя</center><br />\n   	<table align='center' valign='midle' cellpadding='7' width='70%'>\n
   	<form name='' action='glav.php?lnk=admin/edit&step=2' method='post'>\n
   	<tr $css>\n
   	<td><center>e-mail</center></td>\n
   	<td><center><input name='umail' type='text' value='$row[1]'></center></td>\n
   	</tr>\n
   	<tr $css>\n
   	<td><center>Имя</center></td>\n
   	<td><center><input name='uname' type='text' value='$row[3]'></center></td>\n
   	</tr>\n
   	<tr $css>\n
   	<td><center>Фамилия</center></td>\n
   	<td><center><input name='ufname' type='text' value='$row[4]'></center></td>\n
   	</tr>\n
   	<tr $css>\n
    <td><center>Группа</center></td>\n
        <td><center><select size='1' name='grp'>\n
        <option value='Администраторы' $select[1]>Администраторы</option>\n
        <option value='Преподаватели' $select[2]>Преподаватели</option>\n
        <option value='' $select[3]>Иное...>>></option>\n
        </select><input name='grp1' type='text' value='$select[4]'></center></td>\n
    </tr>\n ";}
    if($id==1)
    {     {print "<tr $css>\n
   	  <td><center>Уровень доступа</center></td>\n
   	        <td><center><font color='#FF0000'>Вам запрещена эта операция</font></center></td>\n
   	        <input name='authlev' type='hidden' value='$ulev'>
      </tr>\n";}
    }
    else
    {
    {print "<tr $css>\n
   	<td><center>Уровень доступа</center></td>\n
   	        <td><center><select size='1' name='authlev'>\n
            <option value='3' $select1[1]>Администратор</option>\n
            <option value='2' $select1[2]>Преподаватель</option>\n
            <option value='1' $select1[3]>Студент</option>\n
            </select></center></td>\n
    </tr>\n";}
    }

    {print "<tr $css>\n
            <input name='id' type='hidden' value='$id'>\n
    <td colspan='2'><center><input type='submit' value='Изменить'></center></td>\n
    </tr>\n
    </form>\n
   	</table>\n
   	";}   	}
}
else
{$id=$_POST['id'];
$umail=$_POST['umail'];
$uname=$_POST['uname'];
$ufname=$_POST['ufname'];
$grp=$_POST['grp'];
$grp1=$_POST['grp1'];
   if ($grp=="") 	 $grp=$grp1;
   else
     $grp=$grp;
$authlev=$_POST['authlev'];$query="UPDATE `users` SET `mail`='$umail', `name` = '$uname', `fname` = '$ufname', `grp` = '$grp', `authlevel` = '$authlev'  WHERE `users`.`id` ='$id'";
mysql_query($query) or die (mysql_error());
{print "
<center>\n
Переадресация\n
<meta http-equiv='refresh' content='2; url=glav.php?lnk=admin/users'>\n
</center>\n";}}}
else
{print "<meta http-equiv='refresh' content='0; url=glav.php'>\n";
}
?>