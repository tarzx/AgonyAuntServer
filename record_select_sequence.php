
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

    if (isset($_POST['seq1'])) { $seq1 = $_POST['seq1']; $seqno = 1; $rate = $seq1; }
        else { $seq1 = null; }
    if (isset($_POST['seq2'])) { $seq2 = $_POST['seq2']; $seqno = 2; $rate = $seq2; }
        else { $seq2 = null; }
    if (isset($_POST['seq3'])) { $seq3 = $_POST['seq3']; $seqno = 3; $rate = $seq3; }
        else { $seq3 = null; }
    if (isset($_POST['seq4'])) { $seq4 = $_POST['seq4']; $seqno = 4; $rate = $seq4; }
        else { $seq4 = null; }
    if (isset($_POST['seq5'])) { $seq5 = $_POST['seq5']; $seqno = 5; $rate = $seq5; }
        else { $seq5 = null; }
    if (isset($_POST['seq6'])) { $seq6 = $_POST['seq6']; $seqno = 6; $rate = $seq6; }
        else { $seq6 = null; }
    if (isset($_POST['seq7'])) { $seq7 = $_POST['seq7']; $seqno = 7; $rate = $seq7; }
        else { $seq7 = null; }
    if (isset($_POST['seq8'])) { $seq8 = $_POST['seq8']; $seqno = 8; $rate = $seq8; }
        else { $seq8 = null; }

 
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql inserting a new row
    if (!is_null($seq1)) {
        $result = mysql_query("INSERT INTO CBT_select_sequence(pid, control_level, seq1) VALUES($pid, $control_level, $seq1)");
    }
    if (!is_null($seq2)) {
        $result = mysql_query("INSERT INTO CBT_select_sequence(pid, control_level, seq2) VALUES($pid, $control_level, $seq2)");
    }
    if (!is_null($seq3)) {
        $result = mysql_query("INSERT INTO CBT_select_sequence(pid, control_level, seq3) VALUES($pid, $control_level, $seq3)");
    }
    if (!is_null($seq4)) {
        $result = mysql_query("INSERT INTO CBT_select_sequence(pid, control_level, seq4) VALUES($pid, $control_level, $seq4)");
    }
    if (!is_null($seq5)) {
        $result = mysql_query("INSERT INTO CBT_select_sequence(pid, control_level, seq5) VALUES($pid, $control_level, $seq5)");
    }
    if (!is_null($seq6)) {
        $result = mysql_query("INSERT INTO CBT_select_sequence(pid, control_level, seq6) VALUES($pid, $control_level, $seq6)");
    }
    if (!is_null($seq7)) {
        $result = mysql_query("INSERT INTO CBT_select_sequence(pid, control_level, seq7) VALUES($pid, $control_level, $seq7)");
    }
    if (!is_null($seq8)) {
        $result = mysql_query("INSERT INTO CBT_select_sequence(pid, control_level, seq8) VALUES($pid, $control_level, $seq8)");
    }

    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Sequence '$seqno' ('$rate') successfully created.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        if (!is_null($seq1)) {
            $result = mysql_query("UPDATE CBT_select_sequence SET seq1 = $seq1 WHERE pid = $pid AND control_level = $control_level;");
        }
        if (!is_null($seq2)) {
            $result = mysql_query("UPDATE CBT_select_sequence SET seq2 = $seq2 WHERE pid = $pid AND control_level = $control_level;");
        }
        if (!is_null($seq3)) {
            $result = mysql_query("UPDATE CBT_select_sequence SET seq3 = $seq3 WHERE pid = $pid AND control_level = $control_level;");
        }
        if (!is_null($seq4)) {
            $result = mysql_query("UPDATE CBT_select_sequence SET seq4 = $seq4 WHERE pid = $pid AND control_level = $control_level;");
        }
        if (!is_null($seq5)) {
            $result = mysql_query("UPDATE CBT_select_sequence SET seq5 = $seq5 WHERE pid = $pid AND control_level = $control_level;");
        }
        if (!is_null($seq6)) {
            $result = mysql_query("UPDATE CBT_select_sequence SET seq6 = $seq6 WHERE pid = $pid AND control_level = $control_level;");
        }
        if (!is_null($seq7)) {
            $result = mysql_query("UPDATE CBT_select_sequence SET seq7 = $seq7 WHERE pid = $pid AND control_level = $control_level;");
        }
        if (!is_null($seq8)) {
            $result = mysql_query("UPDATE CBT_select_sequence SET seq8 = $seq8 WHERE pid = $pid AND control_level = $control_level;");
        }        
        
        if ($result) {
            // successfully inserted into database
            $response["success"] = 1;
            $response["message"] = "Sequence $seqno ($rate) successfully updated.";
     
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