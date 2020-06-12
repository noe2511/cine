<?php

namespace App\Controller;

use App\Entity\Pelicula;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PeliculasRepository;
use Symfony\Component\Routing\Annotation\Route;

class TrailerController extends AbstractController
{
    /** @Route("/trailer", name="trailer")
     *
     * @return void
     */
    public function getTrailer(PaginatorInterface $paginator, Request $request, PeliculasRepository $prepository)
    {
        $peliculas = $prepository->trailer();

        $paginacion = $paginator->paginate(
            $peliculas, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );

        return $this->render('menu/trailer.html.twig', [
            'paginacion' => $paginacion,
        ]);
    }

    /** @Route("/trailer/{idpelicula}", name="trailer_pelicula")
     *
     * @return void
     */
    public function getTrailerPelicula(Pelicula $pelicula)
    {
        return $this->render('menu/trailerUnico.html.twig', [
            'pelicula' => $pelicula,
        ]);
    }
}
