<?php

namespace App\Controller;

use App\Entity\Pelicula;
use Knp\Component\Pager\PaginatorInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PeliculaRepository;
use Symfony\Component\HttpFoundation\Request;

class PrincipalController extends AbstractController
{

    /** @Route("/", name="principal")
     *
     * @return void
     */
    public function Principal(PaginatorInterface $paginator, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $peliculas = $this->getDoctrine()
            ->getRepository(Pelicula::class)
            ->findAll();

        $paginacion = $paginator->paginate(
            $peliculas,
            $request->query->getInt('page', 1),
            6 /*límite por página*/
        );

        return $this->render("principal/index.html.twig", [
            'paginacion' => $paginacion,
            'peliculas' => $peliculas
        ]);
    }

    /** @Route("/mantenimiento", name="mantenimiento")
     *
     * @return void
     */
    public function Mantenimiento()
    {
        return $this->render("mantenimiento/vista.html.twig");
    }
}
