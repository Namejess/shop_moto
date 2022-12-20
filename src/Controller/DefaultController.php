<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted as ConfigurationIsGranted;
use App\Repository\MotosRepository;
use App\Repository\PanierRepository;
use App\Repository\MotosPanierRepository;


class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]
    #[ConfigurationIsGranted('ROLE_USER')]
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route('/nouvelles-arrivées', name: 'app_arrive')]
    public function arrive(): Response
    {
        return $this->render('default/nouvelles-arrivées.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route('/actualites', name: 'app_actu')]
    public function actu(): Response
    {
        return $this->render('default/actualites.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route('/magasin', name: 'app_magasin')]
    public function magasin(): Response
    {
        return $this->render('default/magasin.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route('/vehicules', name: 'app_vehicules')]
    public function vehicules(MotosRepository $motosRepository, PanierRepository $panierRepository): Response
    {
        return $this->render('default/vehicules.twig', [
            'motos' => $motosRepository->findAll(),
            'panier' => $panierRepository->findAll(),
        ]);
    }
    
    #[Route('/testAjax', name: 'app_motos_testAjax', methods: ['GET', 'POST'])]
    public function testAjax(Request $request, MotosPanierRepository $motosPanierRepository): Response
    {

        $chaine = "Mon produit est : " . $_POST['motos'];
        $chaine .= "<br>Ma quantité est : " . $_POST['qte'];
        $motosPanier = $motosPanierRepository->findMotoById($request->get('qte'));
        $motosPanier->save($motosPanier, true);
        return new Response('Votre produit a bien été ajouté au panier');
    }


    
}
