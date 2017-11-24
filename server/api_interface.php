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
        case 'get_drug_property':
        	$ndc = $_REQUEST['ndc'];
			$sql = "SELECT drug_properties.*, patient_interactivity_code.prescription_ready FROM patient_interactivity_code LEFT JOIN drug_properties ON patient_interactivity_code.ndc1=drug_properties.ndc WHERE patient_interactivity_code.ndc1='$ndc'";
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
			$sql = "SELECT patient_drug_information.* FROM patient_drug_information LEFT JOIN drug_properties ON patient_drug_information.brand_name=drug_properties.brand_name  WHERE drug_properties.ndc='$ndc'";
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