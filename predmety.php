<?php
session_start();include("includes/include.php");
$authlevel=$_SESSION['authlevel'];
if ($authlevel==1)
{
print "<meta http-equiv='refresh' content='0; url=login.php'>";
}
else
{	$reason=$_GET['reason'];	if ($reason=="")
	{      print "<div align=\"center\">������ ��������� ��� ������������</div><br />\n";
      $q1=mysql_query("SELECT * FROM `predmet`");
      $n=mysql_num_rows($q1);
        if ($n==0)
          {            print "<div align=\"center\"><font color='#FF0000'>� ���� �� ���������� �� ������ ��������</font></div><br />\n";
            print "<div align=\"center\"><a href='glav.php?lnk=predmety&reason=create'>�������</a></div>\n";
          }
        else
          {          	print "<center>\n";
            print "<table align='center' valign='middle' cellpadding='7' width='70%'>\n";
            while($row=mysql_fetch_array($q1))
            {              $row[1]=ucfirst($row[1]);   	          {print "<tr class='tr' $styletr>\n
   	          <td><center>$row[1]</center></td>
   	          <td><center><a href='glav.php?lnk=predmety&pid=$row[0]&reason=edit'>�������������</a></center></td>\n
   	          <td><center><a href='glav.php?lnk=predmety&pid=$row[0]&reason=drop'>�������</a></center></td>\n   	  	      </tr>\n";}
            }
            print "</table>\n";
            print "<br /><br /><a href='glav.php?lnk=predmety&reason=create'>�������� ����� �������</a>\n";
            print "<center>\n";
          }
    }
    elseif ($reason=="create")
       {       print "<center>\n";       print "<pre>\n";
       print "   <form name='' action='glav.php?lnk=predmety&reason=done' method='post'>\n";
       print "   ������� �������� ��������  <input name=\"pname\" type=\"text\" size='50' value=\"\">\n";
       print "                              <input type=\"submit\" value=\"������\">\n";
       print "   </form>\n";
       print "   </pre>\n";
       print " </center>\n";
       }
    elseif ($reason=="done")
       {       $pname=$_POST['pname'];
       $pname=strtolower($pname);
       $testing=mysql_query("SELECT * FROM `predmet` WHERE `name` = '$pname'");
       $oshibka=mysql_num_rows($testing);
       if($oshibka==0)
       {         $q2="INSERT INTO `predmet` VALUES (0, '$pname')";
         mysql_query($q2);
         print "<meta http-equiv='refresh' content='0; url=glav.php?lnk=predmety'>";
       }
       else
       {       	 print "<div align='center'>������ ������� ��� ����������, ��� �� ������������ ����������� �������<br><a href='glav.php?lnk=predmety'>�����</a></div>";
       }
       }
    elseif ($reason=="edit")
       {        $pid=$_GET['pid'];
        $q3=mysql_query("SELECT * FROM `predmet` WHERE `id` = $pid");
        print "<form name='' action='glav.php?lnk=predmety&pid=$pid&reason=editdone' method='post'>\n";
        while($row=mysql_fetch_array($q3))
          {          print "<center><br /><br /><br />\n";          print "�������� ��������  <input name='pname' type='text' size='50' value='$row[1]'>\n";
          }
        print "<input type='submit' value='������'>\n";
        print "</center>\n";
        print "</form>\n";
       }
    elseif ($reason=="editdone")
       {        $pid=$_GET['pid'];
        $pname=$_POST['pname'];
        $pname=strtolower($pname);
        $testing=mysql_query("SELECT * FROM `predmet` WHERE `name` = '$pname'");
        $oshibka=mysql_num_rows($testing);
        if($oshibka==0)
        {
          $q3="UPDATE `predmet` SET `name` = '$pname' WHERE `predmet`.`id` = '$pid'";
          mysql_query($q3);
          print "<meta http-equiv='refresh' content='0; url=glav.php?lnk=predmety'>";
        }
        else
        {           print "<div align='center'>������ ������� ��� ����������, ��� �� ������������ ����������� �������<br><a href='glav.php?lnk=predmety'>�����</a></div>";
        }
       }
    elseif ($reason=="drop")
       {
         $pid=$_GET['pid'];
         $q4=mysql_query("SELECT * FROM `predmet` WHERE `id` = '$pid'");
         while ($row=mysql_fetch_array($q4))
          {          	$pname=$row[1];          }
         print "<br /><br /><br /><br />\n";
         print "<table align='center' valign='midle' cellpaddind='7' width='70%'>\n";
         print "<tr>\n";
         print "<td colspan='2'><center>������������� ������� ������� &laquo;$pname&raquo; �� ������?</center><td>\n";
         print "</tr>\n";
         print "<tr>\n";       	 print "<td><center><a href='glav.php?lnk=predmety&pid=$pid&reason=dropyes'>��</a></center></td>\n";
       	 print "<td><center><a href='glav.php?lnk=predmety'>���</a></center></td>\n";
       	 print "</tr>\n";
       	 print "</table>\n";
       }
    elseif ($reason=="dropyes")
      {      	$pid=$_GET['pid'];
       	$q3="DELETE FROM `predmet` WHERE `id` = '$pid'";
       	mysql_query($q3);
       	print "<meta http-equiv='refresh' content='0; url=glav.php?lnk=predmety'>";
      }
}

?>