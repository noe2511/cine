<?php

namespace App\Controller;

use App\Entity\Pelicula;
use App\Entity\Sala;
use App\Entity\Asiento;
use App\Entity\Horario;
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

    /**
     * @Route("/horario_pelicula/{idpelicula}", name="horarioPelicula", methods={"GET"})
     */
    public function mostrarHorarios(HorarioRepository $prepository, Pelicula $pelicula)
    {
        $horarios = $prepository->horariosPelicula($pelicula->getIdpelicula());

        return $this->render('menu/horariosPelicula.html.twig', [
            'horarios' => $horarios,
        ]);
    }

    /**
     * @Route("/sala_reserva/{idsala}", name="salaReserva", methods={"GET"})
     */
    public function salaReserva(Sala $sala)
    {
        $sala = $this->getDoctrine()
            ->getRepository(Sala::class)
            ->findOneBy(['idsala' => $sala->getIdsala()]);

        $asientos = $this->getDoctrine()
            ->getRepository(Asiento::class)
            ->findBy(['salaIdsala' => $sala->getIdsala()]);

        return $this->render('menu/salaReserva.html.twig', [
            'sala' => $sala,
            'asientos' => $asientos
        ]);
    }
}
