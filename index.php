<?php
if (filesize("config.php") == 0)
{	header("location: install/index.php");
}
else
{    header("location: login.php");
}
?>