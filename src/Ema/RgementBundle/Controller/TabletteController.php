<?php

namespace Ema\RgementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Ema\RgementBundle\Entity\Promotion;

class TabletteController extends Controller
{

	//URL: http://localhost/Emargement-Web/web/app_dev.php/tablette/first
	public function firstAction()
	{		
		$filename = "first.json";
		$file = fopen($filename, 'r');
		$json = fgets($file);
		fclose($file);
		
		return new Response($json);
	}

	//URL: http://localhost/Emargement-Web/web/app_dev.php/tablette/first/force
	public function firstForceAction()
	{		
	
	
	
		//Réaliser l'update de CronController:updateFirstJson()
	
	
	
	
	
		$filename = "first.json";
		$file = fopen($filename, 'r');
		$json = fgets($file);
		fclose($file);
		
		return new Response($json);
	}
}
