<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (file_exists(dirname(__FILE__)."/config.php"))
	require_once(dirname(__FILE__)."/config.php");
else if (file_exists(dirname(__FILE__)."/../config.php"))
	require_once(dirname(__FILE__)."/../config.php");

class DrugeducationModel{
	private $table_name;
	public function __construct()
  {
  	$this->table_name = "patient_drug_information";
  }
  public function insert_drug_education($data) {
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
  public function get_drug_list($page, $filter) {
    global $mysqli;
    $ret = array();
    $sql_count = "SELECT count(*) as count FROM {$this->table_name}";
    $sql = "SELECT * FROM {$this->table_name}";
    if ($filter != ""){
      $sql .= " WHERE `ndc` LIKE '%{$filter}%'";
      $sql_count .= " WHERE `ndc` LIKE '%{$filter}%'";
      $result_count = $mysqli->query($sql_count);
      $row = $result_count->fetch_row();
      $ret['count'] = $row[0];
    }
    $offset = (int)($page-1) * 10;
    $sql .= " ORDER BY ndc DESC LIMIT 10 OFFSET {$offset}";
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
    $sql = "SELECT * FROM {$this->table_name} WHERE id='{$id}'";
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
    $sql = "DELETE FROM {$this->table_name} WHERE id='{$id}'";
    $ret = array();
    $count = $mysqli->query($sql);
    
    if (!$count)
      return -1;
    return $count;
  }
  public function update_drug_education($data) {
    global $mysqli;
    $ret_id = -1;
    $sql = "UPDATE {$this->table_name} SET ";
    foreach($data as $key => $each)
    {
      $each = $mysqli->escape_string($each);
      $sql .= " {$key} = '$each', ";
    }
    $sql = substr($sql, 0, strlen($sql) - 2);
    $sql .= " WHERE id = '{$data['id']}'";
    $result = $mysqli->query($sql);
    $ret_id = $result ? 1 : -1;
    
    return $ret_id;
  }
}
?>