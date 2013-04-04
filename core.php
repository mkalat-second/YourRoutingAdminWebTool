<?php
# Your Routing Admin Web Tool - web administration software for linux boxes
# Copyright 2013 by Marcin Kalat http://mkalat.pl
# Code for redirect function and finding root_dir by Author: Nick Jones (Digitanium)
# This file is licensed under terms of GNU GPL v. 2 license. See http://www.gnu.org/licenses/gpl-2.0.html for details.

require "config.php";
//find the root-dir
$folder_level = ""; $i = 0;
while (!file_exists($folder_level."config.php")) {
	$folder_level .= "../"; $i++;
	if ($i == 7) { die("config.php file not found"); }
}
$root_dir = $folder_level;
//set locale variables
$locale_path = $root_dir."/locale/";
$locale_lang = $locale."/";
//finding if user is admin
if (isset($_COOKIE['YRAWTlogin']))
{
	$logon_cookie[] = $_COOKIE['YRAWTlogin'];
	if ($logon_source == "LocalSYS")
	{
 		if (GetLocalSystemCreds($logon_cookie['login'],$logon_cookie['pass']) == 0)
		{
			$IS_ADMIN = true;
		}
		else
		{
			unset($IS_ADMIN);
		}
	}
}
else
{
	unset($IS_ADMIN);
}
function register($imie,$nazwisko,$lok,$IP,$MAC)
{




}
function Authenticate($login, $passwd)
{
	if ($logon_source == "LocalSYS")
	{
		if (GetLocalSystemCreds($login,$passwd) == 0)
		{
			setcookie("YRAWTlogin[login]",$login,time() + 60*10);
			if ($loc_sys_shadow_algo == "md5")
			{
				setcookie("YRAWTlogin[pass]",Md5($passwd),time() + 60*10);
			}
			else
			{
				setcookie("YRAWTlogin[pass]",$passwd,time() + 60*10);
			}
		}
	}
}
function StripHTMLPHP($value)
{



    return $stripped;
}
function ValidateShellInput($value)
{


    return $validated;
}
function SendMail($from,$rcpt,$topic,$cc)
{


    return $exitcode;
}
function GetLocalSystemCreds($login, $passwd, $algo = null)
{


    return $exitcode;
}

function redirect($location, $script = false) {
	if (!$script) {
		header("Location: ".str_replace("&amp;", "&", $location));
		exit;
	} else {
		echo "<script type='text/javascript'>document.location.href='".str_replace("&amp;", "&", $location)."'</script>\n";
		exit;
	}
}

?>
