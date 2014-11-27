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
    * URL: http://loris-jacquy.ovh/tablette/first
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
    * URL: http://loris-jacquy.ovh/tablette/first/force
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
    * URL: http://loris-jacquy.ovh/tablette/eleves
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
        $csvUtf8 = mb_convert_encoding($csv, 'UTF-8');
        $elevesArray = explode("\n", $csvUtf8);

        $eleves = array();

        for($i=2; $i<sizeof($elevesArray)-1; $i++)
        {
            if(isset($e))
                unset($e);

            $eleArray = explode("\t", $elevesArray[$i]);
            $e['id'] = $eleArray[0];
            $e['lastname'] = $eleArray[1];
            $e['firstname'] = rtrim($eleArray[2]);

            if(isset($e))
                array_push($eleves, $e);
        }
        
        return json_encode($eleves);
    }
    
    /**
    * Web Service Action
    * Get hash
    * Return hash
    * URL: http://localhost/Emargement-Web/web/app_dev.php/tablette/login
    * URL: http://loris-jacquy.ovh/tablette/login
    */
    public function loginAction()
    {     
        $arr['hash'] = $this->getPwd();
        
        return new Response(json_encode($arr));
    }
    
    /**
    * Get hash of pwd
    */
    public function getPwd()
    {       
        $em = $this->getDoctrine()->getManager();
        $repoParam = $em->getRepository('EmaRgementBundle:Param');
        $entry = $repoParam->findOneById(1);
        return $entry->getValue();
    }
    
    /**
    * Set new pwd
    */
    public function setPwd($old, $new)
    {   
        $oldSalt = $this->hashPwd($old);
        
        if($oldSalt == $this->getPwd())
        {
            $newSalt = $this->hashPwd($new);
        
            $em = $this->getDoctrine()->getManager();
            $repoParam = $em->getRepository('EmaRgementBundle:Param');
            
            $entry = $repoParam->findOneById(1);

            if (!$entry) {
                return false;
            }
            else
            {
                $entry->setValue($newSalt);
                $em->flush();
            }

            return true;
        }
        
        return false;
    }
    
    /**
    * Hash a pwd, salt
    */ 
    private function hashPwd($pwd)
    {       
        $prefix = 'jkhg4579843kipzvjty';
        $sufix = 'v57k89ui4b65hg4ijuy';
        $pwdSalt = $prefix.$pwd.$sufix;
        
        return hash('sha256', $pwdSalt);
    }
    
}
