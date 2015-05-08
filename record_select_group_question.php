
<?php
 
/*
 * Following code will create a new patient row
 * All patient details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['pid']) && isset($_POST['control_level']) && isset($_POST['previous_group'])) {
 

    $pid = $_POST['pid'];
    $control_level = $_POST['control_level'];
    $previous_group = $_POST['previous_group'];
 
    if (isset($_POST['group3'])) { $group3 = $_POST['group3']; $groupq = 3; $rate = $group3; }
        else { $group3 = null; }
    if (isset($_POST['group4'])) { $group4 = $_POST['group4']; $groupq = 4; $rate = $group4; }
        else { $group4 = null; }
    if (isset($_POST['group10'])) { $group10 = $_POST['group10']; $groupq = 10; $rate = $group10; }
        else { $group10 = null; }
    if (isset($_POST['group11'])) { $group11 = $_POST['group11']; $groupq = 11; $rate = $group11; }
        else { $group11 = null; }

 
    // include db connect class
    require_once __DIR__ . '/db_connect.php';

    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql inserting a new row
    if (!is_null($group3)) {
        $result = mysql_query("INSERT INTO CBT_select_group_question (pid, control_level, previous_group, group3) VALUES($pid, $control_level, $previous_group, $group3)");
    }
    if (!is_null($group4)) {
        $result = mysql_query("INSERT INTO CBT_select_group_question (pid, control_level, previous_group, group4) VALUES($pid, $control_level, $previous_group, $group4)");
    }
    if (!is_null($group10)) {
        $result = mysql_query("INSERT INTO CBT_select_group_question (pid, control_level, previous_group, group10) VALUES($pid, $control_level, $previous_group, $group10)");
    }
    if (!is_null($group11)) {
        $result = mysql_query("INSERT INTO CBT_select_group_question (pid, control_level, previous_group, group11) VALUES($pid, $control_level, $previous_group, $group11)");
    }

    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Group question $groupq ($rate) successfully created.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        if (!is_null($group3)) {
            $result = mysql_query("UPDATE CBT_select_group_question SET group3 = $group3 WHERE pid = $pid AND control_level = $control_level AND previous_group = $previous_group;");
        }
        if (!is_null($group4)) {
            $result = mysql_query("UPDATE CBT_select_group_question SET group4 = $group4 WHERE pid = $pid AND control_level = $control_level AND previous_group = $previous_group;");
        }
        if (!is_null($group10)) {
            $result = mysql_query("UPDATE CBT_select_group_question SET group10 = $group10 WHERE pid = $pid AND control_level = $control_level AND previous_group = $previous_group;");
        }
        if (!is_null($group11)) {
            $result = mysql_query("UPDATE CBT_select_group_question SET group11 = $group11 WHERE pid = $pid AND control_level = $control_level AND previous_group = $previous_group;");
        }       
        
        if ($result) {
            // successfully inserted into database
            $response["success"] = 1;
            $response["message"] = "Group question $groupq ($rate) updated.";
     
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