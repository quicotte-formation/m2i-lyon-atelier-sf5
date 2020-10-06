<?php

namespace App\Controller;

use App\DTO\AjoutSerieDTO;
use App\Entity\Episode;
use App\Entity\Film;
use App\Entity\Saison;
use App\Entity\Serie;
use App\Form\AjoutSerieType;
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
