<?php
error_reporting(0);
if(! filesize('../config.php') == 0){	header("location: ../index.php");
}
$step=$_GET['st'];
$error="<br><br><br><div align='center'>��� ���� ����������� � ���������!</div>";
$htm_open="<html>\n";
$htm_open.="<head>\n";
$htm_open.="<title>��������� �������</title>\n";
$htm_open.="<link rel='stylesheet' href='../style/style.css' type='text/css'>\n";
$htm_open.="<script language='javascript' src='../script/script.js'></script>\n";
$htm_open.="</head>\n";
$htm_open.="<body onMouseMove='' >\n";
$page="<table width='100%' height='100%' align='center' valign='middle'>\n";
$page.="<tr>\n <td>\n";
$page.="<div align='center'>��������� �������</div>\n";
$page.="<table width='60%' align='center'>\n";
$page.="<form action='index.php?st=1' method='post'>\n";
$page.="<tr> \n <td align='right'>������ ��� ������</td>\n";
$page.="<td><input name='host' type='text' size='50' value=''></td></tr>\n";
$page.="<tr><td align='right'>������������</td>\n";
$page.="<td><input name='hlog' type='text' size='50' value=''></td></tr>\n";
$page.="<tr><td align='right'>������</td>\n";
$page.="<td><input name='hpass' type='password' size='50' value=''></td></tr>\n";
$page.="<tr>\n<td align='center' colspan='2'><input type='submit' value='����� &gt;&gt;'></td>\n</tr>\n";
$page.="</td>\n </tr>\n";
$page.="</form>";
$page.="</table>\n";
$page.="</table>\n";
$htm_close="</body>\n";
$htm_close.="</html>";
if($step=="1")
{  $erhost="<br /><br /><br /><br />\n<div align='center'>�� ������� ��� �������!<br>\n";
  $erhost.="<a href='index.php'>�����</a></div>\n";
  $erlog="<br /><br /><br /><br /><div align='center'>������� ��� ������������!<br>\n";
  $erlog.="<a href='index.php'>�����</a></div>\n";  $host=$_POST['host'];
  $hlog=$_POST['hlog'];
  $hpass=$_POST['hpass'];
  $erconnect="<br /><br /><br /><br />\n<div align='center'>������ ���������� � �������!<br>\n";
  $erconnect.="��������� ��������� ����������.<br>\n";
  $erconnect.="<a href='index.php'>�����</a></div>\n";
  $connect=mysql_connect($host,$hlog,$hpass);
  //�������� �������� ����������� � �������.
  if($host=="")
   {     print $htm_open.$erhost.$htm_close;
   }
  elseif($hlog=="")
   {   	 print $htm_open.$erlog.$htm_close;
   }
  elseif(! $connect)
   {  	 print $htm_open.$erconnect.$htm_close;
   }
  else
   {   	 $inst="<table align='center' valign='middle' width='100%' height='100%'>\n";
   	 $inst.="<tr><td>";
   	 $inst.="<table align='center' width='50%'>\n";
   	 $inst.="<form action='index.php?st=2' method='post'>\n";
   	 $inst.="<tr><td align='right'>��� ����</td>\n";
   	 $inst.="<td><input name='bdname' type='text' value=''></td></tr>\n";
   	 $inst.="<tr><td align='right'>����� ��������������</td>\n";
   	 $inst.="<td><input name='ulog' type='text' value=''></td></tr>\n";
   	 $inst.="<tr><td align='right'>������ ��������������</td>\n";
   	 $inst.="<td><input name='upass' type='password' value=''></td></tr>\n";
   	 $inst.="<tr><td align='right'>���</td>\n";
   	 $inst.="<td><input name='uname' type='text' value=''></td></tr>\n";
   	 $inst.="<tr><td align='right'>�������</td>\n";
   	 $inst.="<td><input name='ufam' type='text' value=''></td></tr>\n";;
   	 $inst.="<input name='host' type='hidden' value='$host'>\n";
   	 $inst.="<input name='hlog' type='hidden' value='$hlog'>\n";
   	 $inst.="<input name='hpass' type='hidden' value='$hpass'>\n";
   	 $inst.="<tr><td colspan='2' align='center'><input type='submit' value='�����&gt;&gt;'></td></tr>\n";
   	 $inst.="</form>";
   	 $inst.="</table>\n";
   	 $inst.="</table>\n";
   	 print $htm_open.$inst.$htm_close;
   }
}
elseif($step=="2")
{   $host=$_POST['host'];
   $hlog=$_POST['hlog'];
   $hpass=$_POST['hpass'];
   $ulog=$_POST['ulog'];
   $upass=$_POST['upass'];
   $uname=$_POST['uname'];
   $ufam=$_POST['ufam'];
   $bdname=$_POST['bdname'];
   $upass=md5($upass);
   $ulog=strtolower($ulog);
   $done="<br /><br /><br /><br /><div align='center'>��������� ���������<br />";
   $done.="<u><a href='./index.php'>�����</a></u>";
   $done.="</div>";
   include('bc_cr.php');
   mysql_connect($host,$hlog,$hpass);
   mysql_query("set names cp1251");
   $test_bd=mysql_db_name($bdname);
   if($test_bd)
   {
     mysql_db_name($bdname);   	 include("bd_cr.php");
   	 //�������� ������� � ���������� ������� ��� ������
   	 mysql_select_db($bdname) or die(mysql_error());
     mysql_query($Qtableusers) or die(mysql_error());
     mysql_query($Qtablepredmet) or die(mysql_error());
     mysql_query($Qtabletests) or die(mysql_error());
     mysql_query($Qtabletexttest) or die(mysql_error());
     mysql_query($Qtablestudotvet) or die(mysql_error());
     mysql_query($Qtabledostup) or die(mysql_error());
     mysql_query($Qtablegotovtest) or die(mysql_error());
     $fl = fopen("../config.php","w+");
     fwrite($fl, "<?php \n mysql_connect('$host','$hlog','$hpass'); \n mysql_select_db('$bdname');\n mysql_query('set names cp1251');\n ?>");
     fclose($fl);
     $insert="INSERT INTO `users` VALUES (0, '$ulog', '$upass', '$uname', '$ufam', '���������', 3)";
     mysql_query("$insert") or die(mysql_error());
     print $htm_open.$done.$htm_close;
   }
   else
   {     mysql_query("CREATE DATABASE `$bdname`");
     include("bd_cr.php");
     //�������� ������� � ���������� ������� ��� ������
     mysql_select_db($bdname) or die(mysql_error());
     mysql_query($Qtableusers) or die(mysql_error());
     mysql_query($Qtablepredmet) or die(mysql_error());
     mysql_query($Qtabletests) or die(mysql_error());
     mysql_query($Qtabletexttest) or die(mysql_error());
     mysql_query($Qtablestudotvet) or die(mysql_error());
     mysql_query($Qtabledostup) or die(mysql_error());
     mysql_query($Qtablegotovtest) or die(mysql_error());
     $fl = fopen("../config.php","w+");
     fwrite($fl, "<?php \n mysql_connect('$host','$hlog','$hpass'); \n mysql_select_db('$bdname');\n mysql_query('set names cp1251');\n ?>");
     fclose($fl);
     $insert="INSERT INTO `users` VALUES (0, '$ulog', '$upass', '$uname', '$ufam', '���������', 3)";
     mysql_query("$insert") or die(mysql_error());
     print $htm_open.$done.$htm_close;
   }
}
else
{  print $htm_open.$page.$htm_close;
}
?>