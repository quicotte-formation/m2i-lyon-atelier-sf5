<?php

namespace App\Repository;

use App\Entity\Film;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Film|null find($id, $lockMode = null, $lockVersion = null)
 * @method Film|null findOneBy(array $criteria, array $orderBy = null)
 * @method Film[]    findAll()
 * @method Film[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilmRepository extends ServiceEntityRepository
{
    public function rechercherParActeur($prenom, $nom){

        $dql = "SELECT  f
                FROM    App:Film f 
                        JOIN f.acteurs a
                WHERE   a.prenom=:PRENOM
                        AND a.nom=:NOM";

        return $this->getEntityManager()->createQuery($dql)->getResult();

        /*return $this->createQueryBuilder("f")
            ->join("f.acteurs", "r")
            ->andWhere("r.prenom=:PRENOM")->setParameter("PRENOM", $prenom)
            ->andWhere("r.nom=:NOM")->setParameter("NOM", $nom)
            ->getQuery()->getResult();*/
    }

    public function rechercherFilmParTitreEtParGenre($titre, $nomGenre){
        return $this->createQueryBuilder("f")
            ->join("f.genre", "g")
            ->andWhere("f.titre=:TITRE")->setParameter("TITRE", $titre)
            ->andWhere("g.nom=:NOM_GENRE")->setParameter("NOM_GENRE", $nomGenre)
            ->getQuery()->getResult();
    }

    public function rechercherFilmsIdPlusGrandQue($id){
        return $this->createQueryBuilder("f")
            ->andWhere("f.id>:ID_FILM")->setParameter("ID_FILM", $id)->getQuery()->getResult();
    }

    public function rechercherParRealisateur($nomReal){
        return $this->createQueryBuilder("f")
            ->join("f.realisateurs r")
            ->andWhere("r.nom=:NOM_REAL")->setParameter("NOM_REAL", $nomReal)
            ->getQuery()->getResult();
    }

    public function rechercherParGenreEtPays($nomGenre, $nomPays){
        return $this->createQueryBuilder("f")
            ->join("f.genre", "g")
            ->join("f.pays", "p")
            ->andWhere("g.nom=:NOM_GENRE")
            ->andWhere("p.nom=:NOM_PAYS")
            ->setParameter("NOM_PAYS", $nomPays)
            ->setParameter("NOM_GENRE", $nomGenre)
            ->getQuery()->getResult();
    }

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Film::class);
    }

    // /**
    //  * @return Film[] Returns an array of Film objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Film
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
