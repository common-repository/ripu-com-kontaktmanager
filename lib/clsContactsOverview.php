<?PHP
/*
Date: 25.09.2008 17:07:48
Filename: clsContactsOverview.php
Type: Class
Author: rp
Copyright: (C) 2008 by Richard Pulch (www.ripucom.de)
*/
include("../wp-content/plugins/ripu-com-kontaktmanager/lib/clsContact.php");
class ContactsOverview{

  function ContactsOverview(){

  }
  function __construct(){
    $this->ContactsOverview();
  }

  function Destroy(){
  }

  function __destruct(){
    $this->Destroy();
  }
  
  function GetContent(){
    $htmlReturn = "<h2>Kontakt-Manager: &#220;bersicht</h2><br/>";
    $sql = mysql_query("SELECT id, name FROM `cm_categories` ORDER BY name");
    while($row = mysql_fetch_assoc($sql)){
      $htmlReturn .= "<h3>". htmlspecialchars($row['name']) ."</h3>";
      $htmlReturn .= $this->GetTable($row['id']);
    }
    return $htmlReturn;
  }
  
  function GetTable($Category){
    $Category = (int)$Category;
    $sql = mysql_query("SELECT id FROM `cm_contacts` WHERE pid = $Category ORDER BY name, surname");
    while($row = mysql_fetch_assoc($sql)){
      $Contact = new Contact($row['id']);
      if($Contact->Sex() == "masc"){
        $strAddress = "Herr";
      }else{
        $strAddress = "Frau";
      }
      $htmlReturn .= '
      <div style="border: 1px solid rgb(214, 215, 206); padding: 5px; background-color: rgb(239, 239, 239);">
         <div style="padding-top: 10px; float: left; vertical-align: top;" id="contact-'. $Contact->ID() .'" class="alt">
           '. $Contact->Thumbnail(100) .'<br/>
           <img src="../wp-content/plugins/ripu-com-plugin-framework/img/vcard.png" width="16" height="16" alt="vCard"/> <a href="'. get_option('siteurl') .'/wp-content/plugins/ripu-com-kontaktmanager/vcards/cm_download.php?file='. $Contact->ID() .'.vcf" title="vCard" target="_blank">als vCard exportieren</a>
         </div>
         <div style="padding-top: 7px; float: left; vertical-align: middle; margin-left: 25px; width:220px;">
           <strong style="font-size: 14px;"><a href="?page=ripu-com-kontaktmanager/view/cm_admin_editContact.php&amp;edit='. $Contact->ID() .'">'. $strAddress ." ". htmlspecialchars($Contact->Name()) .', '. htmlspecialchars($Contact->Surname())  .'</a></strong>
           <br/>
           <small style="color: rgb(49, 48, 46); font-size: 10px;">
             <img src="../wp-content/plugins/ripu-com-plugin-framework/img/email.png" width="12" height="12" alt="eMail"/> E-Mail:  '. htmlspecialchars($Contact->Email()) .'<br/>
             <img src="../wp-content/plugins/ripu-com-plugin-framework/img/telephone.png" width="12" height="12" alt="Telefon"/> Telefon: '. $Contact->Phone() .'<br/>
             <img src="../wp-content/plugins/ripu-com-plugin-framework/img/phone.png" width="12" height="12" alt="Mobil"/> Mobil: '. $Contact->Mobile() .'<br/>
             <img src="../wp-content/plugins/ripu-com-plugin-framework/img/fax.png" width="12" height="12" alt="Telefax"/> Telefax: '. $Contact->Fax() .'<br/>
             <img src="../wp-content/plugins/ripu-com-plugin-framework/img/world.png" width="12" height="12" alt="Webseite"/> Webseite: <a href="http://'. $Contact->Website() .'" title="'. $Contact->Website() .'" target="_blank">'. $Contact->Website() .'</a><br/>
           </small>
           <br/>
       </div>
       <div style="padding-top: 7px; float: left; vertical-align: middle; margin-left: 25px; width:200px;">
           <strong style="font-size: 14px;"><img src="../wp-content/plugins/ripu-com-plugin-framework/img/house.png" width="16" height="16" alt="Anschrift"/> Anschrift</strong>
           <br/>
           <small style="color: rgb(49, 48, 46); font-size: 10px;">
             '. htmlspecialchars($Contact->Street()) .'<br/>
             '. $Contact->ZIP() .' '. htmlspecialchars($Contact->Town()) .', '. htmlspecialchars($Contact->Country()) .'<br/>
           </small>
           <br/>
       </div>
        <div style="padding-top: 7px; float: left; vertical-align: middle; margin-left: 25px; width:250px;">
         <strong style="font-size: 14px;"><img src="../wp-content/plugins/ripu-com-plugin-framework/img/note.png" width="16" height="16" alt="Notiz"/> Notiz</strong><br/>
         <small>'. nl2br(htmlspecialchars($Contact->Notice())) .'</small>
       </div>
       <div style="clear: both;"></div>
       </div>
      ';
    }
    return $htmlReturn;
  }
}
?>