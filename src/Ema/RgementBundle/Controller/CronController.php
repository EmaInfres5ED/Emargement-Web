<?php

namespace Ema\RgementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Ema\RgementBundle\Entity\Promotion;
use Ema\RgementBundle\Entity\Etudiant;

class CronController extends Controller
{
    /**
    * Web Service Action
    * Update promo and  etudiant in BDD
    * [LAUNCH] every week
    * URL: http://localhost/Emargement-Web/web/app_dev.php/cron/update/all
    */
    public function updateAllAction()
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
    * Update promo in BDD
    * URL: http://localhost/Emargement-Web/web/app_dev.php/cron/update/promotions
    */
    public function updatePromotionsAction()
    {
        try {
            $this->updatePromotions();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
    * Web Service Action
    * Update etudiant in BDD
    * URL: http://localhost/Emargement-Web/web/app_dev.php/cron/update/etudiants
    */
    public function updateEtudiantsAction()
    {
        try {
            $this->updateEtudiants();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    //URL: http://localhost/Emargement-Web/web/app_dev.php/cron/update/first

    /**
    * Web Service Action
    * Update first json file
    * [LAUNCH] every day
    * URL: http://localhost/Emargement-Web/web/app_dev.php/cron/update/first
    */
    public function updateFirstJsonAction()
    {
        try {
            $this->updateFirstJson();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
    * Update first json file
    */
    public function updateFirstJson()
    {
        $filename = "first.json";
        $file = fopen($filename, 'w+');
        fputs($file, $this->getJsonCoursAndPromos());
        fclose($file);
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
        return $this->csvToJson($csv);
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

    /**
    * Get etudiants in Cybema
    * Update (idPromo only) or create etudiant in BDD
    */
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

    /**
    * Convert CSV string in JSON array
    */
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
