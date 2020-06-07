<?php

namespace App\Controller;

use App\Entity\Asiento;
use App\Entity\Sala;
use App\Form\SalaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/mantenimiento/sala")
 */
class SalaController extends AbstractController
{
    /**
     * @Route("/", name="sala_index", methods={"GET"})
     * @param PaginatorInterface $paginator
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $salas = $this->getDoctrine()
            ->getRepository(Sala::class)
            ->findAll();

        $paginacion = $paginator->paginate(
            $salas, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );

        return $this->render('sala/index.html.twig', [
            'paginacion' => $paginacion,
        ]);
    }

    /**
     * @Route("/nueva", name="sala_nueva", methods={"GET","POST"})
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

            for ($i = 0; $i < 5; $i++) {
                $asiento = new Asiento();
                $asiento->setTipo("minusvalido");
                $asiento->setEstado("libre");
                $asiento->setSalaIdsala($sala);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($asiento);
                $entityManager->flush();
            }

            for ($i = 5; $i < $sala->getAforo(); $i++) {
                $asiento = new Asiento();
                $asiento->setTipo("normal");
                $asiento->setEstado("libre");
                $asiento->setSalaIdsala($sala);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($asiento);
                $entityManager->flush();
            }

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
