<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DQLController extends AbstractController
{
    /**
     * @Route("/req0")
     */
    public function req0(EntityManagerInterface $em){

        $dql = "SELECT  g.nom, COUNT(f)
                FROM    App:Genre g 
                        JOIN g.films f 
                GROUP BY g";
        dump( $em->createQuery($dql)->getResult() );
    }

    /**
     *
     * 13. lister tous les films interpretes par jet li qui ne sont pas realises par luc besson ( sous-requetes )
     * 14. lister tous les films policiers qui ne sont pas américains
     * 15. lister tous les genres associés à des films américains, sauf les genres associés à des films réalisés par luc besson

     * 16. lister le nom de chaque pays et le nombre de films associés
     * 17. lister le nom et prenom de chaque personne et le nombre de films réalisés par chacune
     * 18. lister le nom de chaque pays et le nombre de films associés mais uniquement si il y en a au moins 2
     */

    /**
     * lister le nom et prenom de chaque personne et le nombre de films réalisés par chacune
     * @Route("/req17")
     */
    public function req17(EntityManagerInterface $em){
        $dql = "SELECT  p.nom, p.prenom, COUNT(f) nb_real
                FROM    App:Personne p 
                        LEFT JOIN p.filmsRealises f
                GROUP BY p
                HAVING nb_real>1";
        dump( $em->createQuery($dql)->getResult() );
    }

    /**
     * lister le nom de chaque pays et le nombre de films associés
     * @Route("/req16")
     */
    public function req16(EntityManagerInterface $em){
        $dql = "SELECT  p.nom, COUNT(f) nb_films
                FROM    App:Pays p 
                        JOIN p.films f
                GROUP BY p";
        dump( $em->createQuery($dql)->getResult() );
    }

    /**
     * @Route("/req15")
     */
    public function req15(EntityManagerInterface $em){
        $dql = "SELECT  g 
                FROM    App:Genre g 
                        JOIN g.films f
                        JOIN f.pays p 
                WHERE   p.nom='USA' 
                        AND g NOT IN(
                        SELECT  g2
                        FROM    App:Genre g2
                                JOIN g2.films f2
                                JOIN f2.realisateurs r
                        WHERE   r.nom='Besson'        
                        )";
        dump( $em->createQuery($dql)->getResult() );
    }

    /**
     * @Route("/req14")
     */
    public function req14(EntityManagerInterface $em){
        $dql = "SELECT  f 
                FROM    App:Film f 
                        JOIN f.genre g 
                WHERE   g.nom='Policier' 
                        AND f NOT IN(
                        SELECT  f2 
                        FROM    App:Film f2 
                                JOIN f2.pays p 
                        WHERE   p.nom='USA' 
                        )";
        dump( $em->createQuery($dql)->getResult() );
    }

    /**
     * @Route("/req13")
     */
    public function req13(EntityManagerInterface $em){
        $dql = "SELECT  f 
                FROM    App:Film f 
                        JOIN f.acteurs a 
                WHERE   a.nom='Li'
                        AND f NOT IN (
                        SELECT  f2 
                        FROM    App:Film f2
                                JOIN f2.realisateurs r
                        WHERE   r.nom='Besson'    
                        )";
        dump( $em->createQuery($dql)->getResult() );
    }

    /**
     * 12. lister tous les films sauf les films français (utiliser sous-requêtes)
     * @Route("/req12")
     */
    public function req12(EntityManagerInterface $em){
        $dql = "SELECT  f 
                FROM    App:Film f 
                WHERE   f NOT IN(
                    SELECT  f2
                    FROM    App:Film f2
                            JOIN f2.pays p
                    WHERE   p.nom='France')";
        dump( $em->createQuery($dql)->getResult() );

    }

    /**
     * @Route("/req1")
     */
    public function req1(EntityManagerInterface $em)
    {
        $query = $em->createQuery("SELECT f FROM App:Film f JOIN f.genre g JOIN f.pays p WHERE g.nom='Horreur' AND p.nom='USA'");
        $films = $query->getResult();

        dump($films);
    }

    // req2: creer une nouvelle fonction avec route /req2: sélectionner tous les films dont l'année de sortie est égale à 2000 OU durée > 100

    // req4: sélectionner les films français

    // req 5: Les pays dans-lesquels il existe des films Policiers

    // req 6 : Les films réalisés par Tarantino
    /**
     * @Route("/req6")
     */
    public function req6(EntityManagerInterface $em){

        $query = $em->createQuery("SELECT f FROM App:Film f JOIN f.realisateurs r WHERE r.nom='Tarantino'");
        $films = $query->getResult();
        dump($films);
    }

    // 7 : les films américains intéreprétés par Jet Li*

    /**
     * @Route("/req7")
     */
    public function req7(EntityManagerInterface $em){
        $dql = "SELECT  f  
                FROM    App:Film f 
                        JOIN f.pays p 
                        JOIN f.acteurs a 
                WHERE   p.nom='France' 
                        AND a.nom='Li' 
                        AND a.prenom='Jet'";
        $query = $em->createQuery( $dql );
        $films = $query->getResult();

        dump($films);
    }

    // 8 : les pays des films américains réalisés par Jet Li

    /**
     * @Route("/req8")
     */
    public function req8(EntityManagerInterface $em){
        $dql = "SELECT  p 
                FROM    App:Pays p 
                        JOIN p.films f 
                        JOIN f.realisateurs r 
                WHERE   p.nom='USA' 
                        AND r.nom='Li' 
                        AND r.prenom='Jet'";
        $films = $em->createQuery( $dql )->getResult();

        dump( $films );
    }


    // 9 : les genres des films policiers français interprétés par Jet Li

    /**
     * @Route("/req9")
     */
    public function req9(EntityManagerInterface $em){
        $dql = "SELECT  g
                FROM    App:Genre g
                        JOIN g.films f 
                        JOIN f.pays p 
                        JOIN f.acteurs a 
                WHERE   g.nom='Policier' 
                        AND p.nom='France' 
                        AND a.nom='Li' 
                        AND a.prenom='Jet'";
        dump( $em->createQuery( $dql )->getResult() );
    }

    // 10 : les films policiers français réalisés par Luc Besson et interprétés par Jet Li

    /**
     * @Route("req10")
     */
    public function req10(EntityManagerInterface $em){
        $dql = "SELECT  f
                FROM    App:Film f 
                        JOIN f.pays p 
                        JOIN f.genre g 
                        JOIN f.realisateurs r 
                        JOIN f.acteurs a 
                WHERE   p.nom='France' 
                        AND g.nom='Policier' 
                        AND r.nom='Besson' 
                        AND r.prenom='Luc' 
                        AND a.nom='Li'
                        AND a.prenom='Jet'";
        dump( $em->createQuery($dql)->getResult() );
    }
}
