<?php

namespace Dglas\JeuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ListingInventaireController extends Controller
{
	
	/**
     * Page accueil du listing inventaire.
     */
    public function viewAction()
    {

        $repository = $this
          ->getDoctrine()
          ->getManager()
          ->getRepository('DglasJeuBundle:Jeu')
        ;

        $liste = $repository->test();


        return $this->render('DglasJeuBundle:ListingInventaire:view.html.twig', array(
            'liste_jeu_inventaire' => $liste
        ));
    }
	
}
