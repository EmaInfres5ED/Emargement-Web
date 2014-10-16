<?php

namespace Ema\RgementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Ema\RgementBundle\Entity\Promotion;
use Ema\RgementBundle\Controller\CronController;

class TabletteController extends Controller
{
	/**
	* Web Service Action
	* Return JSON file with cours by promo
	* URL: http://localhost/Emargement-Web/web/app_dev.php/tablette/first
	*/
	public function firstAction()
	{		
		//Read Json file
		$filename = "first.json";
		$file = fopen($filename, 'r');
		$json = fgets($file);
		fclose($file);
		
		return new Response($json);
	}

	/**
	* Web Service Action
	* Update JSON file
	* Return JSON file with cours by promo
	* URL: http://localhost/Emargement-Web/web/app_dev.php/tablette/first/force
	*/
	public function firstForceAction()
	{		
		//Update first JSON
		$cronController = $this->get('cron_controller_service');
		$cronController->updateFirstJson();
	
		//Read Json file
		$filename = "first.json";
		$file = fopen($filename, 'r');
		$json = fgets($file);
		fclose($file);
		
		return new Response($json);
	}
}
