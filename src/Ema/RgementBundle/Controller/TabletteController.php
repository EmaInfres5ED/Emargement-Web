<?php

namespace Ema\RgementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use Ema\RgementBundle\Entity\Etudiant;
use Ema\RgementBundle\Entity\Promotion;
use Ema\RgementBundle\Entity\Cours;
use Ema\RgementBundle\Entity\Presence;
use Ema\RgementBundle\Entity\Participation;
use Ema\RgementBundle\Entity\ParticipationAbsence;
use Ema\RgementBundle\Entity\Absence;
use Ema\RgementBundle\Entity\Retard;
use \DateTime;
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

        $response = new Response($json);
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
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

        $response = new Response($json);
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }

    /**
    * Web Service Action
    * Get eleves by cour
    * Return JSON file with eleves by cour
    * URL: http://localhost/Emargement-Web/web/app_dev.php/tablette/eleves
    * URL: http://loris-jacquy.ovh/tablette/eleves
    */
    public function getElevesAction(Request $request)
    {
        if ($request->getMethod() == 'POST') 
        {
            $idGroupe = $request->request->get('idGroupe');
            
            if(isset($idGroupe) && !empty($idGroupe))
                return new JsonResponse($this->getElevesByCours($idGroupe));  
        }

         return new JsonResponse(array());     
    }

    public function setDataCoursAction(Request $request)
    {
    
    if ($request->getMethod() == 'POST') 
        {
          $json = $request->request->get('json');
          if(isset($json) && !empty($json)){
          try{
              $this->setDataCours($json);
              return true;
          } catch (Exception $e) {
              return false;
          }
        
          }else{
             return false;
          }
       }else{
             return false;
       }
    }
        
        
    public function setDataCours($data)
    {
                    
          $em = $this->getDoctrine()->getManager();
          $repoEtudiant = $em->getRepository('EmaRgementBundle:Etudiant');
          $repoCours = $em->getRepository('EmaRgementBundle:Cours');
         
          $json = json_decode($data,true);
          
          $professeur = $json["profcours"];
          $salle = $json["sallecours"];
          $libelle = $json["libellecours"];
          $dateDebut = new DateTime($json["datedebutcours"]);
          $dateFin = new DateTime($json["datefincours"]);
          $idCybema = $json["idcybemacours"];;
          $eleves = $json['eleves'];
          
          $cours = new Cours();
          $cours->setProfesseur($professeur);
          $cours->setLibelle($libelle);
          $cours->setDateDebut($dateDebut);
          $cours->setDateFin($dateFin);
          $cours->setIdCybema($idCybema);
          $cours->setSalle($salle);
          
          $em->persist($cours);
          
          foreach($eleves as $eleve){
         
              $etudiant = $repoEtudiant->findOneById($eleve['ideleve']);
              $participation = new participation();
              $participation->setEtudiant($etudiant);
              $participation->setCours($cours);
              $em = $this->getDoctrine()->getManager();
              $em->persist($participation);
              
              if($eleve['horodatage'] != "false"){
                  $dateHorodatage = new DateTime($eleve['horodatage']);
                  $presence = new presence();
                  $presence->setHorodatage(new DateTime($eleve['horodatage']));
                  $presence->setSignature($eleve['signature']);
                  $presence->setParticipation($participation);
                  $em = $this->getDoctrine()->getManager();
                  $em->persist($presence);
                  echo $dateHorodatage->getTimestamp() - $dateDebut->getTimestamp();
                  if(($dateHorodatage->getTimestamp() - $dateDebut->getTimestamp()) > (15*60)){
                    $retard = new retard();
                    $retard->setParticipation($participation);
                    $retard->setDureeRetard(($dateHorodatage->getTimestamp() - $dateDebut->getTimestamp())/60);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($retard);
                  }
              }else{
        
              
                  $query = $em->createQuery(
                                            'SELECT a FROM EmaRgementBundle:Absence a
                                            WHERE ((SELECT MAX(c.dateFin) FROM EmaRgementBundle:Cours c) = a.dateFin) AND (a.eleve = :etudiant)'
                                           )->setParameter('etudiant',$etudiant);
                 try {
                   $abscenceEtudiant = $query->getSingleResult();
                   $abscenceEtudiant->setDateFin($dateFin);
                   $participationAbsence = new ParticipationAbsence();
                   $participationAbsence->setAbsence($abscenceEtudiant);
                   $participationAbsence->setParticipation($participation);
                   $em = $this->getDoctrine()->getManager();
                   $em->persist($participationAbsence);
                 }catch (\Doctrine\Orm\NoResultException $e) {
                     $absence = new absence();
                     $absence->setDateDebut(	$dateDebut);
                     $absence->setDateFin($dateFin);
                     $absence->setEleve($etudiant);
                     $em = $this->getDoctrine()->getManager();
                     $em->persist($absence);
                     
                     $participationAbsence = new ParticipationAbsence();
                     $participationAbsence->setAbsence($absence);
                     $participationAbsence->setParticipation($participation);
                     $em = $this->getDoctrine()->getManager();
                     $em->persist($participationAbsence);
                 }
              }
          }
                    
          $em->flush();
    }

    /**
    * Get eleves by cours in Cybema
    */
    private function getElevesByCours($idGroupe)
    {
        //Promotion Repository
        $em = $this->getDoctrine()->getManager();
        $repoEtudiant = $em->getRepository('EmaRgementBundle:Etudiant');
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
            $etudiant = $repoEtudiant->findOneByIdCybema($eleArray[0]);   
           
            $e['id'] = $etudiant->getId();
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
        
        return new JsonResponse($arr);
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
?>
