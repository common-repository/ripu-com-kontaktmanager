<div class="wrap">
<?PHP
/*
Date: 25.09.2008 16:44:25
Filename: cm_admin_editCategory.php
Type: View
Author: rp
Copyright: (C) 2008 by Richard Pulch (www.ripucom.de)
*/
include("../wp-content/plugins/ripu-com-plugin-framework/lib/clsWebForm.php");
include("../wp-content/plugins/ripu-com-kontaktmanager/lib/clsCategory.php");
$id = (int)$_GET['edit'];

$Form = new WebForm("post", "?page=ripu-com-kontaktmanager/view/cm_admin_Categories.php&amp;action=update", "form-1", "Kontakt-Manager: Kategorien -> Bearbeiten");
$Category = new Category($id);
$Name = New WebFormInput("text", "name", "Name der Kategorie:", "");
$Name->AddAttribute("value", $Category->Name());
$Description = New WebFormTextbox("description", "Beschreibung der Kategorie:", "", $Category->Description());
$Description->AddAttribute("cols", 60);
$Description->AddAttribute("rows", 6);
$HiddenID = New WebFormInput("hidden", "id", "", "", $Category->ID());
$HiddenID->AddAttribute("value", $Category->ID());
$Submit = New WebFormInput("submit", "abschicken", "Kategorie hinzuf&#252;gen:", "Klicken Sie hier um das Formular abzusenden!");

$Form->AddItems(array($Name, $Description, $Submit, $HiddenID));
echo $Form->toString();
$Form->Destroy();
$Category->Destroy();
?>
</div>