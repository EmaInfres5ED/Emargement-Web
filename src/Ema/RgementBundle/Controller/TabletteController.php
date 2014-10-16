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
    

    /**
    * Web Service Action
    * Get eleves by cour
    * Return JSON file with eleves by cour
    * URL: http://localhost/Emargement-Web/web/app_dev.php/tablette/eleves/
    */
    public function getElevesAction()
    {       
        $cours = ""; //Provient de GET ou POST
        
        return new Response($this->getElevesByCours($cours));
    }
        
    /**
    * Get eleves by cours in Cybema
    */
    private function getElevesByCours($cours)
    {   
        //Lien à utliser
        //cybema.ema.fr/cybema/cgi-bin/cgihtml.exe?TYPE=listegroupe_html&GRCLEUNIK=402&MODE=10
        
        
        //$today = $this->getToday();
        //$http = "http://webdfd.mines-ales.fr/cybema/cgi-bin/cgiempt.exe?TYPE=planning_txt&DATEDEBUT=".$today."&DATEFIN=".$today."&TYPECLE=p0cleunik&VALCLE=".$idPromoCybema;
       echo $http;
        $csv = file_get_contents($http);
        //return $this->csvToJson($csv);
        return $csv;
    }
}
