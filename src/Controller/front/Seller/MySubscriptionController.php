<?php

namespace App\Controller\front\Seller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SubscriptionRepository;

#[Route('/front/seller', name: 'seller_')]
class MySubscriptionController extends AbstractController
{
    #[Route('/subscription', name: 'subscription')]
    public function subscription(): Response
    {
        return $this->render('front/seller/subscription.html.twig', [
            'controller_name' => 'SellerController',
        ]);
    }
}
