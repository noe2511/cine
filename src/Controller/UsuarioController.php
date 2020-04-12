<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Form\UsuarioType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/usuario")
 */
class UsuarioController extends AbstractController
{
    /**
     * @Route("/", name="usuario_index", methods={"GET"})
     */
    public function index(): Response
    {
        $usuarios = $this->getDoctrine()
            ->getRepository(Usuario::class)
            ->findAll();

        return $this->render('usuario/index.html.twig', [
            'usuarios' => $usuarios,
        ]);
    }

    /**
     * @Route("/nuevo", name="usuario_nuevo", methods={"GET","POST"})
     */
    public function nuevo(Request $request): Response
    {
        $usuario = new Usuario();
        $form = $this->createForm(UsuarioType::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($usuario);
            $entityManager->flush();

            return $this->redirectToRoute('usuario_index');
        }

        return $this->render('usuario/nuevo.html.twig', [
            'usuario' => $usuario,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{usuario}", name="usuario_detalles", methods={"GET"})
     */
    public function detalles(Usuario $usuario): Response
    {
        return $this->render('usuario/detalles.html.twig', [
            'usuario' => $usuario,
        ]);
    }

    /**
     * @Route("/{usuario}/editar", name="usuario_editar", methods={"GET","POST"})
     */
    public function editar(Request $request, Usuario $usuario): Response
    {
        $form = $this->createForm(UsuarioType::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('usuario_index');
        }

        return $this->render('usuario/editar.html.twig', [
            'usuario' => $usuario,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{usuario}", name="usuario_borrar", methods={"DELETE"})
     */
    public function borrar(Request $request, Usuario $usuario): Response
    {
        if ($this->isCsrfTokenValid('delete' . $usuario->getUsuario(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($usuario);
            $entityManager->flush();
        }

        return $this->redirectToRoute('usuario_index');
    }
}
