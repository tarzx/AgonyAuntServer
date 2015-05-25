<?php
 
/*
 * Following code will list all the patients
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// get all patients from patients table
$result = mysql_query('SELECT pid, name, (YEAR(CURDATE())-birth_year) age, gender, set_frequency, set_slot FROM CBT_patients;') or die(mysql_error());
 
// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // patients node
    $response["patients"] = array();
 
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $patient = array();
        $patient["pid"] = $row["pid"];
        $patient["name"] = $row["name"];
        $patient["age"] = $row["age"];
        $patient["gender"] = $row["gender"];
        $patient["set_frequency"] = $row["set_frequency"];
        $patient["set_slot"] = $row["set_slot"];
         
        // push single patient into final response array
        array_push($response["patients"], $patient);
    }
    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} else {
    // no patients found
    $response["success"] = 0;
    $response["message"] = "No patients found";
 
    // echo no users JSON
    echo json_encode($response);
}
?>