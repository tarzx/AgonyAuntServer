<?php
 
/*
 * Following code will get single patient details
 * A patient is identified by patient id (pid)
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . "/db_connect.php";
 
// connecting to db
$db = new DB_CONNECT();
 
// check for post data
if (isset($_GET["pid"])) {
    $pid = $_GET["pid"];
    $control_level = $_GET["control_level"];
 
    // get a patient from patients table
    $result = mysql_query("SELECT c1.pid, c1.name, (YEAR(CURDATE())-c1.birth_year) AS age, c1.gender, IF(c1.set_frequency=0, NULL, c2.frequency1) AS frequency1, IF(c1.set_frequency=0, NULL, c2.frequency2) AS frequency2, IF(c1.set_frequency=0, NULL, c2.frequency3) AS frequency3, IF(c1.set_frequency=0, NULL, c2.frequency4) AS frequency4, IF(c1.set_slot=0, NULL, c2.slot1) AS slot1, IF(c1.set_slot=0, NULL, c2.slot2) AS slot2, IF(c1.set_slot=0, NULL, c2.slot3) AS slot3, IF(c1.set_slot=0, NULL, c2.slot4) AS slot4, IF(c1.set_slot=0, NULL, c2.slot5) AS slot5, IF(c1.set_slot=0, NULL, c2.slot6) AS slot6 FROM CBT_patients c1 JOIN CBT_preference c2 ON c1.pid = c2.pid WHERE c2.pid = $pid AND c2.control_level = $control_level;");
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
 
            $result = mysql_fetch_array($result);
 
            $patient = array();
            $patient["pid"] = $result["pid"];
            $patient["name"] = $result["name"];
            $patient["age"] = $result["age"];
            $patient["gender"] = $result["gender"];
            $patient["frequency1"] = $result["frequency1"];
            $patient["frequency2"] = $result["frequency2"];
            $patient["frequency3"] = $result["frequency3"];
            $patient["frequency4"] = $result["frequency4"];
            $patient["slot1"] = $result["slot1"];
            $patient["slot2"] = $result["slot2"];
            $patient["slot3"] = $result["slot3"];
            $patient["slot4"] = $result["slot4"];
            $patient["slot5"] = $result["slot5"];
            $patient["slot6"] = $result["slot6"];
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