<?php

namespace App\Controller;

use App\Entity\Pelicula;
use App\Form\PeliculaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pelicula")
 */
class PeliculaController extends AbstractController
{
    /**
     * @Route("/", name="pelicula_index", methods={"GET"})
     */
    public function index(): Response
    {
        $peliculas = $this->getDoctrine()
            ->getRepository(Pelicula::class)
            ->findAll();

        return $this->render('pelicula/index.html.twig', [
            'peliculas' => $peliculas,
        ]);
    }

    /**
     * @Route("/nueva", name="pelicula_nueva", methods={"GET","POST"})
     */
    public function nueva(Request $request): Response
    {
        $pelicula = new Pelicula();
        $form = $this->createForm(PeliculaType::class, $pelicula);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pelicula);
            $entityManager->flush();

            return $this->redirectToRoute('pelicula_index');
        }

        return $this->render('pelicula/nueva.html.twig', [
            'pelicula' => $pelicula,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idpelicula}", name="pelicula_detalles", methods={"GET"})
     */
    public function detalles(Pelicula $pelicula): Response
    {
        return $this->render('pelicula/detalles.html.twig', [
            'pelicula' => $pelicula,
        ]);
    }

    /**
     * @Route("/{idpelicula}/editar", name="pelicula_editar", methods={"GET","POST"})
     */
    public function editar(Request $request, Pelicula $pelicula): Response
    {
        $form = $this->createForm(PeliculaType::class, $pelicula);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pelicula_index');
        }

        return $this->render('pelicula/editar.html.twig', [
            'pelicula' => $pelicula,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idpelicula}", name="pelicula_borrar", methods={"DELETE"})
     */
    public function borrar(Request $request, Pelicula $pelicula): Response
    {
        if ($this->isCsrfTokenValid('delete' . $pelicula->getIdpelicula(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pelicula);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pelicula_index');
    }
}
