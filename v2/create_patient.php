
<?php
 
/*
 * Following code will create a new patient row
 * All patient details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['name']) && isset($_POST['age']) && isset($_POST['gender']) && isset($_POST['set_frequency']) && isset($_POST['set_slot'])) {
 
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $set_frequency = $_POST['set_frequency'];
    $set_slot = $_POST['set_slot'];

    $freq = null; $freqRate = null; $slot = null; $slotRate = null;
 
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // get next pid
    $query = mysql_query("SELECT MAX(pid) FROM CBT_patients");
    $results = mysql_fetch_array($query);
    $pid = $results['MAX(pid)'] + 1;

    // mysql inserting a new row
    $result = mysql_query("INSERT INTO CBT_patients(pid, name, birth_year, gender, set_frequency, set_slot) VALUES($pid, '$name', (YEAR(CURDATE())-$age), $gender, $set_frequency, $set_slot)");
 
    // check if row inserted or not
    if ($result) {

        for ($i = 1; $i <= 20; $i++) {
            $result = mysql_query("INSERT INTO CBT_preference(pid, control_level) VALUES($pid, $i)");
        }
        
        if ($set_frequency=="1") {
            if (isset($_POST['frequency1'])) { $frequency1 = $_POST['frequency1']; $freq = 1; $freqRate = $frequency1; }
                else { $frequency1 = null; }
            if (isset($_POST['frequency2'])) { $frequency2 = $_POST['frequency2']; $freq = 2; $freqRate = $frequency2; }
                else { $frequency2 = null; }
            if (isset($_POST['frequency3'])) { $frequency3 = $_POST['frequency3']; $freq = 3; $freqRate = $frequency3; }
                else { $frequency3 = null; }
            if (isset($_POST['frequency4'])) { $frequency4 = $_POST['frequency4']; $freq = 4; $freqRate = $frequency4; }
                else { $frequency4 = null; }
            if (isset($_POST['frequency5'])) { $frequency5 = $_POST['frequency5']; $freq = 5; $freqRate = $frequency5; }
                else { $frequency5 = null; }
            if (isset($_POST['frequency6'])) { $frequency6 = $_POST['frequency6']; $freq = 6; $freqRate = $frequency6; }
                else { $frequency6 = null; }
            if (isset($_POST['frequency7'])) { $frequency7 = $_POST['frequency7']; $freq = 7; $freqRate = $frequency7; }
                else { $frequency7 = null; }

            $result = mysql_query("UPDATE CBT_preference SET frequency1 = $frequency1, frequency2 = $frequency2, frequency3 = $frequency3, frequency4 = $frequency4, frequency5 = $frequency5, frequency6 = $frequency6, frequency7 = $frequency7 WHERE pid = $pid AND control_level BETWEEN 1 AND 20;");
        }   

        if ($set_slot=="1") {
            if (isset($_POST['slot1'])) { $slot1 = $_POST['slot1']; $slot = 1; $slotRate = $slot1; }
                else { $slot1 = null; }
            if (isset($_POST['slot2'])) { $slot2 = $_POST['slot2']; $slot = 2; $slotRate = $slot2; }
                else { $slot2 = null; }
            if (isset($_POST['slot3'])) { $slot3 = $_POST['slot3']; $slot = 3; $slotRate = $slot3; }
                else { $slot3 = null; }
            if (isset($_POST['slot4'])) { $slot4 = $_POST['slot4']; $slot = 4; $slotRate = $slot4; }
                else { $slot4 = null; }
            if (isset($_POST['slot5'])) { $slot5 = $_POST['slot5']; $slot = 5; $slotRate = $slot5; }
                else { $slot5 = null; }
            if (isset($_POST['slot6'])) { $slot6 = $_POST['slot6']; $slot = 6; $slotRate = $slot6; }
                else { $slot6 = null; }

            $result = mysql_query("UPDATE CBT_preference SET slot1 = $slot1, slot2 = $slot2, slot3 = $slot3, slot4 = $slot4, slot5 = $slot5, slot6 = $slot6 WHERE pid = $pid AND control_level BETWEEN 1 AND 20;");
        }
        
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Patient successfully created.";
        $response["pid"] = $pid;
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
        $response["pid"] = 0;
 
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
    $response["pid"] = 0;
 
    // echoing JSON response
    echo json_encode($response);
}
?>