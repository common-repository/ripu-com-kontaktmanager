<?PHP
/*
Date: 25.09.2008 17:07:48
Filename: clsContacts.php
Type: Class
Author: rp
Copyright: (C) 2008 by Richard Pulch (www.ripucom.de)
*/
include("../wp-content/plugins/ripu-com-plugin-framework/lib/clsDataGrid.php");
include("../wp-content/plugins/ripu-com-plugin-framework/lib/clsUpdateFade.php");
include("../wp-content/plugins/ripu-com-plugin-framework/lib/clsHTTPRequestCollection.php");
include("../wp-content/plugins/ripu-com-plugin-framework/lib/clsFileUpload.php");
include("../wp-content/plugins/ripu-com-plugin-framework/lib/clsThumbNailGenerator.php");
include("../wp-content/plugins/ripu-com-kontaktmanager/lib/clsContact.php");
include("../wp-content/plugins/ripu-com-kontaktmanager/lib/clsvCard.php");

class Contacts{

  function Contacts(){

  }
  function __construct(){
    $this->Contacts();
  }

  function Destroy(){
  }

  function __destruct(){
    $this->Destroy();
  }
  
  function GetContent(){
    $htmlReturn = "<h2>Kontakt-Manager: Kontakte</h2><br/>";
    $htmlReturn .= $this->IsAction();
    $htmlReturn .= "<b><a href='?page=ripu-com-kontaktmanager/view/cm_admin_addContact.php' title='Kontakt hinzuf&#252;gen...'>Neuen Kontakt erstellen</a></b><br/>";
    $htmlReturn .= "<h3>Bisher hinterlegte Eintr&#228;ge:</h3>";
    $htmlReturn .= "<img src='../wp-content/plugins/ripu-com-plugin-framework/img/info.png' alt='Information'/> <i>Sie k&#246;nnen die Eintr&#228;ge unter \"Aktionen\" bearbeiten.</i><br/><br/>";
    $sql = mysql_query("SELECT id, name FROM `cm_categories` ORDER BY name");
    while($row = mysql_fetch_assoc($sql)){
      $htmlReturn .= "<h2>". htmlspecialchars($row['name']) ."</h2>";
      $strAktionen = "<img src='../wp-content/plugins/ripu-com-plugin-framework/img/page_white_edit.png' alt='Bearbeiten'/><a href='?page=ripu-com-kontaktmanager/view/cm_admin_editContact.php&amp;edit={id}'>Bearbeiten</a>";
      $strAktionen .= "<img src='../wp-content/plugins/ripu-com-plugin-framework/img/page_white_delete.png' alt='L&#246;schen'/><a href='?page=ripu-com-kontaktmanager/view/cm_admin_Contacts.php&amp;action=delete&amp;delete={id}'>L&#246;schen</a>";
      $htmlReturn .= $this->GetDataGrid("SELECT id, surname, name, town, email FROM `cm_contacts` WHERE `pid` = $row[id] ORDER BY surname, name", array("ID", "Nachname", "Vorname", "Stadt", "E-Mail", "Aktionen"), $strAktionen);
    }
    return $htmlReturn;
  }
  
  function GetDataGrid($query, $cols, $aktionen = ""){
    $sql = mysql_query($query);
    $arCols = $cols;
    $DataGrid = new DataGrid($arCols);
    while($row = mysql_fetch_assoc($sql)){
      $htmlActions = $aktionen;
      foreach($row as $key => $element){
        $row[$key] = htmlspecialchars($element);
      }
      array_push($row, $htmlActions);
      $DataGrid->AddRow($row);
    }
    return $DataGrid->toString();
  }

  function IsAction(){
    if(isset($_GET['action'])){
      if($_GET['action']=="insert"){
        return $this->InsertEntry();
      }elseif($_GET['action']=="delete"){
        return $this->DeleteEntry();
      }elseif($_GET['action']=="update"){
        return $this->UpdateEntry();
      }
    }
  }
  
  function InsertEntry(){
    $return = "";
    $Requests = new HTTPRequestCollection();
    $strImage = $this->UploadImage(md5($Requests->toString('name').$Requests->toString('surname')));
    $sql = mysql_query("INSERT INTO `cm_contacts` ( `id` , `pid` , `image` , `name` , `surname` , `sex` , `street` , `zip` , `town` , `country` , `phone` , `mobile` , `fax` , `email` , `website` , `notice` ) VALUES ( NULL , '". $Requests->toString('category', 'int') ."', '". $strImage ."', '". $Requests->toString('name') ."', '". $Requests->toString('surname') ."', '". $Requests->toString('sex') ."', '". $Requests->toString('street') ."', '". $Requests->toString('zip') ."', '". $Requests->toString('town') ."', '". $Requests->toString('country') ."', '". $Requests->toString('phone') ."', '". $Requests->toString('mobile') ."', '". $Requests->toString('fax') ."', '". $Requests->toString('email') ."', '". $Requests->toString('website') ."', '". $Requests->toString('notice') ."' );");
    if($sql){
      $return .= UpdateFade::toString("Der Eintrag wurde erfolgreich eingetragen!");
    }else{
      $return .= UpdateFade::toString("Beim Eintragen des Datensatzes in die Datenbank ist ein Fehler aufgetreten!");
    }
    $sql = mysql_query("SELECT id FROM `cm_contacts` ORDER BY id DESC LIMIT 1");
    $row = mysql_fetch_assoc($sql);
    $id = (int)$row['id'];
    $vCard = new vCard();
    $vCard->Generate($id);
    $Requests->Destroy();
    return $return;
  }
  
  function DeleteEntry(){
    $return = "";
    $Requests = new HTTPRequestCollection();
    $sql = mysql_query("DELETE FROM `cm_contacts` WHERE `id` = ". $Requests->toString('delete', 'int') ." LIMIT 1;");
    $return .= $this->DeleteImage(md5($Requests->toString('name').$Requests->toString('surname')));
    @unlink("../wp-content/plugins/ripu-com-kontaktmanager/vcards/". $Requests->toString('delete', 'int') .".vcf");
    if($sql){
      $return .= UpdateFade::toString("Der Eintrag wurde erfolgreich gel&#246;scht!");
    }else{
      $return .= UpdateFade::toString("Beim L&#246;schen des Datensatzes aus der Datenbank ist ein Fehler aufgetreten!");
    }
    $Requests->Destroy();
    return $return;
  }
  
  function UpdateEntry(){
    $return = "";
    $Requests = new HTTPRequestCollection();
    $Contact = new Contact($Requests->toString('id', 'int'));
    if(isset($_POST['delete_image'])){
      $strImage = "";
      $return .= $this->DeleteImage($Contact->Image());
    }elseif(!empty($_FILES['image']['name'])){
      if($Contact->Image() != "") $return .= $this->DeleteImage($Contact->Image());
      $strImage = $this->UploadImage(md5($Requests->toString('name').$Requests->toString('surname')));
    }else{
      $Contact = new Contact($Requests->toString('id', 'int'));
      $strImage = $Contact->Image();
    }
    $sql = mysql_query("UPDATE `cm_contacts` SET `pid` = '". $Requests->toString('category', 'int') ."', `image` = '". $strImage ."', `name` = '". $Requests->toString('name') ."', `surname` = '". $Requests->toString('surname') ."', `sex` = '". $Requests->toString('sex') ."', `street` = '". $Requests->toString('street') ."', `zip` = '". $Requests->toString('zip') ."', `town` = '". $Requests->toString('town') ."', `country` = '". $Requests->toString('country') ."', `phone` = '". $Requests->toString('phone') ."', `mobile` = '". $Requests->toString('mobile') ."', `fax` = '". $Requests->toString('fax') ."', `email` = '". $Requests->toString('email') ."', `website` = '". $Requests->toString('website') ."', `notice` = '". $Requests->toString('notice') ."' WHERE `id` =". $Requests->toString('id', 'int') ." LIMIT 1 ;");
    if($sql){
      @unlink("../wp-content/plugins/ripu-com-kontaktmanager/vcards/". $Requests->toString('id', 'int') .".vcf");
      $vCard = new vCard();
      $vCard->Generate($Requests->toString('id', 'int'));
      $return .= UpdateFade::toString("Der Eintrag wurde erfolgreich bearbeitet!");
    }else{
      $return .= UpdateFade::toString("Beim Bearbeiten des Datensatzes in der Datenbank ist ein Fehler aufgetreten!");
    }
    $Requests->Destroy();
    return $return;
  }

  function UploadImage($hash){
    if(!empty($_FILES['image']['name'])){
      $Contact = new Contact($ContactID);
      $ImageUpload = new FileUpload("image", "..". get_option('cm_upload_images'));
      $ImageUpload->SetFilename($hash ."_". $ImageUpload->File('name'));
      $strImage = $hash ."_". $ImageUpload->File('name');
      if(!$ImageUpload->Upload()){
        $strImage = "";
        echo UpdateFade::toString("Es ist ein Fehler beim Upload des Anzeigebildes aufgetreten!");
      }
      return $strImage;
    }
  }
  
  function DeleteImage($Image){
    if(file_exists("..". get_option('cm_upload_images') ."/". $Image)){
     if(!@unlink("..". get_option('cm_upload_images') ."/". $Image)){
       return UpdateFade::toString("Es ist ein Fehler beim Löschvorgang des Anzeigebildes aufgetreten!");
     }
    }
  }
}



?>