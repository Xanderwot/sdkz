<?php
session_start();
$uid=$_SESSION['id'];
$authlevel=$_SESSION['authlevel'];
if($authlevel=="1")
{
   $rrr=mysql_query("SELECT * FROM `dostup` WHERE `id_user` = '$uid'");
   $error=mysql_num_rows($rrr);
   if ($error==0)
    {
      print "<br /><br /><br /><hr><center>” вас нет допуска к тестированию</center><hr>\n";
    }
   else
    {      $uid=$_SESSION['id'];
$vremya=time();
$vremya=$vremya+1800;
$rer=mysql_query("SELECT * FROM `dostup` WHERE `id_user` = '$uid' LIMIT 1");
while($row=mysql_fetch_array($rer))
  {
    $fert=$row[2];
    $gtid=$row[1];
  }
if($fert=="")
{
   mysql_query("UPDATE `dostup` SET `end_time` = '$vremya' WHERE `id_user` = '$uid' AND `id_test` = '$gtid'");
}
else
{

}
$rer=mysql_query("SELECT * FROM `dostup` WHERE `id_user` = '$uid' AND `id_test` = '$gtid'");
while($row=mysql_fetch_array($rer))
  {
    $fert=$row[2];
  }
$rer=mysql_query("SELECT * FROM `dostup` WHERE `id_user` = '$uid' AND `id_test` = '$gtid'");
$segodnya=time();
$left_time=$fert-$segodnya;
print "<body onLoad='countdown($left_time)'>";
print "<center><font size='3'><b>“естирование закончитс€ через:</b></font></center>";
print "<div id='h_txt_time' align='center'>—тарт</div>\n";
$q=mysql_query("SELECT * FROM `gotov_test` WHERE `id` = '$gtid'");
while($row=mysql_fetch_array($q))
  {
   $gtname=$row[1];
   $gtvopros=$row[2];
  }
$gt_arr=explode(";",$gtvopros);
$num_str=strlen($gtvopros);
for($i=0;$i<=$num_str;$i++)
  {
   if($gt_arr[$i]=="")
     {
    	$kol=$i;
    	break;
     }
   else
     {
       //должно быть пусто
     }
  }
$num_test=$kol/2;
$m=1;
print "<table align='center' valign='midle' cellpaddind='7' width='70%'>";
print "<form name='forma' action='glav.php?lnk=action' method='post'>\n";
for($i=0;$i<=$num_test;$i=$i+2)
  {
    $tid=$gt_arr[$i];
    $num_vopros=$gt_arr[$i+1];
    $q=mysql_query("SELECT * FROM `text_test` WHERE `id_tests` = '$tid'");
    $j=0;
    //$tvopros="";
    //$tvariant="";
    //$totvet="";
    while($row=mysql_fetch_array($q))
      {
       $testid[$j]=$row[0];
       $tvopros[$j]=$row[2];
       $vtest[$j]=$row[3];
       $totvet[$j]=$row[4];
       $j++;
      }
    for($v=0;$v<=$j-1;$v++)    //$v - переменна€ случайных чисел
      {
       	$num[$v]=$v;
      }
    shuffle($num);
    for($v=0;$v<$num_vopros;$v++)
      {
        $h=$num[$v];
        $vopros=nl2br($tvopros[$h]);
        $tid=$testid[$h];
        print "<tr class='shapka'><td><center>“екст вопроса:</center></td><td vlign='middle'><br />";
        print $vopros;
        print "<br /><br /></td><tr> \n";
        $vtests=$vtest[$h];
        //print $vtests."<br />";
        $otvets=$totvet[$h];
        //print $otvets."<br />";
        $n_otvets=strlen($otvets); //проверка на check или radio
        $temp=strlen($vtests);
        print "<tr class='shapka'><td><center>¬арианты ответов:</center></td><td> \n";
        if ($n_otvets==1)
          {
          	$n=0;  //позици€ с которой начинать искать
          	$nomer=1;
         	for($x=0;$x<=$temp;$x++)
         	  {
         	    $n1=strpos($vtests,")",$n);
         	    if (! $n1)
         	      {
         	    	break;
         	      }
         	    else
         	      {
         	        $n2=strpos($vtests,";",$n);
         	        $n=$n2+1;
         	        $n3=$n2-$n1;   //сколько знаков между скобкой и точкой с зап€той
         	        $prin_variants=substr($vtests,$n1+1,$n3-1);
         	        $page = "<input name='radio$m$v' type='radio' value='$nomer' >";
         	        $page .= $prin_variants;
         	        $page .= "<br /> \n";
         	        print $page;
         	      }
         	    $nomer++;
         	  }
          }
        else
          {
            $n=0;  //позици€ с которой начинать искать
          	$nomer=1;
         	for($x=0;$x<=$temp;$x++)
         	  {
         	    $n1=strpos($vtests,")",$n);
         	    if (! $n1)
         	      {
         	    	break;
         	      }
         	    else
         	      {
         	        $n2=strpos($vtests,";",$n);
         	        $n=$n2+1;
         	        $n3=$n2-$n1;   //сколько знаков между скобкой и точкой с зап€той
         	        $prin_variants=substr($vtests,$n1+1,$n3-1);
         	        $page = "<input name='input$m$v$nomer' type='checkbox' value='$nomer'> \n";
         	        $page .= $prin_variants;
         	        $page .= "<br />";
         	        print $page;
         	      }
         	    $nomer++;
         	  }
          }
        print "<input name='tid$m$v' type='hidden' value='$tid'>\n";
        print "</td></tr>";
        print "<tr class='shapka'><td colspan='2'><hr></td></tr>";
      }
   print "<input name='kolich$m' type='hidden' value='$v'>\n";
   $m++;
  }
  $m--;
  print "<input name='itog' type='hidden' value='$m'>\n";
  print "<input name='gtid' type='hidden' value='$gtid'>\n";
  print "<tr class='shapka'><td colspan='2'><hr></td></tr>";
  print "<tr class='shapka'><td colspan='2'><center><input id='butt' type='submit' value='ќтветить'></center></td></tr>";
  print "</form>";
  print "</table>";
    }
}
else
{
$rrr=mysql_query("SELECT * FROM `dostup` WHERE `id_user` = '$uid'");
$error=mysql_num_rows($rrr);
if ($error==0)
{  print "<br /><br /><br /><hr><center>” вас нет допуска к тестированию</center><hr>\n";
}
else
{
$gtid=$_GET['gtid'];
$uid=$_SESSION['id'];
$vremya=time();
$vremya=$vremya+1800;
$rer=mysql_query("SELECT * FROM `dostup` WHERE `id_user` = '$uid'");
while($row=mysql_fetch_array($rer))
  {    $fert=$row[2];
  }
if($fert=="")
{
   mysql_query("UPDATE `dostup` SET `end_time` = '$vremya' WHERE `id_user` = '$uid'");
}
else
{

}
$rer=mysql_query("SELECT * FROM `dostup` WHERE `id_user` = '$uid'");
while($row=mysql_fetch_array($rer))
  {
    $fert=$row[2];
  }
$rer=mysql_query("SELECT * FROM `dostup` WHERE `id_user` = '$uid'");
$segodnya=time();
$left_time=$fert-$segodnya;
print "<body onLoad='countdown($left_time)'>";
print "<center><font size='3'><b>“естирование закончитс€ через:</b></font></center>";
print "<div id='h_txt_time' align='center'>—тарт</div>\n";
$q=mysql_query("SELECT * FROM `gotov_test` WHERE `id` = '$gtid'");
while($row=mysql_fetch_array($q))
  {   $gtname=$row[1];
   $gtvopros=$row[2];
  }
$gt_arr=explode(";",$gtvopros);
$num_str=strlen($gtvopros);
for($i=0;$i<=$num_str;$i++)
  {   if($gt_arr[$i]=="")
     {    	$kol=$i;
    	break;
     }
   else
     {       //должно быть пусто
     }
  }
$num_test=$kol/2;
$m=1;
print "<table align='center' valign='midle' cellpaddind='7' width='70%'>";
print "<form name='forma' action='glav.php?lnk=action' method='post'>\n";
for($i=0;$i<=$num_test;$i=$i+2)
  {    $tid=$gt_arr[$i];
    $num_vopros=$gt_arr[$i+1];
    $q=mysql_query("SELECT * FROM `text_test` WHERE `id_tests` = '$tid'");
    $j=0;
    //$tvopros="";
    //$tvariant="";
    //$totvet="";
    while($row=mysql_fetch_array($q))
      {       $testid[$j]=$row[0];       $tvopros[$j]=$row[2];
       $vtest[$j]=$row[3];
       $totvet[$j]=$row[4];
       $j++;
      }
    $num="";
    for($v=0;$v<=$j-1;$v++)    //$v - переменна€ случайных чисел
      {       	$num[$v]=$v;
      }
    shuffle($num);
    for($v=0;$v<$num_vopros;$v++)
      {        $h=$num[$v];
        $vopros=nl2br($tvopros[$h]);
        $tid=$testid[$h];
        print "<tr class='shapka'><td><center>“екст вопроса:</center></td><td vlign='middle'><br />";
        print $vopros;
        print "<br /><br /></td><tr> \n";
        $vtests=$vtest[$h];
        //print $vtests."<br />";
        $otvets=$totvet[$h];
        //print $otvets."<br />";
        $n_otvets=strlen($otvets); //проверка на check или radio
        $temp=strlen($vtests);
        print "<tr class='shapka'><td><center>¬арианты ответов:</center></td><td> \n";
        if ($n_otvets==1)
          {          	$n=0;  //позици€ с которой начинать искать
          	$nomer=1;         	for($x=0;$x<=$temp;$x++)
         	  {         	    $n1=strpos($vtests,")",$n);
         	    if (! $n1)
         	      {         	    	break;
         	      }
         	    else
         	      {
         	        $n2=strpos($vtests,";",$n);
         	        $n=$n2+1;
         	        $n3=$n2-$n1;   //сколько знаков между скобкой и точкой с зап€той
         	        $prin_variants=substr($vtests,$n1+1,$n3-1);
         	        $page = "<input name='radio$m$v' type='radio' value='$nomer' >";
         	        $page .= $prin_variants;
         	        $page .= "<br /> \n";
         	        print $page;
         	      }
         	    $nomer++;
         	  }
          }
        else
          {            $n=0;  //позици€ с которой начинать искать
          	$nomer=1;
         	for($x=0;$x<=$temp;$x++)
         	  {
         	    $n1=strpos($vtests,")",$n);
         	    if (! $n1)
         	      {
         	    	break;
         	      }
         	    else
         	      {
         	        $n2=strpos($vtests,";",$n);
         	        $n=$n2+1;
         	        $n3=$n2-$n1;   //сколько знаков между скобкой и точкой с зап€той
         	        $prin_variants=substr($vtests,$n1+1,$n3-1);
         	        $page = "<input name='input$m$v$nomer' type='checkbox' value='$nomer'> \n";
         	        $page .= $prin_variants;
         	        $page .= "<br />";
         	        print $page;
         	      }
         	    $nomer++;
         	  }
          }
        print "<input name='tid$m$v' type='hidden' value='$tid'>\n";
        print "</td></tr>";
        print "<tr class='shapka'><td colspan='2'><hr></td></tr>";
      }
   print "<input name='kolich$m' type='hidden' value='$v'>\n";
   $m++;
  }
  $m--;
  print "<input name='itog' type='hidden' value='$m'>\n";
  print "<input name='gtid' type='hidden' value='$gtid'>\n";
  print "<tr class='shapka'><td colspan='2'><hr></td></tr>";
  print "<tr class='shapka'><td colspan='2'><center><input id='butt' type='submit' value='ќтветить'></center></td></tr>";
  print "</form>";
  print "</table>";
}
}
?>

</body>

</html>