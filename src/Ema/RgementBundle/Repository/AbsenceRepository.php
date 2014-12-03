<?php
// src/Ema/RgementBundle/Repository/AbsenceRepository.php
namespace Ema\RgementBundle\Repository;

use Doctrine\ORM\EntityRepository;

class AbsenceRepository extends EntityRepository
{
    public function findAllBetweenDatesForAStudent($studentId, $fromDate, $toDate)
    {
        $query = $this->createQueryBuilder('a')
            ->where('a.dateDebut >= :fromDate and a.dateFin <= :toDate and a.eleve = :studentId')
            ->setParameter('studentId', $studentId)
            ->setParameter('fromDate', $fromDate)
            ->setParameter('toDate', $toDate)
            ->getQuery();

        return $query->getResult();
    }
}
