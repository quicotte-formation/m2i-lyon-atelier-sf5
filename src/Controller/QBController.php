<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class QBController extends AbstractController
{
    /**
     * 1. lister tous les genres
     * 2. lister les films Policiers
     * 3. lister les films Policiers français
     * 4. lister les réalisateurs des films américains
     */

    /**
     * @Route("/qb4")
     * lister les réalisateurs des films américains
     */
    public function qb4(EntityManagerInterface $em)
    {
        $qb = $em->createQueryBuilder();

        $qb->select("p")
            ->from("App:Personne", "p")
            ->join("p.filmsRealises", "f")
            ->join("f.pays", "p2")
            ->andWhere("p2.nom=:NOM_PAYS")
            ->setParameter("NOM_PAYS", "USA");

        $query = $qb->getQuery();

        dump($query->getResult());
    }

    /**
     * @Route("/qb3")
     * lister les films Policiers français
     */
    public function qb3(EntityManagerInterface $em)
    {
        $qb = $em->createQueryBuilder();

        $qb->select("f")
            ->from("App:Film", "f")
            ->join("f.genre", "g")
            ->join("f.pays", "p")
            ->andWhere("g.nom=:NOM_GENRE")
            ->setParameter("NOM_GENRE", "Policier")
            ->andWhere("p.nom=:NOM_PAYS")
            ->setParameter("NOM_PAYS", "France");

        $query = $qb->getQuery();

        dump($query->getResult());
    }

    /**
     * @Route("/qb2")
     * lister les films Policiers
     */
    public function qb2(EntityManagerInterface $em)
    {
        $qb = $em->createQueryBuilder();

        $qb->select("f")
            ->from("App:Film", "f")
            ->join("f.genre", "g")
            ->andWhere("g.nom=:NOM_GENRE")
            ->setParameter("NOM_GENRE", "Policier");


        $query = $qb->getQuery();

        dump($query->getResult());
    }

    /**
     * @Route("/qb_ex", name="q_b")
     */
    public function index(EntityManagerInterface $em)
    {
        $qb = $em->createQueryBuilder();

        $qb->select("f");
        $qb->from("App:Film", "f");
        $qb->andWhere("f.titre='Blabla'");


        $query = $qb->getQuery();

        dump($query->getResult());
    }
}
