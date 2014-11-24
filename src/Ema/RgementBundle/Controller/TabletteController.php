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
    * URL: http://localhost/Emargement-Web/web/app_dev.php/tablette/eleves
    */
    public function getElevesAction()
    {       
        $idGroupe = "402"; //Provient de GET ou POST
        
        return new Response($this->getElevesByCours($idGroupe));
    }
        
    /**
    * Get eleves by cours in Cybema
    */
    private function getElevesByCours($idGroupe)
    {   
        $http = "http://cybema.ema.fr/cybema/cgi-bin/cgihtml.exe?TYPE=listegroupe_html&GRCLEUNIK=".$idGroupe."&MODE=10";
        $csv = file_get_contents($http);
        $elevesArray = explode("\n", $csv);
        
        $eleves = array();
        
        for($i=2; $i<sizeof($elevesArray)-1; $i++)
        {
            if(isset($e))
                unset($e);
                
            $eleArray = explode("\t", $elevesArray[$i]);
            
            $e['id'] = utf8_encode($eleArray[0]);
            $e['lastname'] = utf8_encode($eleArray[1]);
            $e['firstname'] = utf8_encode(rtrim($eleArray[2]));
             
            if(isset($e))
                array_push($eleves, $e);                
        }
        
        return json_encode($eleves);    
    }
}
