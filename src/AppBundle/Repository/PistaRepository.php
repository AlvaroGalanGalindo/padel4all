<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * PistaRepository
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PistaRepository extends EntityRepository
{
    public function findAllOrderedByFechaDesc() {
        return $this->createQueryBuilder('p')
            ->addOrderBy('p.fecha', 'DESC')
            ->getQuery()
            ->getResult();
    }
}