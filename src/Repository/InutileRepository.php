<?php

namespace App\Repository;

use App\Entity\Inutile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Inutile|null find($id, $lockMode = null, $lockVersion = null)
 * @method Inutile|null findOneBy(array $criteria, array $orderBy = null)
 * @method Inutile[]    findAll()
 * @method Inutile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InutileRepository extends ServiceEntityRepository
{
    public function rechercherParTitre($title){
        return $this->createQueryBuilder("i")->andWhere("i.titre=:TITRE")->setParameters($title);
    }

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Inutile::class);
    }
}
