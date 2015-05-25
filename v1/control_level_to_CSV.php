<?php

require_once __DIR__ . '/db_connect.php';

$db = new DB_CONNECT();

  //header to give the order to the browser
        // header('Content-Type: text/csv; charset=utf-8');

        // header('Content-Disposition: attachment; filename = '.date("Ymd").'.csv'); 



//select table to export the data
$select_table = mysql_query('SELECT control_level, response_time, conversation_depth, first_question FROM control_level');
$rows = mysql_fetch_assoc($select_table);

$fp = fopen('firstLevelQuestion.csv', 'w');

if ($rows)
{
	getcsv(array_keys($rows));
	fputcsv($fp, array_keys($rows));
}
while($rows)
{
	getcsv($rows);
	fputcsv($fp, $rows);
	$rows = mysql_fetch_assoc($select_table);
}

// get total number of fields present in the database
function getcsv($no_of_field_names)
{
	$separate = '';


// do the action for all field names as field name
foreach ($no_of_field_names as $field_name)
{
	if (preg_match('/\\r|\\n|,|"/', $field_name))
	{
		$field_name = '' . str_replace('', $field_name) . '';
	}
	echo $separate . $field_name;

	//sepearte with the comma
	$separate = ',';
}

//make new row and line
echo "\r\n";
}



?>