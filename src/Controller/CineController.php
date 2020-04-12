<?php

namespace App\Controller;

use App\Entity\Cine;
use App\Form\Cine1Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cine")
 */
class CineController extends AbstractController
{
    /**
     * @Route("/", name="cine_index", methods={"GET"})
     */
    public function index(): Response
    {
        $cines = $this->getDoctrine()
            ->getRepository(Cine::class)
            ->findAll();

        return $this->render('cine/index.html.twig', [
            'cines' => $cines,
        ]);
    }

    /**
     * @Route("/nuevo", name="cine_nuevo", methods={"GET","POST"})
     */
    public function nuevo(Request $request): Response
    {
        $cine = new Cine();
        $form = $this->createForm(Cine1Type::class, $cine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cine);
            $entityManager->flush();

            return $this->redirectToRoute('cine_index');
        }

        return $this->render('cine/nuevo.html.twig', [
            'cine' => $cine,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{cif}", name="cine_detalles", methods={"GET"})
     */
    public function detalles(Cine $cine): Response
    {
        return $this->render('cine/detalles.html.twig', [
            'cine' => $cine,
        ]);
    }

    /**
     * @Route("/{cif}/editar", name="cine_editar", methods={"GET","POST"})
     */
    public function editar(Request $request, Cine $cine): Response
    {
        $form = $this->createForm(Cine1Type::class, $cine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cine_index');
        }

        return $this->render('cine/editar.html.twig', [
            'cine' => $cine,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{cif}", name="cine_borrar", methods={"DELETE"})
     */
    public function borrar(Request $request, Cine $cine): Response
    {
        if ($this->isCsrfTokenValid('delete' . $cine->getCif(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cine);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cine_index');
    }
}
