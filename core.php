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
if (isset($_COOKIE['YRAWTlogin']) && isset($_COOKIE['YRAWTpass']))
{
	if ($logon_source == "LocalSYS")
	{
 		if (GetLocalSystemCreds($_COOKIE['YRAWTlogin'],mcrypt_decrypt(MCRYPT_CRYPT,"YRAWT",$_COOKIE['YRAWTpass'],MCRYPT_MODE_CFB)) == 0)
		{
			$IS_ADMIN = true;
		}
  		else
  		{
			UnAuthenticate();
	 	}
  	}
}
else
{
	UnAuthenticate();
}
function register($imie,$nazwisko,$lok,$IP,$MAC)
{




}
function Authenticate($login, $passwd)
{
	require "config.php";
	if ($logon_source == "LocalSYS")
	{
		$ret = GetLocalSystemCreds($login,$passwd);
		if ($ret == 0)
		{
			// ATTENTION - this code stores constant key encrypted password to local system account for simplicity reasons, because I use PAM to check is user valid in local system, I can't safely compare inside YRAWT hashed passwords like in modern CMS-es developers do, besides YRAWT doesn't use database, where it could store safely admins password hashes and logins, also for simplicity reasons.
			// I'm plannig support for database - MySql. As of PAM it is one of the safest and most handy method to check credentials of local system administrator. PAM doesn't provide API function to get unencrypted password from shadow, which is ok., and secure, but complicates my script a bit ;)
			setcookie('YRAWTlogin',$login,time() + 60*10,'/');
			setcookie('YRAWTpass', mcrypt_encrypt(MCRYPT_CRYPT,"YRAWT",$passwd,MCRYPT_MODE_CFB),time() + 60*10,'/');
                        return 0;
		}
		else if ($ret == -2)
		{
			include $locale_path.$locale_lang."core.php";
			echo "<center><p>".$error_PAM_not_exist."</p></center>";
                        return -2;
		}
	}
}
function UnAuthenticate()
{
		setcookie('YRAWTlogin',"",time() - 3600,'/');
		setcookie('YRAWTpass', "",time() - 3600,'/');
		unset($IS_ADMIN);
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
	// This function requires PAM on local linux machine to be installed, and configured for use in php
	if (extension_loaded('PAM'))
	{
		if (pam_auth($login,$passwd) == true)
			$exitcode = 0;
		else
			$exitcode = -1;
	}
	else
	{
		$exitcode = -2;
	}
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
