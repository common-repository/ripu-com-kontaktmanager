<div class="wrap">
<?PHP
/*
Date: 25.09.2008 16:06:30
Filename: cm_admin_addCategory.php
Type: View
Author: rp
Copyright: (C) 2008 by Richard Pulch (www.ripucom.de)
*/
include("../wp-content/plugins/ripu-com-plugin-framework/lib/clsWebForm.php");

$Form = new WebForm("post", "?page=ripu-com-kontaktmanager/view/cm_admin_Categories.php&amp;action=insert", "form-1", "Kontakt-Manager: Kategorien -> Hinzuf&#252;gen");

$Name = New WebFormInput("text", "name", "Name der Kategorie:");
$Description = New WebFormTextbox("description", "Beschreibung der Kategorie:");
$Description->AddAttribute("cols", 60);
$Description->AddAttribute("rows", 6);

$Submit = New WebFormInput("submit", "abschicken", "Kategorie hinzuf&#252;gen:", "Klicken Sie hier um das Formular abzusenden!");

$Form->AddItems(array($Name, $Description, $Submit));
echo $Form->toString();
$Form->Destroy();
?>
</div>