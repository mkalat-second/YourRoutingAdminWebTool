<?php
# Your Routing Admin Web Tool - web administration software for linux boxes
# Copyright 2013 by Marcin Kalat http://mkalat.pl
# This file is licensed under terms of GNU GPL v. 2 license. See http://www.gnu.org/licenses/gpl-2.0.html for details.

if (!isset($IN_SYS)) die("Access Denied");
require "config.php";
//find the root-dir


//set locale variables

$locale_path = $root_dir."/locale/";
$locale_lang = $locale."/";




function register($imie,$nazwisko,$lok,$IP,$MAC)
{




}
function Authenticate($login, $passwd)
{



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
function GetLocalSystemCreds($login, $passwd, $algo)
{


    return $exitcode;
}

?>
