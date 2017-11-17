<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (file_exists(dirname(__FILE__)."/config.php"))
	require_once(dirname(__FILE__)."/config.php");
else if (file_exists(dirname(__FILE__)."/../config.php"))
	require_once(dirname(__FILE__)."/../config.php");

class DrugcolorModel{
	private $table_name;
	public function __construct()
  {
  	$this->table_name = "drug_color";
  }
  public function insert_drug_color($data) {
    global $mysqli;
    $ret_id = -1;
    foreach($data as &$each)
    {
      $each = $mysqli->escape_string($each);
    }
    $sql = "INSERT INTO {$this->table_name} (drug_color, drug_color_image_file) ";
    $sql .= " VALUES ('{$data['drug_color']}', '{$data['drug_color_image_file']}')";
    $mysqli->query($sql);
    $ret_id = $mysqli->insert_id;
    
    return $ret_id;
  }
  public function get_drug_list() {
    global $mysqli;
    $sql = "SELECT * FROM {$this->table_name} ORDER BY drug_color_id DESC";
    $ret = array();
    if ($result = $mysqli->query($sql)) {
      if ($result->num_rows>0)
      {
        while($row = $result->fetch_assoc())
        {
          $ret[] = $row;
        }
      }
    }
    // 
    return $ret;
  }
  public function get_drug_one($id) {
    global $mysqli;
    $sql = "SELECT * FROM {$this->table_name} WHERE drug_color_id={$id}";
    $ret = array();
    if ($result = $mysqli->query($sql)) {
      if ($result->num_rows>0)
      {
        $row = $result->fetch_assoc();
        $ret = $row;
      }
    }
    
    return $ret;
  }
  public function get_drug_delete($id) {
    global $mysqli;
    $sql = "DELETE FROM {$this->table_name} WHERE drug_color_id={$id}";
    $ret = array();
    $count = $mysqli->query($sql);
    
    if (!$count)
      return -1;
    return $count;
  }
  public function update_drug_color($data) {
    global $mysqli;
    $ret_id = -1;
    foreach($data as &$each)
    {
      $each = $mysqli->escape_string($each);
    }
    $sql = "UPDATE {$this->table_name} SET 
              drug_color = '{$data['drug_color']}'";
    if (isset($data['drug_color_image_file']))
      $sql .= ", drug_color_image_file = '{$data['drug_color_image_file']}' ";
    $sql .= " WHERE drug_color_id = '{$data['drug_color_id']}'";
    $result = $mysqli->query($sql);
    $ret_id = $result ? 1 : -1;
    
    return $ret_id;
  }
}
?>