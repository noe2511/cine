<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PrincipalController extends AbstractController
{

    /** @Route("/", name="principal")
     *
     * @return void
     */
    public function Principal()
    {
        return $this->render("shared/cabecera.html.twig");
    }
}
