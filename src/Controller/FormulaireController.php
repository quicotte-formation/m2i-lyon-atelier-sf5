<?php

namespace App\Controller;

use App\DTO\AjoutSerieDTO;
use App\DTO\FilmEtLiensDTO;
use App\DTO\RechercheSerieDto;
use App\Entity\Episode;
use App\Entity\Film;
use App\Entity\Lien;
use App\Entity\Saison;
use App\Entity\Serie;
use App\Form\AjoutSerieType;
use App\Form\FilmEtLiensType;
use App\Form\RechercheSerieType;
use App\Form\SerieCompleteType;
use App\Form\TestType;
use App\Repository\FilmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FormulaireController extends AbstractController
{
    /**
     * @Route("/recherche-series")
     */
    public function rechercheSeries(Request $request, EntityManagerInterface $em){
        $dto = new RechercheSerieDto();
        $form=$this->createForm(RechercheSerieType::class , $dto);

        $form->handleRequest($request);
        if ($form->isSubmitted()){

            // Avec querybuilder, rechercher les séries en fonction $dto
            $qb= $em->createQueryBuilder();
            $qb->select("s")
                ->from("App:Serie", "s");
            if ($dto->getTitre()!=null){
                $qb->andWhere("s.titre=:TITRE")
                    ->setParameter("TITRE", $dto->getTitre());
            }
            if ($dto->getGenre()!=null){
                $qb->join("s.genre","g")
                    ->andWhere("g=:GENRE")
                    ->setParameter("GENRE", $dto->getGenre());
            }

            $series = $qb->getQuery()->getResult();
        }else{
            $series = [];
        }

        return $this->render('formulaire/rechercheSerie.html.twig', [
            'formRecherche'=>$form->createView(),
            'series'=>$series
            ]);
    }



    /**
     * @Route("/ajouterFilmEtLiens")
     */
    public function ajouterFilmEtLiens(EntityManagerInterface $em, Request $req){

        $dto = new FilmEtLiensDTO();
        $form = $this->createForm(FilmEtLiensType::class, $dto);
        $form->handleRequest($req);

        if( $form->isSubmitted() ){

            $film = new Film();
            $film->setTitre( $dto->getTitre() );
            $film->setAnneeSortie( $dto->getAnnee() );
            $film->setDuree( $dto->getDuree() );
            $film->setGenre( $dto->getGenre() );
            $film->setPays( $dto->getPays() );
            $film->setActeurs( $dto->getActeurs() );
            $film->setRealisateurs( $dto->getRealisateurs() );
            $em->persist($film);

            for($i=1;$i<=$dto->getNbLiens(); $i++){

                $lien = new Lien();
                $lien->setUrl( "Lien " . $i );
                $film->addLien($lien);

                $em->persist($lien);
            }

            $em->flush();

            return $this->redirectToRoute("film_index");

        }else{
            return $this->render("formulaire/ajouterSerieComplete.html.twig", ['monForm'=>$form->createView()]);
        }
    }

    /**
     * @Route("/ajoutSerie")
     */
    public function ajoutSerie(Request $req, EntityManagerInterface $em)
    {
        $dto = new AjoutSerieDTO();
        $form = $this->createForm(AjoutSerieType::class, $dto);
        $form->handleRequest($req);

        if ($form->isSubmitted()) {

            $serie = new Serie();
            $serie->setTitre( $dto->getTitre() );
            $serie->setAnnee( $dto->getAnnee() );

            $em->persist($serie);
            for ($i = 1; $i < $dto->getNbSaison(); $i++) {

                $saison = new Saison();
                $saison->setNumSaison($i);
                $serie->addSaison($saison);
                $em->persist($saison);

                for ($j = 1; $j < $dto->getNbEpisodes(); $j++) {

                    $ep = new Episode();
                    $ep->setNumEpisode($j);
                    $saison->addEpisode($ep);

                    $em->persist($ep);
                }
            }

            $em->flush();

        } else {

            return $this->render("formulaire/ajouterSerieComplete.html.twig", ['monForm' => $form->createView()]);
        }
    }

    /**
     * @Route("/ajouterSerieComplete")
     */
    public function ajouterSerieComplete(EntityManagerInterface $em, Request $request)
    {

        $serie = new Serie();
        $form = $this->createForm(SerieCompleteType::class, $serie);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {// Cas requête POST

            $em->persist($serie);
            for ($i = 1; $i < 9; $i++) {

                $saison = new Saison();
                $saison->setNumSaison($i);
                $serie->addSaison($saison);
                $em->persist($saison);

                for ($j = 1; $j < 9; $j++) {

                    $ep = new Episode();
                    $ep->setNumEpisode($j);
                    $saison->addEpisode($ep);

                    $em->persist($ep);
                }
            }

            $em->flush();

            return $this->redirectToRoute("serie_index");

        } else {// Cas requete GET
            return $this->render("formulaire/ajouterSerieComplete.html.twig", ['monForm' => $form->createView()]);
        }
    }

    /**
     * @Route("/formulaire", name="formulaire")
     */
    public function ajouterFilm(FilmRepository $rep, Request $req, EntityManagerInterface $em)
    {
        $dto = new Film();
        $form = $this->createForm(TestType::class, $dto);
        $form->handleRequest($req);
        if ($form->isSubmitted()) {
            $em->persist($dto);
            $em->flush();

            $saison = new Saison();
            $saison->setNumSaison(1);

            $episode = new Episode();
            $episode->setNumEpisode(3);

            $saison->addEpisode($episode);

            return $this->redirectToRoute("film_index");
        }

        dump($dto);


        return $this->render('formulaire/index.html.twig', ['monForm' => $form->createView()]);
    }
}
