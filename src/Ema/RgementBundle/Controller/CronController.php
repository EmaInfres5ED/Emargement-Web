<?php

namespace Ema\RgementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Ema\RgementBundle\Entity\Promotion;
use Ema\RgementBundle\Entity\Etudiant;
use Ema\RgementBundle\Entity\EtudiantPromotion;

class CronController extends Controller
{
    /**
    * Web Service Action
    * Update promo and  etudiant in BDD
    * [LAUNCH] every week
    * URL: http://localhost/Emargement-Web/web/app_dev.php/cron/update/all
    * URL: http://loris-jacquy.ovh/cron/update/all
    */
    public function updateAllAction()
    {
        if($this->updateAll())
            return new Response("true");

        return new Response("false");
    }
    /**
    * Update promo and  etudiant in BDD
    */
    public function updateAll()
    {
        try {
            $this->updatePromotions();
            $this->updateEtudiants();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    
    /**
    * Web Service Action
    * Update first json file
    * [LAUNCH] every day
    * URL: http://localhost/Emargement-Web/web/app_dev.php/cron/update/first
    * URL: http://loris-jacquy.ovh/cron/update/first
    */
    public function updateFirstJsonAction()
    {
        if($this->updateFirstJson())
            return new Response("true");

        return new Response("false");
    }

    /**
    * Update first json file
    */
    public function updateFirstJson()
    {

        try {
            $filename = "first.json";
            $file = fopen($filename, 'w+');
            fputs($file, $this->getJsonCoursAndPromos());
            fclose($file);
            return true;
        } catch (Exception $e) {
            return false;
        }
        
    }

    /**
    * Get cours in Cybema
    * Return new JSON cours by promos
    */
    private function getJsonCoursAndPromos()
    {
        $response = array();
        $promotions = $this->getPromotions();

        foreach ($promotions as $promo) {
            $one = array();
            $one["name"] = $promo->getLibelle();
            $one["id"] = $promo->getId();

            $listCours = array();

            $cours = $this->getCoursByPromo($promo->getIdCybema());
            foreach ($cours as $cour) {

                if(isset($c))
                    unset($c);

                if(isset($cour[7]) && !empty($cour[7]))
                    $c['id_cours'] = $cour[7];
                if(isset($cour[9]) && !empty($cour[9]))
                    $c['id_groupe'] = $cour[9];
                if(isset($cour[13]) && !empty($cour[13]))
                    $c['date'] = $cour[13];
                if(isset($cour[17]) && !empty($cour[17]))
                    $c['hd'] = $cour[17];
                if(isset($cour[19]) && !empty($cour[19]))
                    $c['hf'] = $cour[19];
                if(isset($cour[27]) && !empty($cour[27]))
                    $c['name'] = $cour[27];
                if(isset($cour[29]) && !empty($cour[29]))
                    $c['salle'] = $cour[29];
                if(isset($cour[33]) && !empty($cour[33]))
                    $c['prof'] = $cour[33];
                if(isset($cour[35]) && !empty($cour[35]))
                    $c['groupe'] = $cour[35];

                if(isset($c))
                    array_push($listCours, $c);
            }

            $one["cours"] = $listCours;

            array_push($response, $one);
        }

        return json_encode($response);
    }

    /**
    * Get promos in BDD
    */
    private function getPromotions()
    {
        $em = $this->getDoctrine()->getManager();
        $repoPromo = $em->getRepository('EmaRgementBundle:Promotion');
        return $repoPromo->findAll();
    }

    /**
    * Get cours by promo in Cybema
    */
    private function getCoursByPromo($idPromoCybema)
    {
        $today = $this->getToday();
        $http = "http://cybema.ema.fr/cybema/cgi-bin/cgiempt.exe?TYPE=planning_txt&DATEDEBUT=".$today."&DATEFIN=".$today."&TYPECLE=p0cleunik&VALCLE=".$idPromoCybema;
        $csv = file_get_contents($http);
        return $this->csvToArray($csv);
    }

    /**
    * Get today date with format YYYYMMDD
    */
    public function getToday()
    {
        $date = getdate();

        $year = $date['year'];
        $month = $date['mon'];
        $day = $date['mday'];

        if($month >= 1 && $month <= 9)
            $month = "0".$month;

        if($day >= 1 && $day <= 9)
            $day = "0".$day;

        return $year . $month . $day;
    }

    /**
    * Get promos in Cybema
    * Update (idCybema only) or create promo in BDD
    */
    private function updatePromotions()
    {
        //Promotion Repository
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('EmaRgementBundle:Promotion');

        //Promotions Cybema
        $csv = file_get_contents("http://cybema.ema.fr/cybema/cgi-bin/cgiempt.exe?TYPE=promos_txt");
        $json = $this->csvToArray($csv);

        foreach ($json as $val) {
        
            if(isset($val[3]) && !empty($val[3]) && isset($val[1]) && !empty($val[1])) {
                $promo = $repo->findOneByLibelle(trim($val[3]));

                if($promo != null){
                    //Update
                    $promo->setIdCybema(trim($val[1]));

                } else
                {
                    //Create
                    $newPromo = new Promotion();
                    $newPromo->setLibelle(trim($val[3]));
                    $newPromo->setIdCybema(trim($val[1]));
                    $em->persist($newPromo);
                }
            }
        }

        $em->flush();
    }

    /**
    * Get etudiants in Cybema
    * Update (idPromo only) or create etudiant in BDD
    */
    private function updateEtudiants()
    {
        //Promotion Repository
        $em = $this->getDoctrine()->getManager();
        $repoEtudiant = $em->getRepository('EmaRgementBundle:Etudiant');
        $repoPromotion = $em->getRepository('EmaRgementBundle:Promotion');
        $repoEtudiantPromotion = $em->getRepository('EmaRgementBundle:EtudiantPromotion');

        //Promotions Cybema
        $csv = file_get_contents("http://cybema.ema.fr/cybema/cgi-bin/cgiempt.exe?TYPE=eleves_txt");
        $json = $this->csvToArray($csv);

        foreach ($json as $val) {
            if(isset($val[9]) && !empty($val[9])) {
                $etudiant = $repoEtudiant->findOneByEmail(trim($val[9]));

                //Get local id promo
                $promotion = null;
                if(isset($val[11]) && !empty($val[11]))
                    $promotion = $repoPromotion->findOneByIdCybema(trim($val[11]));
                    
                if($etudiant != null){
                
                    $etudiant->setNom(trim($val[5]));
                    $etudiant->setPrenom(trim($val[7]));
                    $etudiant->setEmail(trim($val[9]));
                    $etudiant->setIdCybema(trim($val[1]));
                    $em->persist($etudiant);
                
                    if($promotion) {
                        $etudiantPromotion = null;
                        $etudiantPromotion = $repoEtudiantPromotion->findOneBy(
                            array(
                                "etudiant" => $etudiant,
                                "promotion" => $promotion)
                        );
                        
                        if(!$etudiantPromotion)
                        {
                            $newEtudiantPromotion = new EtudiantPromotion();
                            $newEtudiantPromotion->setPromotion($promotion);
                            $newEtudiantPromotion->setEtudiant($etudiant);
                            $em->persist($newEtudiantPromotion);
                        }
                    }

                } else {
                    $newEtu = new Etudiant();
                    $newEtu->setNom(trim($val[5]));
                    $newEtu->setPrenom(trim($val[7]));
                    $newEtu->setEmail(trim($val[9]));
                    $newEtu->setIdCybema(trim($val[1]));
                    $em->persist($newEtu);
                    
                    if($promotion) {
                        $etudiantPromotion = new EtudiantPromotion();
                        $etudiantPromotion->setPromotion($promotion);
                        $etudiantPromotion->setEtudiant($newEtu);
                        $em->persist($etudiantPromotion);
                    }
                }
            }
            
            $em->flush();
        }
    }

    /**
    * Get cours by date in Cybema
    * params :
    * $dateBegin = date de début-> timestamp unix
    * $dateEnd = date de fin-> timestamp unix
    */
    private function getCoursByDate($dateBegin, $dateEnd)
    {
        $dateEnd = $this->formatDate($dateEnd);
        $dateBegin = $this->formatDate($dateBegin);
        $http = "http://cybema.ema.fr/cybema/cgi-bin/cgiempt.exe?TYPE=planning_txt&DATEDEBUT=".$dateBegin."&DATEFIN=".$dateEnd."&TYPECLE=p0cleunik";
        $csv = file_get_contents($http);
        return $this->csvToArray($csv);
    }

    /**
    * Get cours by date in Cybema
    * params :
    * $dateBegin = date de début-> timestamp unix
    * $dateEnd = date de fin-> timestamp unix
    * $idPromoC
    */
    private function getCoursByDateAndPromo($dateBegin, $dateEnd, $idPromoCybema)
    {
        $dateEnd = $this->formatDate($dateEnd);
        $dateBegin = $this->formatDate($dateBegin);
        $http = "http://cybema.ema.fr/cybema/cgi-bin/cgiempt.exe?TYPE=planning_txt&DATEDEBUT=".$dateBegin."&DATEFIN=".$dateEnd."&TYPECLE=p0cleunik&VALCLE=".$idPromoCybema;
        $csv = file_get_contents($http);
        return $this->csvToArray($csv);
    }

    /**
    * Get eleves
    */
    private function getEtudiants()
    {
        //Promotion Repository
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('EmaRgementBundle:Etudiant');
        
        return $repo->findAll();
    }
    
    /**
    * Convert CSV string in Array
    */
    private function csvToArray($csv)
    {
        $csvUtf8 = mb_convert_encoding($csv, 'UTF-8');
        $array = array_map("str_getcsv", explode("\n", $csvUtf8));
        $json = array();

        foreach ($array as $line) {
            if($line[0] != "EOT")
                array_push($json, explode(";", $line[0]));
        }

        return $json;
    }
}
