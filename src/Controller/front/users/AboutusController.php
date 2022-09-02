<?php

namespace App\Controller\front\users;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/front', name: 'users_aboutus_')]
class AboutusController extends AbstractController
{
    #[Route('/aboutus', name: 'index')]
    public function index(): Response
    {
        return $this->render('front/users/aboutus.html.twig');
    }
}
