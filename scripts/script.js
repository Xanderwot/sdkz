    function menu()
      {      	s=document.getElementById('block');
      	d=s.options[s.selectedIndex].value;
        location.replace('glav.php?lnk=componovka&step=2&pid=' +d);
      }
    function max_value (n,j)
      {
        document.getElementById(j).value = n;
      }
      function countdown(left_time)
    {
    left_time--;
    temp_time = left_time / 60;
    n=left_time;
    min_time = Math.floor(temp_time);
    sec_time = left_time - min_time * 60;
    if (min_time<10) {min_0time="0"}
    else {min_0time=""}
    if (sec_time<10) {sec_0time="0"}
    else {sec_0time=""}
    document.getElementById('h_txt_time').innerHTML= "<center><h1>"+min_0time+min_time+":"+sec_0time+sec_time+"</h1></center>";
    //document.getElementById('h_txt_time').innerText = min_0time+min_time+":"+sec_0time+sec_time;
    // думаю еще насчет цвета)
    document.getElementById('h_txt_time').style.color='#FFFFFF';
    if (left_time <= 0)
        {
        //document.getElementById('h_txt_time').innerText=' редирект ';
        document.forma.submit();

        }  else setTimeout('countdown(n)', 1000);
    }

    function createObject() {
var request_type;
var browser = navigator.appName;
if(browser == "Microsoft Internet Explorer"){
request_type = new ActiveXObject("Microsoft.XMLHTTP");
} else {
request_type = new XMLHttpRequest();
}
return request_type;
}

var http = createObject();

/* -------------------------- */
/*        SEARCH              */
/* -------------------------- */
function searchNameq() {
searchq = encodeURI(document.getElementById('input_id').value);
//document.getElementById('msg').style.display = "block";
//document.getElementById('msg').innerHTML = "Searching for <strong>" + searchq+"";
// Set te random number to add to URL request
nocache = Math.random();
http.open('get', 'temp.php?id='+searchq);
http.onreadystatechange =  searchNameqReply;
http.send(null);
}
function searchNameqReply() {
if(http.readyState == 4){
var response = http.responseText;
document.getElementById('div_id').innerHTML = response;
}
}

function KeyEvent()
{  log=document.getElementById('log');
  pas=document.getElementById('pas');
  n=pas.value.length;
  if(log.value=='')
    {       document.getElementById('err_login').innerHTML="<font color=red size='2'>Введите логин</font>";   	   document.getElementById('inpb').innerHTML="<input type='submit' value='Вход' DISABLED>";
    }
  else
    {   	   if(pas.value=='')
         {
            document.getElementById('login_err').innerHTML="<font color=red size='2'>Введите пароль</font>";
   	        document.getElementById('inpb').innerHTML="<input type='submit' value='Вход' DISABLED>";
   	        document.getElementById('err_login').innerHTML="";
         }
       else
   	     {
   	        if(n<8)
   	         {   	           document.getElementById('login_err').innerHTML="<font color=red size='2'>от 8 до 16 символов</font>";   	           document.getElementById('inpb').innerHTML="<input type='submit' value='Вход' DISABLED>";
   	           document.getElementById('err_login').innerHTML="";
   	         }
   	        else
   	         {   	           if(n>16)
   	             {
   	                document.getElementById('login_err').innerHTML="<font color=red size='2'>от 8 до 16 символов</font>";   	               	document.getElementById('inpb').innerHTML="<input type='submit' value='Вход' DISABLED>";
   	               	document.getElementById('err_login').innerHTML="";
   	             }
   	           else
   	             {   	                document.getElementById('inpb').innerHTML="<input type='submit' value='Вход'>";
   	                document.getElementById('login_err').innerHTML="";
   	                document.getElementById('err_login').innerHTML="";
   	             }
   	         }
   	     }
    }
}
function testing()
{
  log=document.getElementById('log').value;
  num=log.length;
  max=0;
  for(i=0;i<=num;i++)
   {   	 proverka=log.charCodeAt(i);
   	 if(proverka>max)
   	  {   	    max=proverka;
   	  }
   }

  if(max>122)
   {   	 document.getElementById('rus').innerHTML="<font color=red size='2'>Можно использовать только латинские символы и цифры</font>";
   }
  else
   {   	 document.getElementById('rus').innerHTML="";
   }
}
function testing_p()
{  pas=document.getElementById('pas').value;
  num=pas.length;
  max=0;
  for(i=0;i<=num;i++)
   {
   	 proverka=pas.charCodeAt(i);
   	 if(proverka>max)
   	  {
   	    max=proverka;
   	  }
   }

  if(max>122)
   {
     document.getElementById('pas').value="";
   	 alert('Можно использовать только латинские символы и цифры');
   }
}
function redactor(tid)
{
  presskey=window.event.keyCode;
  tem=document.getElementById(tid);
  num=tem.value.length;
  if(num==0)
   {   	  tem.value+="1)";
   }
}
function redactor_up(tid)
{
  presskey=window.event.keyCode;
  tem=document.getElementById(tid);  if(presskey==13)
   	   {
   	   	  n=tem.value.lastIndexOf(')');
   	   	  cifra=tem.value.substring(n-1,n);
   	   	  celoe=parseInt(cifra,10);
   	   	  cel=celoe+1;
   	   	  tem.value+=cel+")";
   	   }
}
function redactor_down(tid)
{
  presskey=window.event.keyCode;
  tem=document.getElementById(tid);
  toch=tem.value.lastIndexOf(';');
  len=tem.value.length;
  leng=len-1;
  if(presskey==13)
    {      if(toch==leng)
       {}
      else
       {       	 tem.value+=";";
       }
    }
}
function redactor_blur(tid)
{  tem=document.getElementById(tid);
  toch=tem.value.lastIndexOf(';');
  len=tem.value.length;
  leng=len-1;
  if(len==0)
   {
   }
  else
   {
     if(toch==-1)
      {        tem.value+=";";
      }
     else
      {
        if(toch==leng)
         {

         }
        else
         {         	tem.value+=";";
         }
      }
   }
}
function notcomplite()
{ alert('Данная опция еще не реализована');
}