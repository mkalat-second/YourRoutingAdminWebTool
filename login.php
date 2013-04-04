<?php
require "core.php";
if (!isset($_COOKIE['YRAWTlogin']) && !isset($_POST['login']) && !isset($_POST['pass']))
{
	require $locale_path.$locale_lang."login.php";
 	echo "<!DOCTYPE html>
	<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
        <title>".$title_chars."</title>
    </head>
    <body>
	 <form action=\"login.php\" method=\"POST\">
	 <table>
	 <tr><td>".$label_formtitle."</td></tr>
	 <tr><td>".$label_login."</td><td><input type=\"text\" name=\"login\"></td></tr>
	 <tr><td>".$label_passwd."</td><td><input type=\"password\" name=\"pass\"></td></tr>
	 <tr><td><input type=\"submit\" value='".$label_btn."'></td></tr>
	 </table>
	 </form>
	 </body>
	 </html>
	";
}
else if (!isset($COOKIE['YRAWTlogin']) && isset($_POST['login']) && isset($_POST['pass']))
{
	if (Authenticate($_POST['login'],$_POST['pass']) == 0)
	{
		redirect($root_dir."/admin/index.php");
	}
	else
	{
		redirect($root_dir."/index.php");
	}
}
else if (isset($IS_ADMIN) && isset($COOKIE['YRAWTlogin']))
{
	redirect($root_dir."/admin/index.php");
}
else
{
	die("Access Denied");
}
?>
