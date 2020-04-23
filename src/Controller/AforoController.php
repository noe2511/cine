<?php

namespace App\Controller;

use App\Entity\Aforo;
use App\Form\AforoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/aforo")
 */
class AforoController extends AbstractController
{
    /**
     * @Route("/", name="aforo_index", methods={"GET"})
     */
    public function index(): Response
    {
        $aforos = $this->getDoctrine()
            ->getRepository(Aforo::class)
            ->findAll();

        return $this->render('aforo/index.html.twig', [
            'aforos' => $aforos,
        ]);
    }

    /**
     * @Route("/nuevo", name="aforo_nuevo", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $aforo = new Aforo();
        $form = $this->createForm(AforoType::class, $aforo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($aforo);
            $entityManager->flush();

            return $this->redirectToRoute('aforo_index');
        }

        return $this->render('aforo/nuevo.html.twig', [
            'aforo' => $aforo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{tamanio}", name="aforo_detalles", methods={"GET"})
     */
    public function detalles(Aforo $aforo): Response
    {
        return $this->render('aforo/detalles.html.twig', [
            'aforo' => $aforo,
        ]);
    }

    /**
     * @Route("/{tamanio}/editar", name="aforo_editar", methods={"GET","POST"})
     */
    public function editar(Request $request, Aforo $aforo): Response
    {
        $form = $this->createForm(AforoType::class, $aforo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('aforo_index');
        }

        return $this->render('aforo/editar.html.twig', [
            'aforo' => $aforo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{tamanio}", name="aforo_borrar", methods={"DELETE"})
     */
    public function borrar(Request $request, Aforo $aforo): Response
    {
        if ($this->isCsrfTokenValid('delete' . $aforo->getTamanio(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($aforo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('aforo_index');
    }
}
