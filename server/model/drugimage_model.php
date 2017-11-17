<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (file_exists(dirname(__FILE__)."/config.php"))
	require_once(dirname(__FILE__)."/config.php");
else if (file_exists(dirname(__FILE__)."/../config.php"))
	require_once(dirname(__FILE__)."/../config.php");

class DrugimageModel{
	private $table_name;
	public function __construct()
  {
  	$this->table_name = "drug_image";
  }
  public function insert_drug_image($data) {
    global $mysqli;
    $ret_id = -1;
    $sql1 = "(";
    $sql2 = "VALUES (";
    foreach($data as $key => &$each)
    {
      $each = $mysqli->escape_string($each);
      $sql1 .= $key . ", ";
      $sql2 .= "'" . $each . "', ";
    }
    $sql = "INSERT INTO {$this->table_name}";
    $sql .= substr($sql1, 0, strlen($sql1)-2) . ") ";
    $sql .= substr($sql2, 0, strlen($sql2)-2) . ")";

    $mysqli->query($sql);
    $ret_id = $mysqli->insert_id;
    
    return $ret_id;
  }
  public function get_drug_simple_list() {
    global $mysqli;
    $sql = "SELECT drug_image_id, ndc FROM {$this->table_name} ORDER BY drug_image_id DESC";
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
  public function get_drug_list($filter) {
    global $mysqli;
    $sql = "SELECT {$this->table_name}.*, drug_color.drug_color, drug_shape.drug_shape FROM {$this->table_name} LEFT JOIN drug_color ON drug_color.drug_color_id={$this->table_name}.drug_color_id LEFT JOIN drug_shape ON drug_shape.drug_shape_id={$this->table_name}.drug_shape_id";
    if ($filter != "")
      $sql .= " WHERE `ndc` LIKE '%{$filter}%'";
    $sql .= " ORDER BY drug_image_id DESC";
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
    $sql = "SELECT {$this->table_name}.*, drug_color.drug_color, drug_shape.drug_shape FROM {$this->table_name} LEFT JOIN drug_color ON drug_color.drug_color_id={$this->table_name}.drug_color_id LEFT JOIN drug_shape ON drug_shape.drug_shape_id={$this->table_name}.drug_shape_id WHERE drug_image_id={$id}";
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
    $sql = "DELETE FROM {$this->table_name} WHERE drug_image_id={$id}";
    $ret = array();
    $count = $mysqli->query($sql);
    
    if (!$count)
      return -1;
    return $count;
  }
  public function update_drug_image($data) {
    global $mysqli;
    $ret_id = -1;
    $sql = "UPDATE {$this->table_name} SET ";
    foreach($data as $key => $each)
    {
      $each = $mysqli->escape_string($each);
      $sql .= " {$key} = '$each', ";
    }
    $sql = substr($sql, 0, strlen($sql) - 2);
    $sql .= " WHERE drug_image_id = '{$data['drug_image_id']}'";
    $result = $mysqli->query($sql);
    $ret_id = $result ? 1 : -1;
    
    return $ret_id;
  }
}
?>