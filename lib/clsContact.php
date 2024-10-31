<?PHP
/*
Date: 25.09.2008 20:55:01
Filename: clsContact.php
Type: Class
Author: rp
Copyright: (C) 2008 by Richard Pulch (www.ripucom.de)
*/

class Contact{
  var $m_intID = -1;
  var $m_intPID = -1;
  var $m_strImage = "";
  var $m_strName = "";
  var $m_strSurname = "";
  var $m_strSex = "";
  var $m_strStreet = "";
  var $m_strZIP = "";
  var $m_strTown = "";
  var $m_strCountry = "";
  var $m_strPhone = "";
  var $m_strMobile = "";
  var $m_strFax = "";
  var $m_strEMail = "";
  var $m_strWebsite = "";
  var $m_strNotice = "";
  
  function Contact($id){
    $this->m_intID = $id;
    $this->GetData($id);
  }

  function __construct($id){
    $this->Contact($id);
  }

  function Destroy(){
    unset($this->m_intID);
    unset($this->m_intPID);
    unset($this->m_strName);
    unset($this->m_strImage);
    unset($this->m_strSurname);
    unset($this->m_strSex);
    unset($this->m_strStreet);
    unset($this->m_strZIP);
    unset($this->m_strTown);
    unset($this->m_strCountry);
    unset($this->m_strPhone);
    unset($this->m_strMobile);
    unset($this->m_strFax);
    unset($this->m_strEMail);
    unset($this->m_strWebsite);
    unset($this->m_strNotice);
  }

  function __destruct(){
    $this->Destroy();
  }
  
  function GetData($id){
    $id = (int)$id;
    $sql = mysql_query("SELECT * FROM `cm_contacts` WHERE id = ". $id ." LIMIT 1");
    $row = mysql_fetch_assoc($sql);
    $this->m_intPID = $row['pid'];
    $this->m_strImage = $row['image'];
    $this->m_strName = $row['name'];
    $this->m_strSurname = $row['surname'];
    $this->m_strSex = $row['sex'];
    $this->m_strStreet = $row['street'];
    $this->m_strZIP = $row['zip'];
    $this->m_strTown = $row['town'];
    $this->m_strCountry = $row['country'];
    $this->m_strPhone = $row['phone'];
    $this->m_strMobile = $row['mobile'];
    $this->m_strFax = $row['fax'];
    $this->m_strEMail = $row['email'];
    $this->m_strWebsite = $row['website'];
    $this->m_strNotice = $row['notice'];
  }
  
  function ID(){
    return (int)$this->m_intID;
  }
  function PID(){
    return (int)$this->m_intPID;
  }
  function Image(){
    return $this->m_strImage;
  }
  function Thumbnail($Size = 150){
    if($this->Image() != ""){
      return "<img src='". get_option('siteurl')."/wp-content/plugins/ripu-com-kontaktmanager/view/cm_thumbnail.php?image=". get_option('siteurl').get_option('cm_upload_images').$this->Image() ."&amp;w=". $Size ."' alt='". $this->Name() ."'/>";
    }else{
      return "<img src='". get_option('siteurl')."/wp-content/plugins/ripu-com-kontaktmanager/view/cm_thumbnail.php?image=". get_option('siteurl')."/wp-content/plugins/ripu-com-kontaktmanager/images/noimage_". $this->Sex() .".png&amp;w=". $Size ."' alt='". $this->Name() ."'/>";
    }
  }
  function Name(){
    return $this->m_strName;
  }
  function Surname(){
    return $this->m_strSurname;
  }
  function Sex(){
    return $this->m_strSex;
  }
  function Street(){
    return $this->m_strStreet;
  }
  function ZIP(){
    return $this->m_strZIP;
  }
  function Town(){
    return $this->m_strTown;
  }
  function Country(){
    return $this->m_strCountry;
  }
  function Phone(){
    return $this->m_strPhone;
  }
  function Mobile(){
    return $this->m_strMobile;
  }
  function Fax(){
    return $this->m_strFax;
  }
  function EMail(){
    return $this->m_strEMail;
  }
  function Website(){
    return $this->m_strWebsite;
  }
  function Notice(){
    return $this->m_strNotice;
  }
}
?>