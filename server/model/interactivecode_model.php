<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (file_exists(dirname(__FILE__)."/config.php"))
	require_once(dirname(__FILE__)."/config.php");
else if (file_exists(dirname(__FILE__)."/../config.php"))
	require_once(dirname(__FILE__)."/../config.php");

class InteractivecodeModel{
	private $table_name;
	public function __construct()
  {
  	$this->table_name = "patient_interactivity_code";
  }
  public function insert_interactive_code($data) {
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
  public function get_code_simple_list() {
    global $mysqli;
    $sql = "SELECT interactive_code FROM {$this->table_name} ORDER BY interactive_code";
    $ret = array();
    if ($result = $mysqli->query($sql)) {
      if ($result->num_rows>0)
      {
        while($row = $result->fetch_assoc())
        {
          $temp = array('code' => $row['interactive_code']);
          $ret[] = $temp;
        }
      }
    }
    
    return $ret;
  }
  public function get_code_list($filter) {
    global $mysqli;
    $ret = array();
    $sql = "SELECT * FROM {$this->table_name}";
    if ($filter != ""){
      $sql .= " WHERE `interactive_code` LIKE '%{$filter}%'";
    }
    $sql .= " ORDER BY interactive_code DESC";
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
  public function get_code_one($id) {
    global $mysqli;
    $sql = "SELECT * FROM {$this->table_name} WHERE interactive_code_id='{$id}'";
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
  public function get_code_delete($id) {
    global $mysqli;
    $sql = "DELETE FROM {$this->table_name} WHERE interactive_code_id='{$id}'";
    $ret = array();
    $count = $mysqli->query($sql);
    
    if (!$count)
      return -1;
    return $count;
  }
  public function update_interactive_code($data) {
    global $mysqli;
    $ret_id = -1;
    $sql = "UPDATE {$this->table_name} SET ";
    foreach($data as $key => $each)
    {
      $each = $mysqli->escape_string($each);
      $sql .= " {$key} = '$each', ";
    }
    $sql = substr($sql, 0, strlen($sql) - 2);
    $sql .= " WHERE interactive_code_id = '{$data['interactive_code_id']}'";
    $result = $mysqli->query($sql);
    $ret_id = $result ? 1 : -1;
    
    return $ret_id;
  }
}
?>