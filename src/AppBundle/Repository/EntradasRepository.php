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
    public function paginate($dql,$page=1,$limit=10)
    {
        $paginator = new Paginator($dql);
        $paginator->setUseOutputWalkers(false);

        $paginator->getQuery()
            ->setFirstResult($limit * ($page - 1)) // Offset
            ->setMaxResults($limit); // Limit

        return $paginator;
    }

    public function slugify($str, $char )
    {
        // Lower case the string and remove whitespace from the beginning or end
        $str = trim(strtolower($str));

        // Remove single quotes from the string
        $str = str_replace("''", "", $str);

       // Every character other than a-z, 0-9 will be replaced with a single dash (-)
       $str = preg_replace("/[^a-z0-9]+/", $char, $str);

       // Remove any beginning or trailing dashes
       $str = trim($str, $char);

        return $str;
     }

}