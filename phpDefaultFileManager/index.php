<!doctype html>
<?php
/*
 * The contents of this file are subject to the terms of the
 * Common Development and Distribution License, Version 1.0 only
 * (the "License").  You may not use this file except in compliance
 * with the License.
 *
 * See the file LICENSE in this distribution for details.
 * A copy of the CDDL is also available via the Internet at
 * http://www.opensource.org/licenses/cddl1.txt
 *
 * When distributing Covered Code, include this CDDL HEADER in each
 * file and include the contents of the LICENSE file from this
 * distribution.
 */
?>
<html>
    <head>
        <title>tuxproject.de :: Set Default File Manager</title>
        <link rel="stylesheet" href="style.css" />
        <meta name="keywords" lang="en" content="default file manager, Windows, change" />
        <meta name="keywords" lang="de" content="Standard Dateimanager, Windows, ändern" />
    </head>
    <body>
        <h1>Create a .reg file to set your default file manager on Windows</h1>

<?php
    if (isset($_POST["mode"]) && $_POST['mode'] == "createfile") {
        // erzeuge .reg-datei und un.reg-datei
        include("createfile.php");
        // es wurde eine neue Datei erstellt, zeige sie an :-)
        echo "<div class=\"newfile\">";
        echo "Your .reg files have been created! Download them here:<br />";
        echo "<a href=\"$zipfilename\">" . $zipfilename . "</a>";
        echo "</div><br /><br />";
    }
?>

        <div id="infobox"><b>Updated March 28, 2021: Fixed the empty page problem.</b><br />
        <br />
        <b>This script is <a href="https://code.rosaelefanten.org/php-default-file-manager">Open Source</a>.</b><br />
        <br />
        Using this script, you can easily assign your folders to any file manager, even to those which don't actually support it by default. Two .reg files (compatible with Windows 2000 and newer) will be created, one that associates all folders with your chosen file manager and one that restores the Windows Explorer associations if something went wrong. To apply them, perform a double-click on them.<br />
        <br />
        Note that I can't take any responsibility for possible errors when using the .reg files. Read your favorite file manager's manual if you don't know the exact parameters!<br />
        <br />
        Your generated files will be kept for 3 days.<br />
        <br />
        Any issues occurring or urgently pleading for 9x-compatible .reg files? Please contact me!</div>

<?php
    include("form.inc");
?>
    <div style="font-size:11px;border:1px solid black;border-radius:5px;background-color:lightgrey;padding:5px 5px 5px 5px;position:fixed;bottom:5px;right:5px;text-align:center;">
    <b>Help me pay my server dues!</b><br>
    <br>
    <a href="http://flattr.com/thing/275170/php-Default-File-Manager" target="_blank">
    <img src="http://api.flattr.com/button/flattr-badge-large.png" alt="Flattr this" title="Flattr this" border="0" /></a><br>
    <br>
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_s-xclick">
    <input type="hidden" name="hosted_button_id" value="8634980">
    <input type="image" src="https://tuxproject.de/paypal_donate.gif" style="border:none" border="0" name="submit" alt="Donations are highly appreciated :-) a PayPal account is required.">
    </form>
    </div>
    </body>
</html>
