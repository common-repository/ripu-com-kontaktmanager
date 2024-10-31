<?PHP
/*
Date: 25.09.2008 17:07:28
Filename: cm_download.php
Type: View
Author: rp
Copyright: (C) 2008 by Richard Pulch (www.ripucom.de)
*/
include("../../ripu-com-plugin-framework/lib/clsHTTPRequestCollection.php");
include("../../ripu-com-plugin-framework/lib/clsHTTPDownload.php");
$Requests = new HTTPRequestCollection();

$HTTPDownload = new HTTPDownload($Requests->toString('file'), "text/x-vcard");
$HTTPDownload->Start();
?>