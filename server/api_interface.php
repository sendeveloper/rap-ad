<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once("config.php");
if (isset($_REQUEST)) {
	$ret = array();
    $flag  = isset($_REQUEST['flag']) ? $_REQUEST['flag'] : "";
    switch ($flag) {
        case 'check_active_code':
        	$code = $_REQUEST['code'];
			$sql = "SELECT * FROM patient_interactivity_code WHERE interactive_code='$code'";
		    $data = array();
		    if ($result = $mysqli->query($sql)) {
				if ($result->num_rows>0)
				{
					$ret['status_code'] = 200;
					$ret['count'] = $result->num_rows;
					while($row = $result->fetch_assoc())
					{
						$data[] = $row;
					}
					$ret['data'] = $data;
				}
				else
					$ret = array('status_code' => 200, 'count' => 0, 'data' => []);
		    }
		    else
		    	$ret = array('status_code' => 400, 'count' => 0, 'data' => []);
		    break;
        case 'register':
        	break;
        default:
        	$ret = array('status_code' => 400, 'data' => []);
        	break;
            # code...            break;    
    }
    echo json_encode($ret);
}
else
	echo json_encode(array('status_code' => 400, 'data' => []));
?>