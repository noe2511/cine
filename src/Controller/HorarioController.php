<?php

namespace App\Controller;

use App\Entity\Horario;
use App\Form\HorarioType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/mantenimiento/horario")
 */
class HorarioController extends AbstractController
{
    /**
     * @Route("/", name="horario_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $horarios = $this->getDoctrine()
            ->getRepository(Horario::class)
            ->findAll();

        $paginacion = $paginator->paginate(
            $horarios, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );

        return $this->render('horario/index.html.twig', [
            'paginacion' => $paginacion,
        ]);
    }

    /**
     * @Route("/nuevo", name="horario_nuevo", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
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
     * @Route("/{idhorario}", name="horario_detalles", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function detalles(Horario $horario): Response
    {
        return $this->render('horario/detalles.html.twig', [
            'horario' => $horario,
        ]);
    }

    /**
     * @Route("/{idhorario}/editar", name="horario_editar", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
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
     * @Route("/{idhorario}", name="horario_borrar", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function borrar(Request $request, Horario $horario): Response
    {
        if ($this->isCsrfTokenValid('borrar' . $horario->getIdhorario(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($horario);
            $entityManager->flush();
        }

        return $this->redirectToRoute('horario_index');
    }
}
