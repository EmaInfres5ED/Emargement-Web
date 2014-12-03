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

    public function findAllForAStudent($studentId)
    {
        $query = $this->createQueryBuilder('a')
            ->where('a.eleve = :studentId and a.motif is NULL')
            ->setParameter('studentId', $studentId)
            ->getQuery();

        return $query->getResult();
    }

    public function findAllBetweenDatesForStudents($studentsId, $fromDate, $toDate)
    {
        $result = array();
        $query = $this->createQueryBuilder('a')
            ->select('IDENTITY(a.eleve) as studentId, count(a.id) as absenceCount')
            ->where('a.dateDebut >= :fromDate and a.dateFin <= :toDate and a.eleve in (:studentsId)')
            ->setParameter('studentsId', $studentsId)
            ->setParameter('fromDate', $fromDate)
            ->setParameter('toDate', $toDate)
            ->groupBy('a.eleve')
            ->orderBy('a.eleve')
            ->getQuery();

        foreach ($query->getScalarResult() as $query)
        {
            $result[$query['studentId']] = $query['absenceCount'];
        }

        return $result;
    }
}
