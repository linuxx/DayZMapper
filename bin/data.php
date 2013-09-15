<?php
// Works with schema 0.36
error_reporting(0);

header('Content-Type: text/plain');
// Avoid browser caching
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

include('config.php');

try {
	$db = new PDO('mysql:host='.$db['host'].';port='.$db['port'].';dbname='.$db['database'], $db['user'], $db['password']);
} catch(PDOException $e) {
	die($e -> getMessage());
}

echo '<stuff>' . "\n";
echo "\t<icons>".($config['icons']?"true":"false")."</icons>\n";

$query = $db->prepare("SELECT
	s.CharacterID as id,
	s.Model as model,
	s.CurrentState as state,
	s.Worldspace as worldspace,
	s.Inventory as inventory,
	p.PlayerName as name,
	s.Humanity as humanity,
	s.Datestamp as last_updated,
	s.KillsH as hkills,
	s.KillsB as bkills
FROM
	Character_DATA s
INNER JOIN
	Player_DATA p on p.PlayerUID = s.PlayerUID
WHERE
	s.LastLogin > DATE_SUB(now(), INTERVAL 12 HOUR)
AND
	s.Alive = 1");

$query->execute(array($config['instance']));
$rows = $query->fetchAll(PDO::FETCH_ASSOC);

foreach($rows as $row)
{
	$posArray = json_decode($row['worldspace']);
	
	$row['x'] = $posArray[1][0];
	$row['y'] = -($posArray[1][1]-15365);
	
	$row['age'] = strtotime($row['last_updated']) - time();
	$row['name'] = htmlspecialchars($row['name']);
	
	echo "\t" . '<player>' . "\n";
	foreach($row as $k => $v)
	{
		echo "\t\t" . '<' . $k . '><![CDATA[' . $v . ']]></' . $k . '>' . "\n";
	}
	echo "\t" . '</player>' . "\n";
}

$query = $db->prepare("SELECT
	iv.ObjectID as id,
	iv.Worldspace as worldspace,
	iv.ClassName as otype,
	iv.inventory as inventory,
	iv.Datestamp as last_updated
FROM
	Object_DATA iv
WHERE 
	Fuel > 0.00001");
	
$query->execute(array($config['instance']));
$rows = $query->fetchAll(PDO::FETCH_ASSOC);

foreach($rows as $row)
{
	$posArray = json_decode($row["worldspace"]);
	
	$row['x'] = $posArray[1][0];
	$row['y'] = -($posArray[1][1]-15365);
	
	$row['age'] = strtotime($row['last_updated']) - time();
	
	echo "\t" . '<vehicle>' . "\n";
	foreach($row as $k => $v)
	{
		echo "\t\t" . '<' . $k . '><![CDATA[' . $v . ']]></' . $k . '>' . "\n";
	}
	echo "\t" . '</vehicle>' . "\n";
}
/*
// Fetch deployables
$query = $db->prepare("SELECT
	id.id,
	id.worldspace,
	d.class_name otype,
	id.inventory,
	id.last_updated
FROM
	instance_deployable id
JOIN
	deployable d on	d.id = id.deployable_id
WHERE
	id.instance_id = ?");

$query->execute(array($config['instance']));
$rows = $query->fetchAll(PDO::FETCH_ASSOC);

foreach($rows as $row)
{
	$posArray = json_decode($row['worldspace']);
	
	$row['x'] = $posArray[1][0];
	$row['y'] = -($posArray[1][1]-15365);
	
	echo "\t" . '<deployable>' . "\n";
	foreach($row as $k => $v)
	{
		echo "\t\t" . '<' . $k . '><![CDATA[' . $v . ']]></' . $k . '>' . "\n";
	}
	echo "\t" . '</deployable>' . "\n";
}
*/
echo '</stuff>' . "\n";

?>