<?php

namespace Ema\RgementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TabletteController extends Controller
{

	/*

$connection = false;
$dbDriver = 'mysql';
$dbHost = 'localhost';
$dbName = 'emargement';
$dbUser = 'root';
$dbPwd = '';

 try {
           $connection = new PDO($dbDriver.':host='.$dbHost.';dbname='.$dbName, $dbUser, $dbPwd);
        } catch(Exception $e) {
            var_dump($e);
        }



$csv = file_get_contents("http://cybema.ema.fr/cybema/cgi-bin/cgiempt.exe?TYPE=promos_txt");
$array = array_map("str_getcsv", explode("\n", $csv));
$json = array();

foreach ($array as $line) {
	if($line[0] != "EOT")
		array_push($json, explode(";", $line[0]));
}


foreach ($json as $val) {



	if(isset($val[3]) && !empty($val[3]) && isset($val[1]) && !empty($val[1])){

	 $ifexist = "SELECT * FROM promotion WHERE `libelle` = '".$val[3]."'";
	 
	 if($connection->query($ifexist)->rowCount() > 0 ){

	 	 $requete = "UPDATE promotion SET `id_cybema` = '".$val[1]."' WHERE `libelle` =". $val[3];
	 	 print_r($requete);

	 	 $connection->query($requete);

	 }else 
	 {

	 	 $requete = "INSERT INTO promotion (`libelle`, `id_cybema`) VALUES ('".$val[3]."', '".$val[1]."') ";
	 	 $connection->query($requete);
	 }

	

	}
}




print_r($json);



	*/
	
	
	
	
}
