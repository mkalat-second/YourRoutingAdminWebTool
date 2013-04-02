<?php
# Your Routing Admin Web Tool - web administration software for linux boxes
# Copyright 2013 by Marcin Kalat http://mkalat.pl
# This file is licensed under terms of GNU GPL v. 2 license. See http://www.gnu.org/licenses/gpl-2.0.html for details.

if (isset($_POST['imie']) && isset($_POST['nazwisko']) && isset($_POST['lokalizacja']) && isset($_POST['IP']) && isset($_POST['MAC']))
{
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $lok = $_POST['lokalizacja'];
    $IP = $_POST['IP'];
    $MAC = $_POST['MAC'];
    require "core.php";
    register($imie,$nazwisko,$lok,$IP,$MAC);
    
}
else
{
echo "<!DOCTYPE html>
    <html>
    <head>
        <title>YRAT - Add My computer to network</title>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
    </head>    
    <body>
        <form action='addcomp.php' method='POST'>
        <table>
        <tr><td>First Name</td><td><input type='text' name='imie'></td></tr>
        <tr><td>Last Name</td><td><input type='text' name='nazwisko'></td></tr>
        <tr><td>Adress</td><td><input type='text' name='lokalizacja'></td></tr>
        <tr><td><input type='hidden' name='IP' value='".$_SERVER['REMOTE_ADDR']."'></td></tr>";
        $ip = $_SERVER['REMOTE_ADDR'];
        exec('ping '.$ip.' -c 1');
        exec('sleep 2s');
        exec('arp '.$ip, $answer);
        $hostinfo = explode(" ", $answer[1]);
        $x=0;
        while(count($hostinfo[$x]) and !isset($mac)){
            if(eregi('([0-9a-f]{2}:[0-9a-f]{2}:[0-9a-f]{2}:[0-9a-f]{2}:[0-9a-f]{2}:[0-9a-f]{2})',$hostinfo[$x])){
                        $mac=$hostinfo[$x];
            }
            $x++;
        }
        echo "<tr><td><input type='hidden' name='MAC' value='".$mac."'></td></tr>
            <tr><td><input type='submit' value='Register to network'></td></tr>
        
        </table>
        </form>
    </body>
    
</html>";
}

?>