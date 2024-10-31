<?PHP
/*
Date: 06.10.2008 15:14:32
Filename: cm_thumbnail.php
Type: View
Author: rp
Copyright: (C) 2008 by Richard Pulch (www.ripucom.de)
*/
include("../../ripu-com-plugin-framework/lib/clsHTTPRequestCollection.php");
include("../../ripu-com-plugin-framework/lib/clsThumbNailGenerator.php");
$Requests = new HTTPRequestCollection();
$ThumbNail = new ThumbNailGenerator($Requests->toString('image'), $Requests->toString('w', 'int'));
$ThumbNail->Generate(False);
?>