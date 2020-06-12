<?php

namespace App\Controller;

use App\Entity\Pelicula;
use App\Repository\HorarioRepository;
use Knp\Component\Pager\PaginatorInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PeliculaRepository;
use Symfony\Component\HttpFoundation\Request;

class ReservaController extends AbstractController
{
    /**
     * @Route("/reserva", name="reserva", methods={"GET"})
     */
    public function mostrarPeliculas(PaginatorInterface $paginator, Request $request)
    {
        $peliculas = $this->getDoctrine()
            ->getRepository(Pelicula::class)
            ->findAll();

        $paginacion = $paginator->paginate(
            $peliculas, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );

        return $this->render('menu/reservaPeliculas.html.twig', [
            'paginacion' => $paginacion,
        ]);
    }

    public function mostrarHorarios(HorarioRepository $prepository, Pelicula $pelicula)
    {
        $horarios = $prepository->horariosPelicula($pelicula->getIdpelicula());
    }
}
