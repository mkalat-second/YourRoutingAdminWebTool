<?php
# Your Routing Admin Web Tool - web administration software for linux boxes
# Copyright 2013 by Marcin Kalat http://mkalat.pl
# This file is licensed under terms of GNU GPL v. 2 license. See http://www.gnu.org/licenses/gpl-2.0.html for details.
require "core.php";
require $locale_path.$locale_lang."index.php";
echo "<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
        <title>".$title_chars."</title>
    </head>
    <body>
        <center>
            <table>
                <tr><td>".$label_selLog."</td></tr>";
		if ($enable_register=="yes")
		{
                    echo "<tr><td><a href=\"addcomp.php\">".$label_opt1."</a></td></tr>";
		}
		echo "<tr><td><a href=\"login.php\">".$label_opt2."</a></td></tr>
            </table>

        </center>
   </body>
</html>";
?>
