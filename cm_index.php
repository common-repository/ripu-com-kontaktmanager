<?PHP
/*
Plugin Name: Kontakt-Manager
Plugin URI: http://www.ripucom.de
Description: Plugin zum Verwalten von Kontakten
Author: Richard Pulch
Version: 1.1
Author URI: http://www.ripucom.de
*/
@include("./wp-content/plugins/ripu-com-plugin-framework/lib/clsSetUp.php");
@include("../wp-content/plugins/ripu-com-plugin-framework/lib/clsSetUp.php");
function cm_admin_menu_callback(){
  global $objSetUp;
  $objSetUp->InitAdminMenuInterface();
}

$objSetUp = new SetUp("cm");
$objSetUp->AddOption("cm_upload_images", "/wp-content/plugins/ripu-com-kontaktmanager/images/");
$objSetUp->AddAdminMenuPage("Kontakt-Manager &#220;bersicht", "Kontakte", 4, "ripu-com-kontaktmanager/view/cm_admin_index.php");
$objSetUp->AddAdminMenuSubPage("ripu-com-kontaktmanager/view/cm_admin_index.php", "Kategorie Verwaltung", "Kategorien verwalten", 4, "ripu-com-kontaktmanager/view/cm_admin_Categories.php");
$objSetUp->AddAdminMenuSubPage("ripu-com-kontaktmanager/view/cm_admin_index.php", "Kontakte Verwaltung", "Kontakte verwalten", 4, "ripu-com-kontaktmanager/view/cm_admin_Contacts.php");
$objSetUp->Init();
$objSetUp->Destroy();
?>