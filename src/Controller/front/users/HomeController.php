<?php

namespace App\Controller\front\users;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/front', name: 'home_')]
class HomeController extends AbstractController
{
    #[Route('/home', name: 'index')]
    public function index(): Response
    {
        return $this->render('front/users/home.html.twig');
    }
}
