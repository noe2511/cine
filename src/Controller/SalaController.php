<?php

namespace App\Controller;

use App\Entity\Sala;
use App\Form\SalaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sala")
 */
class SalaController extends AbstractController
{
    /**
     * @Route("/", name="sala_index", methods={"GET"})
     */
    public function index(): Response
    {
        $salas = $this->getDoctrine()
            ->getRepository(Sala::class)
            ->findAll();

        return $this->render('sala/index.html.twig', [
            'salas' => $salas,
        ]);
    }

    /**
     * @Route("/new", name="sala_nueva", methods={"GET","POST"})
     */
    public function nueva(Request $request): Response
    {
        $sala = new Sala();
        $form = $this->createForm(SalaType::class, $sala);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sala);
            $entityManager->flush();

            return $this->redirectToRoute('sala_index');
        }

        return $this->render('sala/nueva.html.twig', [
            'sala' => $sala,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idsala}", name="sala_detalles", methods={"GET"})
     */
    public function detalles(Sala $sala): Response
    {
        return $this->render('sala/detalles.html.twig', [
            'sala' => $sala,
        ]);
    }

    /**
     * @Route("/{idsala}/editar", name="sala_editar", methods={"GET","POST"})
     */
    public function editar(Request $request, Sala $sala): Response
    {
        $form = $this->createForm(SalaType::class, $sala);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sala_index');
        }

        return $this->render('sala/editar.html.twig', [
            'sala' => $sala,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idsala}", name="sala_borrar", methods={"DELETE"})
     */
    public function borrar(Request $request, Sala $sala): Response
    {
        if ($this->isCsrfTokenValid('delete' . $sala->getIdsala(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sala);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sala_index');
    }
}
