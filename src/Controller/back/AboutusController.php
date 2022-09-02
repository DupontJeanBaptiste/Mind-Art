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
#[Route('/back', name: 'aboutus')]
class AboutusController extends AbstractController
{
    #[Route('/aboutus', name: 'index')]
    public function index(): Response
    {
        return $this->render('back/aboutus.html.twig');
    }
}
