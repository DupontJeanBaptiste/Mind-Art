<?php

namespace App\Controller\back;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Require ROLE_ADMIN for all the actions of this controller
 *
 * @IsGranted("ROLE_ADMIN")
 */
#[Route('/back', name: 'back_home_')]
class HomeController extends AbstractController
{
    #[Route('/home', name: 'index')]
    public function index(): Response
    {
        $this->addFlash(
            'success',
            'Bienvenue sur Mind\'Art'
        );
        return $this->render('back/home.html.twig');
    }
}
