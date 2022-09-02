<?php

namespace App\Controller\front\Buyer;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/front/buyer', name: 'buyer_')]
class PurchaseHistoryController extends AbstractController
{
    #[Route('/purchasehistory', name: 'purchasehistory')]
    public function purchaseHistory(): Response
    {
        return $this->render('front/buyer/purchaseHistory.html.twig', [
            'controller_name' => 'BuyerController',
        ]);
    }
}
