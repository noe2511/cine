<?php

namespace App\Controller;

use App\Entity\Genero;
use App\Form\GeneroType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/mantenimiento/genero")
 */
class GeneroController extends AbstractController
{
    /**
     * @Route("/", name="genero_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $generos = $this->getDoctrine()
            ->getRepository(Genero::class)
            ->findAll();

        $paginacion = $paginator->paginate(
            $generos, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );

        return $this->render('genero/index.html.twig', [
            'paginacion' => $paginacion,
        ]);
    }

    /**
     * @Route("/nuevo", name="genero_nuevo", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
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
     * @IsGranted("ROLE_ADMIN")
     */
    public function detalles(Genero $genero): Response
    {
        return $this->render('genero/detalles.html.twig', [
            'genero' => $genero,
        ]);
    }

    /**
     * @Route("/{idgenero}/editar", name="genero_editar", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
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
     * @IsGranted("ROLE_ADMIN")
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
