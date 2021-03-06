<?php 
session_start();
include('config.php');
switch($config['map_name'])
{
/*
string should have the following fields

pathToMap \r\n
image width in pixels \r\n
image height in pixels \r\n
origo X offset in meters, origo means coordinates 0,0 \r\n
origo Y offset in meters \r\n
map X size in meters, these can be found in the dayz database \r\n
map Y size in meters \r\n

this could be done more elegantly, if you want it done better, feel free to code it.


*/


	case "chernarus":
	{
		$strMapFile = "maps/chernarus.jpg\r\n2047\r\n1982\r\n-700\r\n-370\r\n14300\r\n13850";
		break;
	}
	case "taviana":
	{
		$strMapFile = "maps/taviana.jpg\r\n1920\r\n1920\r\n0\r\n7600\r\n23000\r\n23000";
		break;
	}
	case "lingor":
	{
		$strMapFile = "maps/lingor.jpg\r\n2000\r\n2000\r\n0\r\n-5365\r\n10000\r\n10000";
		break;
	}
	case "namalsk":
	{
		$strMapFile = "maps/namalsk.png\r\n2560\r\n2560\r\n60\r\n-2500\r\n12900\r\n12900";
		break;
	}
	case "panthera":
	{
		$strMapFile = "maps/panthera.png\r\n1895\r\n1440\r\n-40\r\n-7500\r\n10250\r\n7780";
		break;
	}
	case "takistan":
	{
		$strMapFile = "maps/takistan.jpg\r\n2341\r\n2386\r\n165\r\n-2432\r\n13000\r\n13000";
		break;
	}
	case "napf":
	{
		$strMapFile = "maps/napf.jpg\r\n5121\r\n5121\r\n50\r\n5050\r\n20400\r\n20400";
		break;
	}
	default:
	{
		//default is chernarus
		$strMapFile = "maps/chernarus.jpg\r\n2047\r\n1982\r\n-700\r\n-370\r\n14300\r\n13850";
	}

}
header('Content-Type: text/plain');
header('Content-Disposition: attachment; filename=map.txt');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . strlen($strMapFile));

echo $strMapFile;


?>

