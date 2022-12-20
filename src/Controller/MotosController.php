<?php

namespace App\Controller;

use App\Entity\Motos;
use App\Form\MotosType;
use App\Repository\MotosRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security as ConfigurationSecurity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted as ConfigurationIsGranted;


#[Route('/motos')]
#[ConfigurationIsGranted('ROLE_ADMIN')]
class MotosController extends AbstractController
{
    #[Route('/', name: 'app_motos_index', methods: ['GET'])]
    public function index(MotosRepository $motosRepository): Response
    {
        return $this->render('motos/index.html.twig', [
            'motos' => $motosRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_motos_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MotosRepository $motosRepository): Response
    {
        $moto = new Motos();
        $form = $this->createForm(MotosType::class, $moto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $motosRepository->save($moto, true);

            return $this->redirectToRoute('app_motos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('motos/new.html.twig', [
            'moto' => $moto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_motos_show', methods: ['GET'])]
    public function show(Motos $moto): Response
    {
        return $this->render('motos/show.html.twig', [
            'moto' => $moto,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_motos_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Motos $moto, MotosRepository $motosRepository): Response
    {
        $form = $this->createForm(MotosType::class, $moto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $motosRepository->save($moto, true);

            return $this->redirectToRoute('app_motos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('motos/edit.html.twig', [
            'moto' => $moto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_motos_delete', methods: ['POST'])]
    public function delete(Request $request, Motos $moto, MotosRepository $motosRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $moto->getId(), $request->request->get('_token'))) {
            $motosRepository->remove($moto, true);
        }

        return $this->redirectToRoute('app_motos_index', [], Response::HTTP_SEE_OTHER);
    }



}
