<?php

namespace App\Controller\front\Buyer;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/front/buyer', name: 'buyer_')]
class BasketController extends AbstractController
{
    #[Route('/basket', name: 'bascket')]
    public function bascket(): Response
    {
        return $this->render('front/buyer/bascket.html.twig', [
            'controller_name' => 'BayerController',
        ]);
    }
}
