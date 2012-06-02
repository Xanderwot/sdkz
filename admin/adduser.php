<?php
session_start();include("./includes/include.php");
$authlevel=$_SESSION['authlevel'];
if ($authlevel==3)
{
$step=$_GET['step'];
if ($step==1)
{{print "    <div align='center'>Процесс создания нового пользователя</div><br /><br />
   	<table widht='70%' align='center' valign='middle' cellspan='7'>
   	<form name='' action='glav.php?lnk=admin/adduser&step=2' method='post'>    <tr class='tr' $styletr>
   	<td>Уникальный номер(ID)</td>   <td><input name='id' type='text' value='0'>  '0' - автозаполнение</td>    </tr><tr class='tr' $styletr>
   	<td>Логин</td>                 <td><input name='umail' type='text' value=''></td>    </tr><tr class='tr' $styletr>
   	<td>Пароль</td>                 <td><input name='upass' type='password' value=''></td>    </tr><tr class='tr' $styletr>
   	<td>Повторите ввод пароля</td>                <td><input name='upassconf' type='password' value=''></td>    </tr><tr class='tr' $styletr>
   	<td>Имя</td>                    <td><input name='uname' type='text' value='$row[3]'></td>    </tr><tr class='tr' $styletr>
   	<td>Фамилия</td>                <td><input name='ufname' type='text' value='$row[4]'></td>    </tr><tr class='tr' $styletr>
    <td>Группа</td>                 <td><select size='1' name='grp'>
                           <option value='Администраторы'>Администраторы</option>
                           <option value='Преподаватели'>Преподаватели</option>
                           <option value=''>Иное...>>></option>
                           </select><input name='grp1' type='text' value=''></td>    </tr><tr class='tr' $styletr>
   	<td>Уровень доступа</td>        <td><select size='1' name='authlevel'>
                           <option value='3'>Администратор</option>
                           <option value='2'>Преподаватель</option>
                           <option value='1'>Студент</option>
                           </select></td>    </tr><tr class='tr'>
                           <td align='center' colspan='2'><input type='submit' value='Добавить'></td></tr>
    </form>    </table>
   	</pre>
   	";}
}
else
{$id=$_POST['id'];$uname=$_POST['uname'];
$ufname=$_POST['ufname'];
$umail=$_POST['umail'];
$umail=strtolower($umail);
$upass=$_POST['upass'];
$upass=md5($upass);
$upassconf=$_POST['upassconf'];
$upassconf=md5($upassconf);
if ($upass==$upassconf)
{
$authlevel=$_POST['authlevel'];
$grp=$_POST['grp'];
$grp1=$_POST['grp1'];
   if ($grp=="")
 	 $grp=$grp1;
   else
     $grp=$grp;
$query="INSERT INTO `users` VALUES ($id, '$umail', '$upass', '$uname', '$ufname', '$grp', '$authlevel')";
mysql_query($query) or die (mysql_error());
print "Пользователь добавлен. <meta http-equiv='refresh' content='2; url=glav.php?lnk=admin/users'>";
}
else
{print "<center>пароли не совпадают! </center><meta http-equiv='refresh' content='2; url=glav.php?lnk=admin/adduser&step=1'>";}
}
}
else
{	print "<meta http-equiv='refresh' content='0; url=glav.php'>\n";	}
?>