<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    exit(0);
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
        case 'get_drug_property':
        	$ndc = $_REQUEST['ndc'];
			$sql = "SELECT Drug_Properties.*, patient_interactivity_code.prescription_ready FROM patient_interactivity_code LEFT JOIN Drug_Properties ON patient_interactivity_code.ndc1=Drug_Properties.ndc WHERE patient_interactivity_code.ndc1='$ndc'";
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
        case 'drug_information':
        	$ndc = $_REQUEST['ndc'];
			$sql = "SELECT patient_drug_information.* FROM patient_drug_information LEFT JOIN Drug_Properties ON patient_drug_information.brand_name=Drug_Properties.brand_name  WHERE Drug_Properties.ndc='$ndc'";
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
        case 'drug_image':
        	$abs_url = SITEURL . "/images/uploads/drug_image_image/";
        	$ndc = $_REQUEST['ndc'];
			$sql = "SELECT * FROM drug_image WHERE drug_image.ndc='$ndc'";
		    $data = array();
		    if ($result = $mysqli->query($sql)) {
				if ($result->num_rows>0)
				{
					$ret['status_code'] = 200;
					$ret['count'] = $result->num_rows;
					while($row = $result->fetch_assoc())
					{
						$row['images'] = [];
						for($i=1;$i<8;$i++)
						{
							if ($row["file_name_{$i}"] != NULL)
							{
								array_push($row['images'], $abs_url . $row["file_name_{$i}"]);
								unset($row["file_name_{$i}"]);
							}
						}
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
		case 'quiz_get':
        	$ndc = $_REQUEST['ndc'];
			$sql = "SELECT quiz_name.* FROM quiz_name LEFT JOIN Drug_Properties ON quiz_name.generic_name=Drug_Properties.generic_name  WHERE Drug_Properties.ndc='$ndc'";
		    $data = array();
		    if ($result = $mysqli->query($sql)) {
				if ($result->num_rows>0)
				{
					$quiz_id = -1;
					$quiz_name = "";
					$ret['status_code'] = 200;
					while($row = $result->fetch_assoc())
					{
						$quiz_id = $row['quiz_id'];
						$quiz_name = $row['quiz_name'];
						break;
					}
					$data['name'] = $quiz_name;
					$sql_questions = "SELECT * from quiz_questions WHERE quiz_id='{$quiz_id}'";
					$sql_options = "SELECT * from quiz_options WHERE quiz_id='{$quiz_id}'";
					$data_q = array();
					$data_o = array();
					if($result1 = $mysqli->query($sql_questions))
					{
						if ($result1->num_rows > 0)
						{
							while($row1 = $result1->fetch_assoc())
							{
								$data_q[] = $row1;
							}
						}
					}
					if($result2 = $mysqli->query($sql_options))
					{
						if ($result2->num_rows > 0)
						{
							while($row2 = $result2->fetch_assoc())
							{
								$data_o[] = $row2;
							}
						}
					}
					$data['questions'] = $data_q;
					$data['options'] = $data_o;
					$ret['data'] = $data;
				}
				else
					$ret = array('status_code' => 200, 'count' => 0, 'data' => []);
		    }
		    else
		    	$ret = array('status_code' => 400, 'count' => 0, 'data' => []);
		    break;
        default:
        	$ret = array('status_code' => 400, 'data' => []);
        	break;
    }
    echo json_encode($ret);
}
else
	echo json_encode(array('status_code' => 400, 'data' => []));
?>