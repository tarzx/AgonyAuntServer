<?php
 
/*
 * Following code will update a patient information
 * A patient is identified by patient id (pid)
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['pid']) && isset($_POST['name']) && isset($_POST['age']) && isset($_POST['gender']) && isset($_POST['occupation']) && isset($_POST['interventionFrequency'])) {
 
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender =$_POST['gender'];
    $occupation = $_POST['occupation'];
    $interventionFrequency = $_POST['interventionFrequency'];
 
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql update row with matched pid
    $result = mysql_query("UPDATE patients SET name = '$name', age = '$age', gender = '$gender', occupation = '$occupation', interventionFrequency = '$interventionFrequency' WHERE pid = $pid");
 
    // check if row inserted or not
    if ($result) {
        // successfully updated
        $response["success"] = 1;
        $response["message"] = "Patient successfully updated.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
 
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>