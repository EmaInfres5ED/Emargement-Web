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

    public function findAllBetweenDatesForStudents($studentsId, $fromDate, $toDate)
    {
        $result = array();
        $query = $this->createQueryBuilder('r')
            ->select('IDENTITY(r.etudiant) as studentId, count(r.id) as retardCount')
            ->where('r.dateprevu >= :fromDate and r.dateprevu <= :toDate and r.etudiant in (:studentsId)')
            ->setParameter('studentsId', $studentsId)
            ->setParameter('fromDate', $fromDate)
            ->setParameter('toDate', $toDate)
            ->groupBy('r.etudiant')
            ->orderBy('r.etudiant')
            ->getQuery();

        foreach ($query->getScalarResult() as $query)
        {
            $result[$query['studentId']] = $query['retardCount'];
        }

        return $result;
    }

}
