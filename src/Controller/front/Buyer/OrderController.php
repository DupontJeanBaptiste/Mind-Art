<?php

namespace App\Controller\front\Buyer;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/front/buyer', name: 'buyer_')]
class OrderController extends AbstractController
{
    #[Route('/order', name: 'order')]
    public function order(): Response
    {
        return $this->render('front/buyer/order.html.twig', [
            'controller_name' => 'BuyerController',
        ]);
    }
}
