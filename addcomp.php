<?php
# Your Routing Admin Web Tool - web administration software for linux boxes
# Copyright 2013 by Marcin Kalat http://mkalat.pl
# Portions of code (obtaining mac of client computer) is taken from http://piotr.kwiatek.org/2008/11/02/php-pobieranie-adresu-mac/
# This file is licensed under terms of GNU GPL v. 2 license. See http://www.gnu.org/licenses/gpl-2.0.html for details.
$IN_SYS = true;
require "core.php";
require $locale_path.$locale_lang."addcomp.php";
if (isset($_POST['imie']) && isset($_POST['nazwisko']) && isset($_POST['lokalizacja']) && isset($_POST['IP']) && isset($_POST['MAC']))
{
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $lok = $_POST['lokalizacja'];
    $IP = $_POST['IP'];
    $MAC = $_POST['MAC'];
    $IN_SYS = true;

	 $ret = register($imie,$nazwisko,$lok,$IP,$MAC);
    if ($ret == 0)
	 {
	 	echo "<!DOCTYPE html>
    <html>
    <head>
        <title>".$title_char."</title>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
    </head>
    <body>
	 <center></center><p>".$comm_newly_added."</p></center>
	 </body>

	 </html>
	 ";

	 }
	 else if ($ret == -1)
	 {
	 	echo "<!DOCTYPE html>
    <html>
    <head>
        <title>".$title_char."</title>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
    </head>
    <body>
	 <center><p>".$comm_banned."</p></center>
	 </body>

	 </html>
	 ";

	 }
	 else if ($ret == -2)
	 {
	 	echo "<!DOCTYPE html>
    <html>
    <head>
        <title>".$tile_char."</title>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
    </head>
    <body>
	 <center><p>".$comm_already_added."</p></center>
	 </body>

	 </html>
	 ";

	 }
}
else
{
echo "<!DOCTYPE html>
    <html>
    <head>
        <title>".$title_char."</title>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
    </head>
    <body>
        <form action='addcomp.php' method='POST'>
        <table>
        <tr><td>".$label_FirstName."</td><td><input type='text' name='imie'></td></tr>
        <tr><td>".$label_Surame."</td><td><input type='text' name='nazwisko'></td></tr>
        <tr><td>".$label_Adress."</td><td><input type='text' name='lokalizacja'></td></tr>
        <tr><td><input type='hidden' name='IP' value='".$_SERVER['REMOTE_ADDR']."'></td></tr>";
        $ip = $_SERVER['REMOTE_ADDR'];
        exec('ping '.$ip.' -c 1');
        exec('sleep 2s');
        exec('arp '.$ip, $answer);
        $hostinfo = explode(" ", $answer[1]);
        $x=0;
        $mac = 0;
        while(count($hostinfo[$x]) and !isset($mac)){
            if(eregi('([0-9a-f]{2}:[0-9a-f]{2}:[0-9a-f]{2}:[0-9a-f]{2}:[0-9a-f]{2}:[0-9a-f]{2})',$hostinfo[$x])){
                        $mac=$hostinfo[$x];
            }
            $x++;
        }
        echo "<tr><td><input type='hidden' name='MAC' value='".$mac."'></td></tr>
            <tr><td><input type='submit' value='".$label_SubmitBtn."'></td></tr>

        </table>
        </form>
    </body>

</html>";
}

?>
