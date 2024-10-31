<?PHP
/*
Date: 25.09.2008 12:47:08
Filename: clsCategories.php
Type: Class
Author: rp
Copyright: (C) 2008 by Richard Pulch (www.ripucom.de)
*/
include("../wp-content/plugins/ripu-com-plugin-framework/lib/clsDataGrid.php");
include("../wp-content/plugins/ripu-com-plugin-framework/lib/clsUpdateFade.php");
include("../wp-content/plugins/ripu-com-plugin-framework/lib/clsHTTPRequestCollection.php");

class Categories{

  function Categories(){

  }
  function __construct(){
    $this->Categories();
  }

  function Destroy(){
  }

  function __destruct(){
    $this->Destroy();
  }
  
  function GetContent(){
    $htmlReturn = "<h2>Kontakt-Manager: Kategorien</h2><br/>";
    $htmlReturn .= $this->IsAction();
    $htmlReturn .= "<b><a href='?page=ripu-com-kontaktmanager/view/cm_admin_addCategory.php' title='Kategorie hinzuf&#252;gen...'>Neue Kategorie erstellen</a></b><br/>";
    $htmlReturn .= "<h3>Bisher hinterlegte Eintr&#228;ge:</h3>";
    $htmlReturn .= "<img src='../wp-content/plugins/ripu-com-plugin-framework/img/info.png' alt='Information'/> <i>Sie k&#246;nnen die Eintr&#228;ge unter \"Aktionen\" bearbeiten.</i><br/><br/>";
    $htmlReturn .= $this->GetDataGrid("SELECT * FROM `cm_categories` ORDER BY id", array("ID", "Name", "Beschreibung", "Kontakte", "Aktionen"), "<img src='../wp-content/plugins/ripu-com-plugin-framework/img/page_white_edit.png' alt='Bearbeiten'/><a href='?page=ripu-com-kontaktmanager/view/cm_admin_editCategory.php&amp;edit={id}'>Bearbeiten</a> <img src='../wp-content/plugins/ripu-com-plugin-framework/img/page_white_delete.png' alt='L&#246;schen'/><a href='?page=ripu-com-kontaktmanager/view/cm_admin_Categories.php&amp;action=delete&amp;delete={id}'>L&#246;schen</a>");
    return $htmlReturn;
  }
  
  function GetDataGrid($query, $cols, $aktionen = ""){
    $sql = mysql_query($query);
    $arCols = $cols;
    $DataGrid = new DataGrid($arCols);
    while($row = mysql_fetch_assoc($sql)){
      $htmlActions = $aktionen;
      $sqlCountUsers = mysql_query("SELECT Count(id) FROM `cm_contacts` WHERE `pid` = $row[id]");
      $rowCountUsers = mysql_num_rows($sqlCountUsers);
      $countUsers = $rowCountUsers;
      array_push($row, $rowCountUsers, $htmlActions);
      $DataGrid->AddRow($row);
    }
    return $DataGrid->toString();
  }
  
  function GetCategoriesDump($query){
    $arReturn = array();
    $sql = mysql_query($query);
    while($row=mysql_fetch_assoc($sql)){
      array_push($arReturn, $row);
    }
    return $arReturn;
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
    $Requests = new HTTPRequestCollection();
    $strDescription = $_POST['description'];
    $sql = mysql_query("INSERT INTO `cm_categories` ( `id` , `name` , `description` ) VALUES (NULL , '". $Requests->toString('name')  ."', '". $Requests->toString('description')  ."');");
    if($sql){
      return UpdateFade::toString("Der Eintrag wurde erfolgreich eingetragen!");
    }else{
      return UpdateFade::toString("Beim Eintragen des Datensatzes in die Datenbank ist ein Fehler aufgetreten!");
    }
    $Requests->Destroy();
  }
  
  function DeleteEntry(){
    $Requests = new HTTPRequestCollection();
    $sql = mysql_query("DELETE FROM `cm_categories` WHERE `id` = ". $Requests->toString('delete', 'int') ." LIMIT 1;");
    if($sql){
      return UpdateFade::toString("Der Eintrag wurde erfolgreich gel&#246;scht!");
    }else{
      return UpdateFade::toString("Beim L&#246;schen des Datensatzes aus der Datenbank ist ein Fehler aufgetreten!");
    }
    $Requests->Destroy();
  }
  
  function UpdateEntry(){
    $Requests = new HTTPRequestCollection();
    $sql = mysql_query("UPDATE `cm_categories` SET `name` = '". $Requests->toString('name')  ."',`description` = '". $Requests->toString('description')  ."' WHERE `id` =". $Requests->toString('id', 'int')  ." LIMIT 1 ;");
    if($sql){
      return UpdateFade::toString("Der Eintrag wurde erfolgreich bearbeitet!");
    }else{
      return UpdateFade::toString("Beim Bearbeiten des Datensatzes in der Datenbank ist ein Fehler aufgetreten!");
    }
    $Requests->Destroy();
  }


}



?>