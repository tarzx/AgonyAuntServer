<?php

require_once __DIR__ . '/db_connect.php';

$db = new DB_CONNECT();

  //header to give the order to the browser
        // header('Content-Type: text/csv; charset=utf-8');

        // header('Content-Disposition: attachment; filename = '.date("Ymd").'.csv'); 



//select table to export the data
$select_table = mysql_query('SELECT c1.control_level, (YEAR(CURDATE())-c2.birth_year) age, c2.gender, c1.slot1, c1.slot2, c1.slot3, c1.slot4, c1.slot5, c1.slot6 FROM CBT_preference c1 JOIN CBT_patients c2 ON c1.pid=c2.pid WHERE (c1.slot1 IS NOT NULL OR c1.slot2 IS NOT NULL OR c1.slot3 IS NOT NULL OR c1.slot4 IS NOT NULL OR c1.slot5 IS NOT NULL OR c1.slot6 IS NOT NULL);');
$rows = mysql_fetch_assoc($select_table);

$fp = fopen('slotIntervention.csv', 'w');

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