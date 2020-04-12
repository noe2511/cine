<?php

namespace App\Controller;

use App\Entity\Genero;
use App\Form\GeneroType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/genero")
 */
class GeneroController extends AbstractController
{
    /**
     * @Route("/", name="genero_index", methods={"GET"})
     */
    public function index(): Response
    {
        $generos = $this->getDoctrine()
            ->getRepository(Genero::class)
            ->findAll();

        return $this->render('genero/index.html.twig', [
            'generos' => $generos,
        ]);
    }

    /**
     * @Route("/nuevo", name="genero_nuevo", methods={"GET","POST"})
     */
    public function nuevo(Request $request): Response
    {
        $genero = new Genero();
        $form = $this->createForm(GeneroType::class, $genero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($genero);
            $entityManager->flush();

            return $this->redirectToRoute('genero_index');
        }

        return $this->render('genero/nuevo.html.twig', [
            'genero' => $genero,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idgenero}", name="genero_detalles", methods={"GET"})
     */
    public function detalles(Genero $genero): Response
    {
        return $this->render('genero/detalles.html.twig', [
            'genero' => $genero,
        ]);
    }

    /**
     * @Route("/{idgenero}/editar", name="genero_editar", methods={"GET","POST"})
     */
    public function editar(Request $request, Genero $genero): Response
    {
        $form = $this->createForm(GeneroType::class, $genero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('genero_index');
        }

        return $this->render('genero/editar.html.twig', [
            'genero' => $genero,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idgenero}", name="genero_borrar", methods={"DELETE"})
     */
    public function borrar(Request $request, Genero $genero): Response
    {
        if ($this->isCsrfTokenValid('delete' . $genero->getIdgenero(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($genero);
            $entityManager->flush();
        }

        return $this->redirectToRoute('genero_index');
    }
}
