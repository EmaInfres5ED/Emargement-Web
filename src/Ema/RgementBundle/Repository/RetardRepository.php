<?php
// src/Ema/RgementBundle/Repository/RetardRepository.php
namespace Ema\RgementBundle\Repository;

use Doctrine\ORM\EntityRepository;

class RetardRepository extends EntityRepository
{

    public function findAllBetweenDatesForAStudent($studentId, $fromDate, $toDate)
    {
        $query = $this->createQueryBuilder('r')
            ->where('r.dateprevu >= :fromDate and r.dateprevu <= :toDate and r.etudiant = :studentId')
            ->setParameter('studentId', $studentId)
            ->setParameter('fromDate', $fromDate)
            ->setParameter('toDate', $toDate)
            ->getQuery();

        return $query->getResult();
    }

}
