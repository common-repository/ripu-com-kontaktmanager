<div class="wrap">
<?PHP
/*
Date: 25.09.2008 17:23:08
Filename: cm_admin_addContact.php
Type: View
Author: rp
Copyright: (C) 2008 by Richard Pulch (www.ripucom.de)
*/
include("../wp-content/plugins/ripu-com-plugin-framework/lib/clsWebForm.php");
include("../wp-content/plugins/ripu-com-kontaktmanager/lib/clsCategories.php");

$Form = new WebForm("post", "?page=ripu-com-kontaktmanager/view/cm_admin_Contacts.php&amp;action=insert", "form-1", "Kontakt-Manager: Kontakte -> Hinzuf&#252;gen", "multipart/form-data");
$Break = new WebFormBreak();

$Category = New WebFormSelect("category", "Kategorie:");
$Categories = New Categories();
foreach($Categories->GetCategoriesDump("SELECT id, name FROM `cm_categories` ORDER BY name") as $key => $row){
  $Category->AddOption($row['name'], $row['id']);
}

$Image = New WebFormInput("file", "image", "Anzeigebild:");

$Name = New WebFormInput("text", "name", "Vorname:");
$SurName = New WebFormInput("text", "surname", "Nachname:");
$Sex = New WebFormSelect("sex", "Geschlecht:");
$Sex->AddOption("m&#228;nnlich", "masc");
$Sex->AddOption("weiblich", "fem");
$Street = New WebFormInput("text", "street", "Stra&#223;e:");
$Zip = New WebFormInput("text", "zip", "PLZ:");
$Town = New WebFormInput("text", "town", "Stadt:");
$Country = New WebFormInput("text", "country", "Land:");

$Phone = New WebFormInput("text", "phone", "Telefon:");
$Mobile = New WebFormInput("text", "mobile", "Mobil:");
$Fax = New WebFormInput("text", "fax", "Fax:");
$Email = New WebFormInput("text", "email", "E-Mail:");
$Website = New WebFormInput("text", "website", "Webseite:", "ohne http://");

$Notice = New WebFormTextbox("notice", "Notiz zu diesem Kontakt:");
$Notice->AddAttribute("cols", 60);
$Notice->AddAttribute("rows", 6);

$Submit = New WebFormInput("submit", "abschicken", "Kategorie hinzuf&#252;gen:", "Klicken Sie hier um das Formular abzusenden!");

$Form->AddItems(array($Category, $Break, $Image, $Name, $SurName, $Sex, $Break, $Street, $Zip, $Town, $Country, $Break, $Phone, $Mobile, $Fax, $Email, $Website, $Break, $Notice, $Submit));
echo $Form->toString();
$Form->Destroy();
$Categories->Destroy();
?>
</div>