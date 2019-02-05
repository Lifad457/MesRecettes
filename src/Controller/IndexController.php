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
        /**if (!$request->isXmlHttpRequest()) {
            return $this->render('index/recherche.html.twig', ['recette' => $request->query->get('q', '')]);
        }*/
        $query = $request->query->get('q', '');
        $limit = $request->query->get('l', 10);
        $recettesTrouvees = $recettes->findBySearchQuery($query, $limit);
		
        $results = [];
        foreach ($recettesTrouvees as $recette) {
            $results[] = [
                'nom_recette' => htmlspecialchars($recette->getNomRecette(), ENT_COMPAT | ENT_HTML5),
            ];
        }
        /**return $this->json($results);*/
		return $this->render('index/recherche.html.twig', array('recettes' =>$results));
    }
	

}