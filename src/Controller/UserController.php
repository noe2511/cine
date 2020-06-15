<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UsuarioType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/usuario")
 */
class UserController extends AbstractController
{
    /**
     * @Route("crear_admin", name="crearUsuarioAdmin")
     *
     * @param UserPasswordEncoder $encoder
     * @return void
     */
    public function crearUsuario(UserPasswordEncoderInterface $encoder)
    {
        $usuario = new User();
        $contrasena = "1234";
        $encoded = $encoder->encodePassword($usuario, $contrasena);
        $usuario->setPassword($encoded);
        $usuario->setEmail("noe25111995@gmail.com");
        $usuario->setRoles(['ROLE_ADMIN']);
        $em = $this->getDoctrine()->getManager();
        $em->persist($usuario);
        $em->flush();

        return $this->redirectToRoute("principal");
    }
}
