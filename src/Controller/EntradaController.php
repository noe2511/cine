<?php

namespace App\Controller;

use App\Entity\Entrada;
use App\Form\EntradaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mantenimiento/entrada")
 */
class EntradaController extends AbstractController
{
    /**
     * @Route("/", name="entrada_index", methods={"GET"})
     */
    public function index(): Response
    {
        $entradas = $this->getDoctrine()
            ->getRepository(Entrada::class)
            ->findAll();

        return $this->render('entrada/index.html.twig', [
            'entradas' => $entradas,
        ]);
    }

    /**
     * @Route("/nueva", name="entrada_nueva", methods={"GET","POST"})
     */
    public function nueva(Request $request): Response
    {
        $entrada = new Entrada();
        $form = $this->createForm(EntradaType::class, $entrada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($entrada);
            $entityManager->flush();

            return $this->redirectToRoute('entrada_index');
        }

        return $this->render('entrada/nueva.html.twig', [
            'entrada' => $entrada,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{peliculaIdpelicula}", name="entrada_detalles", methods={"GET"})
     */
    public function detalles(Entrada $entrada): Response
    {
        return $this->render('entrada/detalles.html.twig', [
            'entrada' => $entrada,
        ]);
    }

    /**
     * @Route("/{peliculaIdpelicula}/editar", name="entrada_editar", methods={"GET","POST"})
     */
    public function editar(Request $request, Entrada $entrada): Response
    {
        $form = $this->createForm(EntradaType::class, $entrada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('entrada_index');
        }

        return $this->render('entrada/editar.html.twig', [
            'entrada' => $entrada,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{peliculaIdpelicula}", name="entrada_borrar", methods={"DELETE"})
     */
    public function borrar(Request $request, Entrada $entrada): Response
    {
        if ($this->isCsrfTokenValid('delete' . $entrada->getPeliculaIdpelicula(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($entrada);
            $entityManager->flush();
        }

        return $this->redirectToRoute('entrada_index');
    }
}
