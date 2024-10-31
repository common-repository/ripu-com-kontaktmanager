<?PHP
/*
Date: 06.10.2008 18:21:18
Filename: clsvCard.php
Type: Class
Author: rp
Copyright: (C) 2008 by Richard Pulch (www.ripucom.de)
*/
include("../wp-content/plugins/ripu-com-plugin-framework/lib/clsHTTPDownload.php");
include("../wp-content/plugins/ripu-com-plugin-framework/lib/clsFileStream.php");

class vCard{
  function vCard(){
  }
  function __construct(){
    $this->vCard();
  }

  function Destroy(){
  }

  function __destruct(){
    $this->Destroy();
  }

  function Generate($contactID){
    $contactID = (int)$contactID;
    $Contact = new Contact($contactID);
    $Stream = new FileStream("../wp-content/plugins/ripu-com-kontaktmanager/vcards/$contactID.vcf", "w");
    if($Contact->Sex() == "masc"){
      $strAddress = "Herr";
    }else{
      $strAddress = "Frau";
    }
    $strvCard .= "BEGIN:VCARD\n";
    $strvCard .= "N:". $Contact->Surname() .";". $Contact->Name() ."\n";
    $strvCard .= "FN:$strAddress ". $Contact->Name() ." ". $Contact->Surname() ."\n";
    $strvCard .= "ADR;POSTAL;WORK:;;". $Contact->Street() .";". $Contact->Town() .";;". $Contact->ZIP() .";". $Contact->Country() ."\n";
    $strvCard .= "LABEL;POSTAL;WORK;ENCODING=QUOTED-PRINTABLE:". $Contact->Street() .", ". $Contact->ZIP() ." ". $Contact->Town() .", ". $Contact->Country() ."\n";
    $strvCard .= "TEL;WORK;VOICE;MESG;PREF:". $Contact->Phone() ."\n";
    $strvCard .= "TEL;WORK;FAX:". $Contact->Fax() ."\n";
    $strvCard .= "TEL;Cell;VOICE:". $Contact->Mobile() ."\n";
    $strvCard .= "EMAIL;Internet:". $Contact->EMail() ."\n";
    $strvCard .= "URL;WORK:http://". $Contact->Website() ."\n";
    $strvCard .= "UID;WORK:http://". $Contact->Website() ."\n";
    $strvCard .= "NOTE;ENCODING=QUOTED-PRINTABLE:". $Contact->Notice() ."\n";
    $strvCard .= "REV:20081006T180811\n";
    $strvCard .= "VERSION:2.1\n";
    $strvCard .= "END:VCARD\n";
    $Stream->Write($strvCard);
    $Stream->Destroy();
  }
}
?>