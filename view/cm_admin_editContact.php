<div class="wrap">
<?PHP
/*
Date: 25.09.2008 20:53:31
Filename: cm_admin_editContact.php
Type: View
Author: rp
Copyright: (C) 2008 by Richard Pulch (www.ripucom.de)
*/
include("../wp-content/plugins/ripu-com-plugin-framework/lib/clsWebForm.php");
include("../wp-content/plugins/ripu-com-kontaktmanager/lib/clsCategories.php");
include("../wp-content/plugins/ripu-com-kontaktmanager/lib/clsContact.php");

$id = (int)$_GET['edit'];
$Contact = new Contact($id);

$Form = new WebForm("post", "?page=ripu-com-kontaktmanager/view/cm_admin_Contacts.php&amp;action=update", "form-1", "Kontakt-Manager: Kontakte -> Bearbeiten", "multipart/form-data");
$Break = new WebFormBreak();

$Category = New WebFormSelect("category", "Kategorie:");
$Categories = New Categories();
foreach($Categories->GetCategoriesDump("SELECT id, name FROM `cm_categories` ORDER BY name") as $key => $row){
  $Category->AddOption("keine &#196;nderung", $Contact->PID());
  $Category->AddOption("-------------", $Contact->PID());
  $Category->AddOption($row['name'], $row['id']);
}
$Image = New WebFormInput("file", "image", "Anzeigebild:", $htmlImage, $Contact->Image());
if($Contact->Image() != "") {
  $ImagePreview = New WebFormHTML($Contact->Thumbnail(150));
  $ImageDelete = New WebFormInput("checkbox", "delete_image", "Anzeigebild l&#246;schen:", "");
  $ImageDelete->AddAttribute("value", "delete");
}
$Name = New WebFormInput("text", "name", "Vorname:");
$Name->AddAttribute("value", $Contact->Name());
$SurName = New WebFormInput("text", "surname", "Nachname:");
$SurName->AddAttribute("value", $Contact->Surname());
$Sex = New WebFormSelect("sex", "Geschlecht:");
$Sex->AddOption("keine &#196;nderung", $Contact->Sex());
$Sex->AddOption("m&#228;nnlich", "masc");
$Sex->AddOption("weiblich", "fem");
$Street = New WebFormInput("text", "street", "Stra&#223;e:");
$Street->AddAttribute("value", $Contact->Street());
$Zip = New WebFormInput("text", "zip", "PLZ:");
$Zip->AddAttribute("value", $Contact->ZIP());
$Town = New WebFormInput("text", "town", "Stadt:");
$Town->AddAttribute("value", $Contact->Town());
$Country = New WebFormInput("text", "country", "Land:");
$Country->AddAttribute("value", $Contact->Country());
$Phone = New WebFormInput("text", "phone", "Telefon:");
$Phone->AddAttribute("value", $Contact->Phone());
$Mobile = New WebFormInput("text", "mobile", "Mobil:");
$Mobile->AddAttribute("value", $Contact->Mobile());
$Fax = New WebFormInput("text", "fax", "Fax:");
$Fax->AddAttribute("value", $Contact->Fax());
$Email = New WebFormInput("text", "email", "E-Mail:");
$Email->AddAttribute("value", $Contact->EMail());
$Website = New WebFormInput("text", "website", "Webseite:", "ohne http://");
$Website->AddAttribute("value", $Contact->Website());
$Notice = New WebFormTextbox("notice", "Notiz zu diesem Kontakt:", "", $Contact->Notice());
$Notice->AddAttribute("cols", 60);
$Notice->AddAttribute("rows", 6);

$Submit = New WebFormInput("submit", "abschicken", "Kategorie hinzuf&#252;gen:", "Klicken Sie hier um das Formular abzusenden!");
$HiddenID = New WebFormInput("hidden", "id", "");
$HiddenID->AddAttribute("value", $Contact->ID());
$Form->AddItems(array($Category, $Break, $Image));
if($Contact->Image() != "") {
  $Form->AddItems(array($ImagePreview, $ImageDelete));
}
$Form->AddItems(array($Name, $SurName, $Sex, $Break, $Street, $Zip, $Town, $Country, $Break, $Phone, $Mobile, $Fax, $Email, $Website, $Break, $Notice, $Submit, $HiddenID));
echo $Form->toString();
$Form->Destroy();
$Categories->Destroy();
?>
</div>