<?php
/**
 * Created by PhpStorm.
 * User: ekiscrim
 * Date: 10/04/17
 * Time: 12:52
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class EntradasRepository extends EntityRepository
{

    public function getEntradas($currentPage = 1, $limit)
    {

        $query = $this->createQueryBuilder('a')
            ->orderBy('a.fecha','DESC')
            ->getQuery();

        $paginator = $this->paginate($query, $currentPage, $limit);

        return $paginator;
    }
    public function paginate($dql,$page=1,$limit=3)
    {
        $paginator = new Paginator($dql);
        $paginator->setUseOutputWalkers(false);

        $paginator->getQuery()
            ->setFirstResult($limit * ($page - 1)) // Offset
            ->setMaxResults($limit); // Limit

        return $paginator;
    }

}