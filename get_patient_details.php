<?php
 
/*
 * Following code will get single patient details
 * A patient is identified by patient id (pid)
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// check for post data
if (isset($_GET["pid"])) {
    $pid = $_GET['pid'];
 
    // get a patient from patients table
    $result = mysql_query("SELECT *FROM patients WHERE pid = $pid");
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
 
            $result = mysql_fetch_array($result);
 
            $patient = array();
            $patient["pid"] = $result["pid"];
            $patient["name"] = $result["name"];
            $patient["age"] = $result["age"];
            $patient["gender"] = $result["gender"];
            $patient["occupation"] = $result["occupation"];
            $patient["interventionFrequency"] = $result["interventionFrequency"];

            $patient["created_at"] = $result["created_at"];
            $patient["updated_at"] = $result["updated_at"];
            // success
            $response["success"] = 1;
 
            // user node
            $response["patient"] = array();
 
            array_push($response["patient"], $patient);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no patient found
            $response["success"] = 0;
            $response["message"] = "No patient found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no patient found
        $response["success"] = 0;
        $response["message"] = "No patient found";
 
        // echo no users JSON
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>