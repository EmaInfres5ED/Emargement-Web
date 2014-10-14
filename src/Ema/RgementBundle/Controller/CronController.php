<?php

namespace Ema\RgementBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Ema\RgementBundle\Entity\Promotion;
use Ema\RgementBundle\Entity\Etudiant;

class CronController extends Controller
{

	//URL: http://localhost/Emargement-Web/web/app_dev.php/cron/update/all
	public function updateAllAction()
	{
		$this->updatePromotions();
		$this->updateEtudiants();
		
		return new Response('Update OK');
	
	}

	//URL: http://localhost/Emargement-Web/web/app_dev.php/cron/update/promotions
	public function updatePromotionsAction()
	{
		$this->updatePromotions();
		return new Response('Update Promotions OK');
	
	}

	//URL: http://localhost/Emargement-Web/web/app_dev.php/cron/update/etudiants
	public function updateEtudiantsAction()
	{
		$this->updateEtudiants();
		return new Response('Update Etudiants OK');
	}
	
	

	private function updatePromotions()
	{
		//Promotion Repository
		$em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('EmaRgementBundle:Promotion');
	
		//Promotions Cybema
		$csv = file_get_contents("http://cybema.ema.fr/cybema/cgi-bin/cgiempt.exe?TYPE=promos_txt");
		$json = $this->csvToJson($csv);

		foreach ($json as $val) {
			if(isset($val[3]) && !empty($val[3]) && isset($val[1]) && !empty($val[1])) {
				$promo = $repo->findOneByLibelle($val[3]);
			 
				if($promo != null){
					//Update
					$promo->setIdCybema($val[1]);
					
				} else 
				{
					//Create
					$newPromo = new Promotion();
					$newPromo->setLibelle($val[3]);
					$newPromo->setIdCybema($val[1]);

					$em->persist($newPromo);
				}
			}
		}
		
		$em->flush();
	}

	private function updateEtudiants()
	{
		//Promotion Repository
		$em = $this->getDoctrine()->getManager();
        $repoEtudiant = $em->getRepository('EmaRgementBundle:Etudiant');
        $repoPromo = $em->getRepository('EmaRgementBundle:Promotion');
	
		//Promotions Cybema
		$csv = file_get_contents("http://cybema.ema.fr/cybema/cgi-bin/cgiempt.exe?TYPE=eleves_txt");
		$json = $this->csvToJson($csv);

		foreach ($json as $val) {
			if(isset($val[9]) && !empty($val[9])) {
				$etu = $repoEtudiant->findOneByEmail($val[9]);
			 
				//Get local id promo
				$promo = null;
				if(isset($val[11]) && !empty($val[11]))
					$promo = $repoPromo->findOneByIdCybema($val[11]);
			 
				if($etu != null){
					if($promo) {
						$etu->setIdPromo($promo);
					}
					
				} else 
				{
					$newEtu = new Etudiant();
					$newEtu->setNom($val[5]);
					$newEtu->setPrenom($val[7]);
					$newEtu->setEmail($val[9]);
					if($promo)
						$newEtu->setIdPromo($promo);

					$em->persist($newEtu);
				}
			}
		}
		
		$em->flush();
	}

	private function csvToJson($csv)
	{
		$array = array_map("str_getcsv", explode("\n", $csv));
		$json = array();

		foreach ($array as $line) {
			if($line[0] != "EOT")
				array_push($json, explode(";", $line[0]));
		}
		
		return $json;
	}
}
