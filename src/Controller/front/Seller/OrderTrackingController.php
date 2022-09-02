<?php

namespace App\Controller\front\Seller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SubscriptionRepository;

#[Route('/front/seller', name: 'seller_')]
class OrderTrackingController extends AbstractController
{
    #[Route('/ordertracking', name: 'ordertracking')]
    public function ordertracking(): Response
    {
        return $this->render('front/seller/orderTracking.html.twig', [
            'controller_name' => 'SellerController',
        ]);
    }
}
