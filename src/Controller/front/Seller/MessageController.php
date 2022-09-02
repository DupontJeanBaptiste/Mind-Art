<?php

namespace App\Controller\front\Seller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\SubscriptionRepository;

#[Route('/front/seller', name: 'seller_')]
class MessageController extends AbstractController
{
    #[Route('/messages', name: 'messages')]
    public function messages(): Response
    {
        return $this->render('front/seller/messages.html.twig', [
            'controller_name' => 'SellerController',
        ]);
    }
}
