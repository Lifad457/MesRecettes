<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Repository\RecetteRepository;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('index/index.html.twig');
    }
    
    /**
     * @Route("/admin", name="admin")
     */
    public function admin()
    {
        return $this->render('Admin/index.html.twig');
    }
	
	/**
     * @Route("/recherche", methods={"GET"}, name="recherche_recette")
     */
    public function recherche(Request $request, RecetteRepository $recettes): Response
    {
        $query = $request->query->get('q', '');
        $limit = $request->query->get('l', 10);
        $recettesTrouvees = $recettes->findBySearchQuery($query, $limit);
		
        $results = [];
        foreach ($recettesTrouvees as $recette) {
            $results[] = [
                'id_recette' => $recette->getId(),
                'nom_recette' => $recette->getNomRecette(),
				'description' => $recette->getDescription(),
            ];
        }
		return $this->render('index/recherche.html.twig', array('recettes' =>$results));
    }
	

}