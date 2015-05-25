<?php
 
/*
 * Following code will delete a patient from table
 * A patient is identified by patient id (pid)
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];
 
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql update row with matched pid
    $result = mysql_query("DELETE FROM CBT_patients WHERE pid = $pid;");
 
    // check if row deleted or not
    if (mysql_affected_rows() > 0) {

        $result = mysql_query("DELETE FROM CBT_preference WHERE pid = $pid;");
        $result = mysql_query("DELETE FROM CBT_select_group_question WHERE pid = $pid;");
        $result = mysql_query("DELETE FROM CBT_select_sequence WHERE pid = $pid;");
        
        // successfully updated
        $response["success"] = 1;
        $response["message"] = "Patient successfully deleted";
 
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
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>