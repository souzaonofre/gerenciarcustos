<?php

namespace App\Repository;

use App\Entity\Movimentacao;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Movimentacao|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movimentacao|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movimentacao[]    findAll()
 * @method Movimentacao[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovimentacaoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Movimentacao::class);
    }

//    /**
//     * @return Movimentacao[] Returns an array of Movimentacao objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Movimentacao
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
