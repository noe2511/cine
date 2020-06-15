<?php

namespace App\Controller;

use App\Entity\Pelicula;
use App\Entity\Sala;
use App\Entity\Asiento;
use App\Entity\Entrada;
use App\Entity\Horario;
use App\Repository\HorarioRepository;
use App\Repository\EntradaRepository;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PeliculaRepository;
use Doctrine\ORM\EntityManager;
use Proxies\__CG__\App\Entity\Horario as EntityHorario;
use Swift_Mailer;
use Swift_SmtpTransport;
use Spipu\Html2Pdf\Html2Pdf;
use Swift_Attachment;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/reserva")
 */
class ReservaController extends AbstractController
{
    /**
     * @Route("/", name="reserva", methods={"GET"})
     *
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
     * @Route("/insertarEntrada", name="insertarEntrada", methods={"GET","POST"})
     * 
     */
    public function insertarEntrada(Request $request)
    {
        $entrada = new Entrada();

        $asiento = $this->getDoctrine()
            ->getRepository(Asiento::class)
            ->findOneBy(['idasiento' => $_REQUEST['idAsiento']]);

        $horario = $this->getDoctrine()
            ->getRepository(Horario::class)
            ->findOneBy(['idhorario' => $_REQUEST['idHorario']]);

        $entrada->setAsientoIdasiento($asiento);
        $entrada->setHorarioIdhorario($horario);

        $em = $this->getDoctrine()->getManager();
        $em->persist($entrada);
        $em->flush();

        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
            ->setUsername('noe25111995@gmail.com')
            ->setPassword('Admin_0404');

        $mailer = new Swift_Mailer($transport);

        $message = (new \Swift_Message())
            ->setFrom(["noe25111995@gmail.com" => "Sistema de pedidos"])
            ->setTo($_REQUEST["correo"])
            ->setSubject("pedido confirmado")
            ->setBody(
                $this->renderView(
                    "menu/correo.html.twig",
                    [
                        "asiento" => $asiento,
                        "horario" => $horario
                    ]
                ),
                "text/html"
            );

        $mailer->send($message);

        return new JsonResponse(['estado' => 'Entrada creada'], Response::HTTP_CREATED);
    }

    /**
     * @Route("/horario_pelicula/{idpelicula}", name="horarioPelicula", methods={"GET"})
     * 
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
     * 
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

    /**
     * @Route("/comprobarReservas/{horarioIdhorario}", name="comprobarReservas", methods={"GET"})
     * 
     */
    public function comprobarReservas(Horario $horarioIdhorario, EntradaRepository $prepository)
    {
        //$prueba = new Entrada(3, 2, 1);
        $entradas = $prepository->reservas($horarioIdhorario->getIdhorario());

        $datos = [];
        foreach ($entradas as $entrada) {
            $datos[] = [
                'idEntrada' => $entrada->getIdentrada(),
                'idHorario' => $entrada->getHorarioIdhorario()->getIdhorario(),
                'idAsiento' => $entrada->getAsientoIdasiento()->getIdasiento()
            ];
        }



        $response = new JsonResponse($datos, Response::HTTP_OK);

        $response->headers->set('Content-Type', 'application/json');
        return $response;
        /*return $this->render('prueba.html.twig', [
            'reservas' => $reservas
        ]);*/
        //return $reservas;
    }
}
