<?php
session_start();include("includes/include.php");
$authlevel=$_SESSION['authlevel'];
if ($authlevel==1)
{print "<meta http-equiv='refresh' content='0; url=glav.php'>\n";
}
else
{$step=$_GET['step'];
   if ($step==1)
   {   // ������ ������� ������, ������� �� ����� tests.php, �������� ���� ��� ���)))
   //����� �������
   $w=mysql_query("SELECT * FROM `tests`");
   $error=mysql_num_rows($w);
   if ($error==0)
   {   print "<br /><br /><br /><br /><table align='center' valign='midle' sellpadding='7' width='70%'>\n";
   print "<tr class='tr' $styletr><td><center><font color='#FF0000'>�������� � ������� �� ����������</font></center></td></tr>";   print "<th class='tr' colspan='3'><a href='glav.php?lnk=redactor&step=5'>������� ����� ������</a></th>\n";
   print "</table>\n";
   }
   else
   {   print "<br /><br /><table align='center' valign='middle' cellpadding='7' width='70%'>\n";
   print "<tr class='tr'>\n";
   print "<td><center>�������� �������</center></td>\n";
   print "<td><center>�������</center></td>\n";
   print "<td><center>�����</center></td>\n";
   print "</tr>\n";
   while($row=mysql_fetch_array($w))
     {      $tname=$row[3];
      $tid=$row[0];
      $pid=$row[1];
      $uid=$row[2];
      $w1=mysql_query("SELECT * FROM `users` WHERE `id` = '$uid'");
      while($row1=mysql_fetch_array($w1))
        {         $ufname=$row1[4];
        }
      $w2=mysql_query("SELECT * FROM `predmet` WHERE `id` = '$pid'");
      while($row2=mysql_fetch_array($w2))
        {         $predmet=$row2[1];
        }
     print "<tr class='tr' $styletr>\n";
     print "<td><center><a href='glav.php?lnk=tests&reason=view&tid=$tid'>$tname</a></center></td>\n";
     print "<td><center>$predmet</center></td>\n";
     print "<td><center><a href='glav.php?lnk=user&uid=$uid'>$ufname</a></center></td>\n";
     print "<td><center><a href='glav.php?lnk=redactor&tid=$tid&step=droptest'>�������</a></center></td>\n";
     print "</tr>\n";
     }
   //�������� ������ �����
   print "<th class='tr' colspan='3'><a href='glav.php?lnk=redactor&step=5'>������� ����� ������</a></th>\n";
   print "</table>\n";
   }
   }
   elseif ($step==2)
   {
      $tname=$_GET['tname'];
   	  $n=$_GET['n'];
   	  $pid=$_GET['pid'];
      $q1=mysql_query("SELECT * FROM `predmet`");   	  {print "<br /><br />
   	  <form name='' action='glav.php?lnk=redactor&step=3' method='post'>";}
   	  print "<table align='center' vlign='midle' cellpadding='7' width='70%'>\n";
   	  print "<tr><td>�������</td><td><select size='1' name='pid'>\n";
   	  $oshibka=mysql_num_rows($q1);
   	  if($oshibka==0)
   	  {
   	  	 print "<option value=''>���������� �������� ��������</option>\n";
   	  }
   	  else
   	  {
   	     while($row=mysql_fetch_array($q1))
   	    {
   	       if($pid==$row[0])
   	        {
             print "<option value='$row[0]' SELECTED>$row[1]</option>\n";
            }
           else
            {             print "<option value='$row[0]'>$row[1]</option>\n";
            }
        }
      }
      print "</select></td></tr>\n";
      {print "
      <tr><td>�������� �������</td><td><input name='tname' type='text' size='50' value='$tname'></td></tr>
      <tr><td>���������� ��������</td><td><input name='n' type='text' size='2' maxlength='2' value='$n'></td></tr>
                           <th colspan='2'><input type='submit' value='�����'></th>
      </table>
      </form>
      ";}
   }
   elseif ($step==3)
   {   	  $tname=$_POST['tname'];
   	  $n=$_POST['n'];
   	  $pid=$_POST['pid'];
   if($pid=="")
     {   	  	print "<br /><br /><br /><br /><hr><center>�� ������ ������� ��� �� ������ ������ ���������</center><hr>";
   	  	print "<form name='' action='glav.php?lnk=redactor&step=2&tname=$tname&n=$n' method='post'>\n";
        print "<center><input type='submit' value='�����'></center>\n";
        print "</form>\n";
   	 }
   	  elseif($tname=="")
   	  {   	  	print "<br /><br /><br /><br /><hr><center>������� �������� �����.</center><hr>";
   	  	print "<form name='' action='glav.php?lnk=redactor&step=2&n=$n&pid=$pid' method='post'>\n";
        print "<center><input type='submit' value='�����'></center>\n";
        print "</form>\n";
   	  }
   	  elseif($n=="")
   	  {   	  	print "<br /><br /><br /><br /><hr><center>���������� ������� ���������� ��������.</center><hr>";
   	  	print "<form name='' action='glav.php?lnk=redactor&step=2&tname=$tname&pid=$pid' method='post'>\n";
        print "<center><input type='submit' value='�����'></center>\n";
        print "</form>\n";
   	  }
   	  else
   	 { print "<form name='redact' action='glav.php?lnk=redactor&step=4' method='post'>";
   	  for($i=1;$i<=$n;$i++)
   	    {   	       {print "
   	       <table align='center' vlign='midle' width='70%'>
   	       <tr>
   	       <td><center><b>������ $i: </b></center></td>
   	       </tr>
   	       <tr>
   	       <td><center>����� �������:</center></td>
           <td><center><textarea class='text' name='ttext$i' rows=5 cols=50 wrap='on'></textarea></center></td>
           </tr>
           <tr>
           <td><center>�������� ������:</center></td>
           <td><center><textarea id='$i' class='text' name='totvet$i' rows=10 cols=50 wrap='on' onClick='javascript:redactor($i)' onKeyUp='javascript:redactor_up($i)' onKeyDown='javascript:redactor_down($i)' onFocus='javascript:redactor($i)' onBlur='javascript:redactor_blur($i)'></textarea></center></td>
           </tr>
           <tr>
           <td><center>���������� ������(����� �������, ��� ��������)</center></td>
           <td><center><input name='otvet$i' type='text' value=''></center></td>
           </tr>
   	       ";}

   	    }
   	  print "<input name='tname' type='hidden' value='$tname'>";
   	  print "<input name='n' type='hidden' value='$n'>";
   	  print "<input name='pid' type='hidden' value='$pid'>";
   	  print "<tr><td colspan='2'><center><input type='submit' value='�����'></center></td></tr>\n";
   	  print "</form>";
   	  print "</table>\n";
   }
     }
   elseif($step==4)
   {      $tname=$_POST['tname'];
   	  $n=$_POST['n'];
   	  $uid=$_SESSION['id'];
   	  $pid=$_POST['pid'];
   	  $q1="INSERT INTO `tests` VALUES (0, $pid, $uid, '$tname')";
   	  mysql_query($q1);
   	  $q2="SELECT * FROM `tests` WHERE `name` = '$tname'";
   	  $q22=mysql_query($q2);
   	  while($row=mysql_fetch_array($q22))
   	   {   	   	$testsid=$row[0];
   	   }
   	  for($i=1;$i<=$n;$i++)
   	  {   	   $ttext=$_POST["ttext$i"];
   	   $totvet=$_POST["totvet$i"];
   	   $otvet=$_POST["otvet$i"];
   	   //$ttext1=nl2br($ttext);    ������ ������� ����
   	   $q3="INSERT INTO `text_test` VALUES (0, '$testsid', '$ttext', '$totvet', '$otvet')";
   	   mysql_query($q3) or die(mysql_error());
      }
           print "<br /><br /><br /><br /><hr><center>���� ������!</center><hr>\n";
   	   print "<meta http-equiv='refresh' content='3; url=glav.php?lnk=redactor'>\n";

   }
   elseif($step=="droptest")
   {   	$tid=$_GET['tid'];
   	{print "
   	<table align='center' vlign='midle' cellpadding='7' width='70%'>
   	<tr>
   	<td colspan='2'><center>��������! ��� ���������� ����� ����� ������� �� ���� ������,</center></td>
   	</tr>
   	<tr>
   	<td colspan='2'><center>� ��� ����� � �������. �� �������?</center></td>
   	</tr>
   	<tr>
   	<td><center><a href='glav.php?lnk=redactor&step=droptestyes&tid=$tid'>��</a></center></td>
   	<td><center><a href='glav.php?lnk=redactor&step=1'>���</a></center></td>
   	</tr>
   	</table>
   	";}
   }
   elseif($step=="droptestyes")
   {   	 $tid=$_GET['tid'];   	 mysql_query("DELETE FROM `text_test` WHERE `id_tests` = '$tid'") or die(mysql_error());
   	 mysql_query("DELETE FROM `tests` WHERE `id` = '$tid'");
   	 print "<meta http-equiv='refresh' content='0; url=glav.php?lnk=redactor'>\n";
   }
   elseif($step==5)
   {     {print "
     <div align='justify'>����� ��������� ����� ��� ���������� ��������� ������ �����������. ���� ��������� ������, ������� �������<br />
     ��������� ��� ��������� ����������� �����:<br />
     1) ��� �������� �������� ������ ������� ������������ ����� � ������� � ����� ������ ������ ��������.<br />
     2) ������ ������� ������ ���������� �������� ��������� � ���������� �� ������ ������������� �������.<br />
     3) ���������� ������ �� ������ ������ ������� ��������� � ����� &laquo;���������� ������&raquo; ����� �������, ��� ��������.<br />
     ���� ���������� ����� ����� ����, �� ������� ������� �� ���������.<br /><br />
     ���������� ��� ������� ������� � �������� � ���������� ����� ���� ������������ =)<br /></div><br /><br />
     <div align='center'><a href='glav.php?lnk=redactor&step=2'>����������</a></div>
     ";}
   }
}

?>

</body>

</html>