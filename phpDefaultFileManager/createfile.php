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

error_reporting(E_ERROR);

require_once("cleanup.php");
function addLine(&$var,$text) { $var .= $text . "\r\n"; }

$appname = $_REQUEST['appname'];
$apppath = $_REQUEST['apppath'];
$apppath = str_replace("/","\\",$apppath);
$apppath = str_replace("\\","\\\\",$apppath);
$appparams = str_replace("\"%1\"","%1",$_REQUEST['appparams']);
$appparams = str_replace("%1","\"%L\"",$_REQUEST['appparams']);
$usedir = ( $_REQUEST['safemode'] == true ? "Directory" : "Folder" );
$trunk  = ( $_REQUEST['64bit'] == false ? "HKEY_CLASSES_ROOT" : "HKEY_CLASSES_ROOT\\Wow6432Node");

if (empty($appname) || empty($apppath))
    die("Not enough parameters.<br><br>APPNAME: $appname<br>APPPATH: $apppath");

if (!strstr($apppath,".exe"))
    die("Not a valid .exe file specified.");

$randomstring = md5(uniqid(rand(), TRUE));
if (!mkdir("files/$randomstring",0777))
    die("Couldn't create the directory, contact me please!");

// 1) Register APP.reg
$regappfile = "files/$randomstring/register_$appname.reg";
if (!$fhandle = fopen($regappfile, "w"))
    die("Failed to create the registering file, contact me please!");

addLine($regappdata,"Windows Registry Editor Version 5.00\r\n");
addLine($regappdata,"[$trunk\\$usedir\\shell]");
addLine($regappdata,"@=\"$appname\"\r\n");
addLine($regappdata,"[$trunk\\$usedir\\shell\\$appname]");
addLine($regappdata,"@=\"$appname\"\r\n");
addLine($regappdata,"[$trunk\\$usedir\\shell\\$appname\\command]");
addLine($regappdata,"@=\"\\\"$apppath\\\" $appparams\"");

fwrite($fhandle, $regappdata);
fclose($fhandle);

// 2) Unregister APP.reg
$regunappfile = "files/$randomstring/unregister_$appname.reg";
if (!$fhandle = fopen($regunappfile, "w"))
    die("Failed to create the unregistering file, contact me please!");

addLine($regunappdata,"Windows Registry Editor Version 5.00\r\n");
addLine($regunappdata,"[$trunk\\$usedir\\shell]");
addLine($regunappdata,"@=\"\"\r\n");
addLine($regunappdata,"[-$trunk\\$usedir\\shell\\$appname]");

fwrite($fhandle, $regunappdata);
fclose($fhandle);

// .zip the files
$zip = new ZipArchive();
$zipfilename = "files/$randomstring.zip";
if ($zip->open($zipfilename, ZIPARCHIVE::CREATE) !== TRUE)
    die("Couldn't create $zipfilename, please contact me!");

$zip->addFile("files/$randomstring/register_$appname.reg","register $appname.reg");
$zip->addFile("files/$randomstring/unregister_$appname.reg","unregister $appname.reg");
$zip->close();

@unlink($regappfile);
@unlink($regunappfile);
rmdir("files/$randomstring");
?>
