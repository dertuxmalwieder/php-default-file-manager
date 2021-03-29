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

// set cleanup period
$cleanup_period = 60 * 60 * 24 * 3;    // 3 days
    
//  let's have an overview over all /files ...
foreach (glob("files/*.*") as $filetmp) {
    if ($filetmp == "." || $filetmp == "..")
        continue;
    
    // let's check the last access timestamps ...
    $timestamp = fileatime($filetmp);
    $now = time();
        
    if ($now - $timestamp >= $cleanup_period)
        @unlink($filetmp);    // delete it :-)
}
    
clearstatcache();
?>
