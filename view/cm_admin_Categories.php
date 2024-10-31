<div class="wrap">
<?PHP
/*
Date: 25.09.2008 12:14:05
Filename: cm_admin_Categories.php
Type: View
Author: rp
Copyright: (C) 2008 by Richard Pulch (www.ripucom.de)
*/
include("../wp-content/plugins/ripu-com-kontaktmanager/lib/clsCategories.php");

$Categories = new Categories();
echo $Categories->GetContent();
$Categories->Destroy();
?>
</div>