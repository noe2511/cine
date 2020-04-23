<?php

namespace App\Controller;

use App\Entity\Horario;
use App\Form\HorarioType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mantenimiento/horario")
 */
class HorarioController extends AbstractController
{
    /**
     * @Route("/", name="horario_index", methods={"GET"})
     */
    public function index(): Response
    {
        $horarios = $this->getDoctrine()
            ->getRepository(Horario::class)
            ->findAll();

        return $this->render('horario/index.html.twig', [
            'horarios' => $horarios,
        ]);
    }

    /**
     * @Route("/new", name="horario_nuevo", methods={"GET","POST"})
     */
    public function nuevo(Request $request): Response
    {
        $horario = new Horario();
        $form = $this->createForm(HorarioType::class, $horario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($horario);
            $entityManager->flush();

            return $this->redirectToRoute('horario_index');
        }

        return $this->render('horario/nuevo.html.twig', [
            'horario' => $horario,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{fecha}", name="horario_detalles", methods={"GET"})
     */
    public function show(Horario $horario): Response
    {
        return $this->render('horario/detalles.html.twig', [
            'horario' => $horario,
        ]);
    }

    /**
     * @Route("/{fecha}/editar", name="horario_editar", methods={"GET","POST"})
     */
    public function editar(Request $request, Horario $horario): Response
    {
        $form = $this->createForm(HorarioType::class, $horario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('horario_index');
        }

        return $this->render('horario/editar.html.twig', [
            'horario' => $horario,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{fecha}", name="horario_borrar", methods={"DELETE"})
     */
    public function borrar(Request $request, Horario $horario): Response
    {
        if ($this->isCsrfTokenValid('delete' . $horario->getFecha(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($horario);
            $entityManager->flush();
        }

        return $this->redirectToRoute('horario_index');
    }
}
