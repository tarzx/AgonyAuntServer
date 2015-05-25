
<?php
 
/*
 * Following code will create a new patient row
 * All patient details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['pid']) && isset($_POST['control_level'])) {
 

    $pid = $_POST['pid'];
    $control_level = $_POST['control_level'];

    $freq = null; $freqRate = null; $slot = null; $slotRate = null;

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

 
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql inserting a new row
    if (!is_null($frequency1)) {
        $result = mysql_query("INSERT INTO CBT_preference(pid, control_level, frequency1) VALUES($pid, $control_level, $frequency1)");
    } else if (!is_null($frequency2)) {
        $result = mysql_query("INSERT INTO CBT_preference(pid, control_level, frequency2) VALUES($pid, $control_level, $frequency2)");
    } else if (!is_null($frequency3)) {
        $result = mysql_query("INSERT INTO CBT_preference(pid, control_level, frequency3) VALUES($pid, $control_level, $frequency3)");
    } else if (!is_null($frequency4)) {
        $result = mysql_query("INSERT INTO CBT_preference(pid, control_level, frequency4) VALUES($pid, $control_level, $frequency4)");
    } else if (!is_null($frequency5)) {
        $result = mysql_query("INSERT INTO CBT_preference(pid, control_level, frequency5) VALUES($pid, $control_level, $frequency5)");
    } else if (!is_null($frequency6)) {
        $result = mysql_query("INSERT INTO CBT_preference(pid, control_level, frequency6) VALUES($pid, $control_level, $frequency6)");
    } else if (!is_null($frequency7)) {
        $result = mysql_query("INSERT INTO CBT_preference(pid, control_level, frequency7) VALUES($pid, $control_level, $frequency7)");
    } else if (!is_null($slot1)) {
        $result = mysql_query("INSERT INTO CBT_preference(pid, control_level, slot1) VALUES($pid, $control_level, $slot1)");
    } else if (!is_null($slot2)) {
        $result = mysql_query("INSERT INTO CBT_preference(pid, control_level, slot2) VALUES($pid, $control_level, $slot2)");
    } else if (!is_null($slot3)) {
        $result = mysql_query("INSERT INTO CBT_preference(pid, control_level, slot3) VALUES($pid, $control_level, $slot3)");
    } else if (!is_null($slot4)) {
        $result = mysql_query("INSERT INTO CBT_preference(pid, control_level, slot4) VALUES($pid, $control_level, $slot4)");
    } else if (!is_null($slot5)) {
        $result = mysql_query("INSERT INTO CBT_preference(pid, control_level, slot5) VALUES($pid, $control_level, $slot5)");
    } else if (!is_null($slot6)) {
        $result = mysql_query("INSERT INTO CBT_preference(pid, control_level, slot6) VALUES($pid, $control_level, $slot6)");
    }

    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Preference slot $slot ($slotRate) & frequency $freq ($freqRate) successfully created.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        if (!is_null($frequency1)) {
            $result = mysql_query("UPDATE CBT_preference SET frequency1 = $frequency1 WHERE pid = $pid AND control_level = $control_level;");
        }
        if (!is_null($frequency2)) {
            $result = mysql_query("UPDATE CBT_preference SET frequency2 = $frequency2 WHERE pid = $pid AND control_level = $control_level;");
        }     
        if (!is_null($frequency3)) {
            $result = mysql_query("UPDATE CBT_preference SET frequency3 = $frequency3 WHERE pid = $pid AND control_level = $control_level;");
        }
        if (!is_null($frequency4)) {
            $result = mysql_query("UPDATE CBT_preference SET frequency4 = $frequency4 WHERE pid = $pid AND control_level = $control_level;");
        }
        if (!is_null($frequency5)) {
            $result = mysql_query("UPDATE CBT_preference SET frequency5 = $frequency5 WHERE pid = $pid AND control_level = $control_level;");
        }     
        if (!is_null($frequency6)) {
            $result = mysql_query("UPDATE CBT_preference SET frequency6 = $frequency6 WHERE pid = $pid AND control_level = $control_level;");
        }
        if (!is_null($frequency7)) {
            $result = mysql_query("UPDATE CBT_preference SET frequency7 = $frequency7 WHERE pid = $pid AND control_level = $control_level;");
        }
        if (!is_null($slot1)) {
            $result = mysql_query("UPDATE CBT_preference SET slot1 = $slot1 WHERE pid = $pid AND control_level = $control_level;");
        }
        if (!is_null($slot2)) {
            $result = mysql_query("UPDATE CBT_preference SET slot2 = $slot2 WHERE pid = $pid AND control_level = $control_level;");
        }
        if (!is_null($slot3)) {
            $result = mysql_query("UPDATE CBT_preference SET slot3 = $slot3 WHERE pid = $pid AND control_level = $control_level;");
        }
        if (!is_null($slot4)) {
            $result = mysql_query("UPDATE CBT_preference SET slot4 = $slot4 WHERE pid = $pid AND control_level = $control_level;");
        }
        if (!is_null($slot5)) {
            $result = mysql_query("UPDATE CBT_preference SET slot5 = $slot5 WHERE pid = $pid AND control_level = $control_level;");
        }
        if (!is_null($slot6)) {
            $result = mysql_query("UPDATE CBT_preference SET slot6 = $slot6 WHERE pid = $pid AND control_level = $control_level;");
        }
        
        
        if ($result) {
            // successfully inserted into database
            $response["success"] = 1;
            $response["message"] = "Perference slot $slot ($slotRate) & frequency $freq ($freqRate) successfully updated.";
     
            // echoing JSON response
            echo json_encode($response);
        } else {
            // failed to insert row
            $response["success"] = 0;
            $response["message"] = "Oops! An error occurred.";
     
            // echoing JSON response
            echo json_encode($response);
        }
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>