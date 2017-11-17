<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (file_exists(dirname(__FILE__)."/config.php"))
	require_once(dirname(__FILE__)."/config.php");
else if (file_exists(dirname(__FILE__)."/../config.php"))
	require_once(dirname(__FILE__)."/../config.php");

class DrugpropertyModel{
	private $table_name;
	public function __construct()
  {
  	$this->table_name = "drug_properties";
  }
  public function get_drug_simple_list() {
    global $mysqli;
    $sql = "SELECT ndc, generic_name FROM {$this->table_name} ORDER BY ndc";
    $ret = array();
    if ($result = $mysqli->query($sql)) {
      if ($result->num_rows>0)
      {
        while($row = $result->fetch_assoc())
        {
          $temp = array('ndc' => $row['ndc'], 'generic_name' => $row['generic_name']);
          $ret[] = $temp;
        }
      }
    }
    
    return $ret;
  }
}
?>