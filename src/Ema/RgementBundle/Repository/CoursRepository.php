<?php
// src/Ema/RgementBundle/Repository/CoursRepository.php
namespace Ema\RgementBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CoursRepository extends EntityRepository
{
    public function findAllOrderByDate()
    {
        return $this->getEntityManager()->createQuery
        ('SELECT c FROM EmaRgementBundle:Cours c ORDER BY c.dateDebut ASC')
        ->getResult();
    }
}
