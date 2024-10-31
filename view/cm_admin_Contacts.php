<div class="wrap">
<?PHP
/*
Date: 25.09.2008 17:07:28
Filename: cm_admin_Contacts.php
Type: View
Author: rp
Copyright: (C) 2008 by Richard Pulch (www.ripucom.de)
*/
include("../wp-content/plugins/ripu-com-kontaktmanager/lib/clsContacts.php");

$Contacts = new Contacts();
echo $Contacts->GetContent();
$Contacts->Destroy();
?>
</div>