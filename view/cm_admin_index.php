<div class="wrap">
<?PHP
/*
Date: 24.09.2008 15:27:02
Filename: cm_clsSetUp.php
Type: Class
Author: rp
Copyright: (C) 2008 by Richard Pulch (www.ripucom.de)
*/
include("../wp-content/plugins/ripu-com-kontaktmanager/lib/clsContactsOverview.php");
global $user_level;
if(current_user_can('level_4') > 0){
  $ContactsOverview = new ContactsOverview();
  echo $ContactsOverview->GetContent();
}
?>
</div>