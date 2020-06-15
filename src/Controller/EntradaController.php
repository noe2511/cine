<?php

namespace App\Controller;

use App\Entity\Entrada;
use App\Form\EntradaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/mantenimiento/entrada")
 */
class EntradaController extends AbstractController
{
    /**
     * @Route("/", name="entrada_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
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
     * @IsGranted("ROLE_ADMIN")
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
     * @Route("/{identrada}", name="entrada_detalles", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function show(Entrada $entrada): Response
    {
        return $this->render('entrada/detalles.html.twig', [
            'entrada' => $entrada,
        ]);
    }

    /**
     * @Route("/{identrada}/editar", name="entrada_editar", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
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
     * @Route("/{identrada}", name="entrada_borrar", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function borrar(Request $request, Entrada $entrada): Response
    {
        if ($this->isCsrfTokenValid('delete' . $entrada->getIdentrada(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($entrada);
            $entityManager->flush();
        }

        return $this->redirectToRoute('entrada_index');
    }
}
