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

    /**
     * @return Movimentacao[] Returns an array of Movimentacao objects
     */
    public function lastedEntries()
    {
        return $this->createQueryBuilder('mov')
            ->orderBy('mov.data', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }


    /**
     * @return Movimentacao Returns one Movimentacao entry
     */
    public function findEntryById($idValue): ?Movimentacao
    {
        return $this->createQueryBuilder('mov')
            ->andWhere('mov.id = :id_value')
            ->setParameter('id_value', $idValue)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

}
