<?php

namespace App\Controller;

use App\Entity\Pelicula;
use App\Form\PeliculaType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/mantenimiento/pelicula")
 */
class PeliculaController extends AbstractController
{
    /**
     * @Route("/", name="pelicula_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $peliculas = $this->getDoctrine()
            ->getRepository(Pelicula::class)
            ->findAll();

        $paginacion = $paginator->paginate(
            $peliculas,
            $request->query->getInt('page', 1), /*número de página*/
            1 /*límite por página*/
        );

        return $this->render('pelicula/index.html.twig', [
            'paginacion' => $paginacion,
        ]);
    }

    /**
     * @Route("/nueva", name="pelicula_nueva", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function nueva(Request $request): Response
    {
        $pelicula = new Pelicula();
        $form = $this->createForm(PeliculaType::class, $pelicula);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ficheroimagen = $form['imagen']->getData();
            if ($ficheroimagen) {
                $nombrearchivo = $ficheroimagen->getClientOriginalName();
                $ficheroimagen->move(
                    $this->getParameter('directorio_imagenes'),
                    $nombrearchivo
                );
                $pelicula->setImagen($nombrearchivo);
            } else {
                $pelicula->setImagen("no_disponible.png");
            }

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
     * @IsGranted("ROLE_ADMIN")
     */
    public function detalles(Pelicula $pelicula): Response
    {
        return $this->render('pelicula/detalles.html.twig', [
            'pelicula' => $pelicula,
        ]);
    }

    /**
     * @Route("/{idpelicula}/editar", name="pelicula_editar", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function editar(Request $request, Pelicula $pelicula): Response
    {
        $form = $this->createForm(PeliculaType::class, $pelicula);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ficheroimagen = $form['imagen']->getData();
            if ($ficheroimagen) {
                $nombrearchivo = $ficheroimagen->getClientOriginalName();
                $ficheroimagen->move(
                    $this->getParameter('directorio_imagenes'),
                    $nombrearchivo
                );
                $pelicula->setImagen($nombrearchivo);
            }

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
     * @IsGranted("ROLE_ADMIN")
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
