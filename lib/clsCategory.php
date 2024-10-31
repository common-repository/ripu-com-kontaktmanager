<?PHP
/*
Date: 25.09.2008 16:37:35
Filename: clsCategory.php
Type: Class
Author: rp
Copyright: (C) 2008 by Richard Pulch (www.ripucom.de)
*/

class Category{
  var $m_intID = -1;
  var $m_strName = "";
  var $m_strDescription = "";
  
  function Category($id){
    $this->m_intID = $id;
    $this->GetData($id);
  }

  function __construct($id){
    $this->Category($id);
  }

  function Destroy(){
    unset($this->m_intID);
    unset($this->m_strName);
    unset($this->m_strDescription);
  }

  function __destruct(){
    $this->Destroy();
  }
  
  function GetData($id){
    $id = (int)$id;
    $sql = mysql_query("SELECT * FROM `cm_categories` WHERE id = ". $id ." LIMIT 1");
    $row = mysql_fetch_assoc($sql);
    $this->m_strName = $row['name'];
    $this->m_strDescription = $row['description'];
  }
  
  function Name(){
    return $this->m_strName;
  }
  function Description(){
    return $this->m_strDescription;
  }
  function ID(){
    return (int)$this->m_intID;
  }
}
?>